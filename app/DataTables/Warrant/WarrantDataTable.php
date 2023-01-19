<?php

namespace App\DataTables\Warrant;

use App\Models\Warrant;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WarrantDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                if (auth()->user()->can('warrant.view')) {
                    $actionBtn .= '<a href="'.url("admin/warrant/view/$row->warrantid").'" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                }
                if (auth()->user()->can('warrant.edit')) {
                    $actionBtn .= '<a href="'.url("admin/warrant/edit/$row->warrantid").'" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                }
                if (auth()->user()->can('warrant.review')) {
                    $actionBtn .= '<a href="'.url("admin/warrant/review/update/$row->warrantid").'" class="action-icon">  <i class="fas fa-unlock-alt"></i></a> ';
                }
                if (auth()->user()->can('warrant.delete')) {
                    $actionBtn .= '<a href="'.url("admin/warrant/delete/$row->warrantid").'"  onclick="return confirm(\'Do you want to delete this warrant?\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                }

                return $actionBtn;
            })
            ->addColumn('totalrecive', function ($raw) {
                return $raw->gr_recive + $raw->cr_recive + $raw->saja_gr_recive + $raw->saja_cr_recive;
            })
            ->addColumn('totaltamil', function ($raw) {
                return $raw->gr_tamil + $raw->cr_tamil + $raw->saja_gr_tamil + $raw->saja_cr_tamil;
            })
            ->addColumn('totalnispotti', function ($raw) {
                return $raw->gr_tamil + $raw->cr_tamil + $raw->saja_gr_tamil + $raw->saja_cr_tamil + $raw->recall_other;
            })
            ->addColumn('dayend', function ($raw) {
                $get = \App\Models\Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS day_endp')
    ->where('districtID', $raw->districtID)
    ->where('id', '<=', $raw->warrantid)->first();

                return (intval($get->day_endp) >= 0) ? intval($get->day_endp) : 0;
            })
            ->editColumn('created_at', function ($raw) {
                return (! empty($raw->created_at)) ? date('d/m/Y H:i:s', strtotime($raw->created_at)) : '';
            })
            ->editColumn('updated_at', function ($raw) {
                return (! empty($raw->updated_at)) ? date('d/m/Y H:i:s', strtotime($raw->updated_at)) : '';
            })
            ->editColumn('date', function ($raw) {
                return (! empty($raw->date)) ? date('d/m/Y', strtotime($raw->date)) : '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \Warrant  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Warrant $model)
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

        return $model->with(['district', 'thana'])->selectRaw('*, warrants.id AS warrantid')->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('warrant-table')
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
                  ->addClass('text-center'),
            Column::make('warrantid')->title('রেফারেন্স নং'),
            Column::make('district.bn_name')->title('জেলা'),
            Column::make('thana.name')->title('থানা'),
            Column::make('date')->title('তারিখ'),
            Column::make('gr_recive')->title('জিআর রিসিভ'),
            Column::make('cr_recive')->title('সিআর রিসিভ'),
            Column::make('saja_gr_recive')->title('সাজা জিআর রিসিভ'),
            Column::make('saja_cr_recive')->title('সাজা সিআর রিসিভ'),
            Column::computed('totalrecive')->title('মোট রিসিভ'),
            Column::make('gr_tamil')->title('জিআর তামিল'),
            Column::make('cr_tamil')->title('সিআর তামিল'),
            Column::make('saja_gr_tamil')->title('সাজা জিআর তামিল'),
            Column::make('saja_cr_tamil')->title('সাজা সিআর তামিল'),
            Column::make('recall_other')->title('রিকল ও অন্যান্য'),
            Column::computed('totaltamil')->title('মোট তামিল'),
            Column::computed('totalnispotti')->title('মোট নিষ্পত্তি'),
            Column::computed('dayend')->title('দিনশেষে পেন্ডিং'),
            Column::make('updated_at')->title('Updated at'),
            Column::make('created_at')->title('Input date'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Warrant_'.date('YmdHis');
    }
}
