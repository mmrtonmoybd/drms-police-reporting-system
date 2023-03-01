<?php

namespace App\DataTables\Woman;

use App\Models\Woman;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class WomanDataTable extends DataTable
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
                if (auth()->user()->can('woman.view')) {
                    $actionBtn .= '<a href="'.url("admin/woman/view/$row->womanid").'" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                }
                if (auth()->user()->can('woman.edit')) {
                    $actionBtn .= '<a href="'.url("admin/woman/edit/$row->womanid").'" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                }
                if (auth()->user()->can('woman.review')) {
                    $actionBtn .= '<a href="'.url("admin/woman/review/update/$row->womanid").'" class="action-icon">  <i class="fas fa-unlock-alt"></i></a> ';
                }
                if (auth()->user()->can('woman.delete')) {
                    $actionBtn .= '<a href="'.url("admin/woman/delete/$row->womanid").'"  onclick="return confirm(\'Do you want to delete this womens?\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                }

                return $actionBtn;
            })
            ->editColumn('created_at', function ($raw) {
                return (! empty($raw->created_at)) ? date('d/m/Y H:i:s', strtotime($raw->created_at)) : '';
            })
            ->editColumn('updated_at', function ($raw) {
                return (! empty($raw->updated_at)) ? date('d/m/Y H:i:s', strtotime($raw->updated_at)) : '';
            })
            ->editColumn('short_dettails', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->short_dettails, 10);
            })
            ->editColumn('badi_name', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->badi_name, 10);
            })
            ->editColumn('badi_address', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->badi_address, 10);
            })
            ->editColumn('vbadi_name', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->vbadi_name, 10);
            })
            ->editColumn('vbadi_address', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->vbadi_address, 10);
            })
            ->editColumn('investigator_name', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->investigator_name, 10);
            })
            ->editColumn('gd_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->gd_no, 15);
            })
            ->editColumn('mamla_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->mamla_no, 15);
            })
            ->editColumn('complaint_no', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->complaint_no, 15);
            })
            ->editColumn('dhara', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->dhara, 10);
            })
            ->editColumn('comment', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->comment, 10);
            })
            ->editColumn('wdate', function ($raw) {
                return (! empty($raw->wdate)) ? date('d/m/Y H:i', strtotime($raw->wdate)) : '';
            })
            ->editColumn('gd_date', function ($raw) {
                return (! empty($raw->gd_date)) ? date('d/m/Y H:i', strtotime($raw->gd_date)) : '';
            })
            ->editColumn('mamla_date', function ($raw) {
                return (! empty($raw->mamla_date)) ? date('d/m/Y H:i', strtotime($raw->mamla_date)) : '';
            })
            ->editColumn('complaint_date', function ($raw) {
                return (! empty($raw->complaint_date)) ? date('d/m/Y H:i', strtotime($raw->complaint_date)) : '';
            })->setRowClass(function ($raw) {
                return (! $raw->satisfy_rate == '') ? 'greenraw' : '';
            })->setRowId('womanid');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \Woman  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Woman $model)
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

        return $model->with(['district', 'thana'])->selectRaw('*, womens.id AS womanid')->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('woman-table')
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
                  ->width(60)
                  ->orderable(false)
                  ->searchable(false)
                  ->addClass('text-center'),
            Column::make('womanid')
                  ->searchable(false)->title('ID'),
            Column::make('reference_no')->title('রেফারেন্স নং'),
            Column::make('district.bn_name')->title('জেলা'),
            Column::make('thana.name')->title('থানা'),
            Column::make('village_word')->title('গ্রাম/ওয়ার্ড'),
            Column::make('wdate')->title('আগমনের তারিখ ও সময়'),
            Column::make('event_type')->title('ঘটনার ধরণ'),
            Column::make('begening_of_event')->title('ঘটনার সূত্রপাত'),
            Column::make('short_dettails')->title('ঘটনার সংক্ষিপ্ত বিবরন'),
            Column::make('badi_name')->title('বাদীর নাম'),
            Column::make('victim_type')->title('ভিকটিমের ধরন'),
            Column::make('badi_phone')->title('বাদীর মোবাইল নং'),
            Column::make('badi_age')->title('বাদীর বয়স'),
            Column::make('badi_address')->title('বাদীর ঠিকানা'),
            Column::make('vbadi_name')->title('বিবাদীর নাম'),
            Column::make('vbadi_address')->title('বিবাদীর ঠিকানা'),
            Column::make('complaint_reson')->title('অভিযুক্তের সংখ্যা'),
            Column::make('investigator_name')->title('তদন্তকারী কর্মকর্তার নাম ও পদবি'),
            Column::make('investigator_title')->title('তদন্তকারী কর্মকর্তার বিপি নাম্বার'),
            Column::make('mobile_no')->title('মোবাইল নং'),
            Column::make('gd_no')->title('জিডি নং'),
            Column::make('gd_date')->title('তারিখ'),
            Column::make('mamla_no')->title('মামলা নং'),
            Column::make('mamla_date')->title('তারিখ'),
            Column::make('dhara')->title('ধারা'),
            Column::make('complaint_no')->title('অভিযোগ নং'),
            Column::make('complaint_date')->title('তারিখ'),
            Column::make('problem_fix')->title('সমস্যা সমাধান হয়েছে কিনা'),
            Column::make('action_taken')->title('গৃহীত ব্যবস্থা'),
            Column::make('nreport')->title('নিষ্পত্তি রিপোর্ট'),
            Column::make('satisfy_rate')->title('সন্তুষ্টির মান'),
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
        return 'Woman_'.date('YmdHis');
    }
}
