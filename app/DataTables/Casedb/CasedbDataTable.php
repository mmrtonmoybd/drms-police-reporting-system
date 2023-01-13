<?php

namespace App\DataTables\Casedb;

use App\Models\Casedb;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
//use App\Models\Casedb;

class CasedbDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('casesubtype.type', function($raw) {
                return (empty($raw->casesubtype->type)) ? '' : $raw->casesubtype->type ;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                if (auth()->user()->can('qrr.view')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/details/$row->id").'" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                }
                if (auth()->user()->can('qrr.edit')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/edit/$row->id").'" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                }
                if (auth()->user()->can('qrr.review')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/review/update/$row->id").'" class="action-icon">  <i class="fas fa-unlock-alt"></i></a> ';
                }
                if (auth()->user()->can('qrr.delete')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/delete/$row->id").'"  onclick="return confirm(\'Do you want to delete this qrr?\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                }

                return $actionBtn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Casedb $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Casedb $model)
    {
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $dvalue = 'kglf';
            $dkey = '!=';
            $tvalue = 'kkdk';
            $tkey = '!=';
            $cvalue = 'dkikEK';
            $ckey = '!=';
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = 'kkdk';
            $tkey = '!=';
            $cvalue = 'dkikEK';
            $ckey = '!=';
        } else {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = auth()->user()->thanaID;
            $tkey = '=';
        }

        return $model->with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('casedb-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    
                    ->buttons(
                        
                        Button::make(['excel', 'csv']),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    )->parameters(['initComplete' => "function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var input = document.createElement(\"input\");
                            $(input).appendTo($(column.footer()).empty())
                            .on('change', function () {
                                column.search($(this).val(), false, false, true).draw();
                            });
                        });
                    }",
                ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id')->title('Iddddd'),
            Column::make('district.bn_name'),
            Column::make('circle.name'),
            Column::make('thana.name'),
            Column::make('cdms_pg_id'),
            Column::make('source_of_info'),
            Column::make('gr_no'),
            Column::make('case_no'),
            Column::make('dhara'),
            Column::make('case_date'),
            Column::make('casetype.type'),
            Column::make('casesubtype.type'),
            Column::make('incident_date_time'),
            Column::make('short_dettails'),
            Column::make('azahar_namio_victims'),
            Column::make('nispotti_or_multobi'),
            Column::make('nispotti_type'),
            Column::make('cs_or_fr_no'),
            Column::make('nispotti_date'),
            Column::make('nispottisecond'),
            Column::make('police_report_victim'),
            Column::make('number_of_accused'),
            Column::make('jamin_prapto'),
            Column::make('polatok'),
            Column::make('azahar_vukto_invistigate'),
            Column::make('ovohoti'),
            Column::make('sixtyone_recive'),
            Column::make('sixtyfour_recive'),
            Column::make('invistigate_rate'),
            Column::make('comment'),
            Column::make('user_id'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Casedb_' . date('YmdHis');
    }
}
