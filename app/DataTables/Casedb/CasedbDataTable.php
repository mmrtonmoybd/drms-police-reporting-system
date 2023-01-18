<?php

namespace App\DataTables\Casedb;

use App\Models\Casedb;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

//use App\Models\Casedb;

class CasedbDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('casesubtype.type', function ($raw) {
                return (empty($raw->casesubtype->type)) ? '' : $raw->casesubtype->type;
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                if (auth()->user()->can('case.view')) {
                    $actionBtn .= '<a href="' . url("admin/case/view/$row->casid") . '" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                }
                if (auth()->user()->can('case.edit')) {
                    $actionBtn .= '<a href="' . url("admin/case/edit/$row->casid") . '" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                }
                if (auth()->user()->can('case.review')) {
                    $actionBtn .= '<a href="' . url("admin/case/review/update/$row->casid") . '" class="action-icon">  <i class="fas fa-unlock-alt"></i></a> ';
                }
                if (auth()->user()->can('case.delete')) {
                    $actionBtn .= '<a href="' . url("admin/case/delete/$row->casid") . '"  onclick="return confirm(\'Do you want to delete this case?\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                }

                return $actionBtn;
            })
            ->editColumn('gr_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->gr_no, 15);
            })
            ->editColumn('case_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->case_no, 10);
            })
            ->editColumn('dhara', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->dhara, 10);
            })
            ->editColumn('short_dettails', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->short_dettails, 10);
            })
            ->editColumn('gr_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->gr_no, 10);
            })
            ->editColumn('nispotti_type ', function ($raw) {
                return ($raw->nispotti_type != 0) ? $raw->nispotti_type : '' ;
            })
            ->editColumn('cs_or_fr_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->cs_or_fr_no, 10);
            })
            ->editColumn('comment', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->comment, 10);
            })
            ->editColumn('case_date', function ($raw) {
                return (!empty($raw->case_date)) ? date('d/m/Y', strtotime($raw->case_date)) : '' ;
            })
            ->editColumn('incident_date_time', function ($raw) {
                return (!empty($raw->incident_date_time)) ? date('d/m/Y', strtotime($raw->incident_date_time)) : '' ;
            })
            ->editColumn('nispotti_date', function ($raw) {
                return (!empty($raw->nispotti_date)) ? date('d/m/Y', strtotime($raw->nispotti_date)) : '' ;
            })
            ->editColumn('created_at', function ($raw) {
                return (!empty($raw->created_at)) ? date('d/m/Y H:i:s', strtotime($raw->created_at)) : '' ;
            })
            ->editColumn('updated_at', function ($raw) {
                return (!empty($raw->updated_at)) ? date('d/m/Y H:i:s', strtotime($raw->updated_at)) : '' ;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \Casedb  $model
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

        return $model->with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])->selectRaw('*, casedbs.id AS casid')->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active');
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
                    ->orderBy(1)
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
                    ])->pageLength(30);
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
                  ->orderable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center')->name('casedbs.action'),
            Column::make('casid')->title('রেফারেন্স নং'),
            Column::make('district.bn_name')->title('জেলা'),
            Column::make('circle.name')->title('সার্কেল'),
            Column::make('thana.name')->title('থানা'),
            Column::make('cdms_pg_id')->title('মামলার কোড (CDMS)'),
            Column::make('source_of_info')->title('উৎস'),
            Column::make('gr_no')->title('জি আর নং'),
            Column::make('case_no')->title('মামলা নং'),
            Column::make('dhara')->title('ধারা'),
            Column::make('case_date')->title('তারিখ'),
            Column::make('casetype.type')->title('মামলার ধরন'),
            Column::make('casesubtype.type')->title('উপধরন'),
            Column::make('incident_date_time')->title('ঘটনার তারিখ'),
            Column::make('short_dettails')->title('মামলার সারসংক্ষেপ'),
            Column::make('azahar_namio_victims')->title('এজাহার নামীয় আসামির সংখ্যা'),
            Column::make('nispotti_or_multobi')->title('নিস্পত্তি / মুলতবি'),
            Column::make('nispotti_type')->title('নিস্পত্তির ধরন'),
            Column::make('cs_or_fr_no')->title('সিএক্স/এফ আর নং'),
            Column::make('nispotti_date')->title('তারিখ'),
            Column::make('police_report_victim')->title('পুলিশ রিপোর্ট আসামির সংখ্যা'),
            Column::make('number_of_accused')->title('গ্রেফতারকৃত আসামির সংখ্যা'),
            Column::make('jamin_prapto')->title('জামিন প্রাপ্ত'),
            Column::make('polatok')->title('পলাতক'),
            Column::make('azahar_vukto_invistigate')->title('এজাহার বহির্ভুত তদন্তে প্রাপ্ত'),
            Column::make('ovohoti')->title('অব্যহিত প্রাপ্ত'),
            Column::make('sixtyone_recive')->title('১৬১ গ্রহন (পাবলিক)'),
            Column::make('sixtyfour_recive')->title('১৬৪ গ্রহন'),
            Column::make('invistigate_rate')->title('তদন্তের মান'),
            Column::make('comment')->title('মন্তব্য'),
            Column::make('created_at')->title('Input date'),
            Column::make('updated_at')->title('Updated date'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Casedb_'.date('YmdHis');
    }
}
