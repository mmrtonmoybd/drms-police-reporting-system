<?php

namespace App\DataTables\Narcotic;

use App\Models\Narcotic;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NarcoticDataTable extends DataTable
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
                if (auth()->user()->can('narcotic.view')) {
                    $actionBtn .= '<a href="'.url("admin/narcotic/view/$row->narcoticsid").'" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                }
                if (auth()->user()->can('narcotic.edit')) {
                    $actionBtn .= '<a href="'.url("admin/narcotic/edit/$row->narcoticsid").'" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                }
                if (auth()->user()->can('narcotic.review')) {
                    $actionBtn .= '<a href="'.url("admin/narcotic/review/update/$row->narcoticsid").'" class="action-icon">  <i class="fas fa-unlock-alt"></i></a> ';
                }
                if (auth()->user()->can('narcotic.delete')) {
                    $actionBtn .= '<a href="'.url("admin/narcotic/delete/$row->narcoticsid").'"  onclick="return confirm(\'Do you want to delete this narcotic?\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                }

                return $actionBtn;
            })
            ->editColumn('created_at', function ($raw) {
                return (! empty($raw->created_at)) ? date('d/m/Y H:i:s', strtotime($raw->created_at)) : '';
            })
            ->editColumn('updated_at', function ($raw) {
                return (! empty($raw->updated_at)) ? date('d/m/Y H:i:s', strtotime($raw->updated_at)) : '';
            })
            ->editColumn('village_word', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->village_word, 10);
            })
            ->editColumn('nopc', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->nopc, 10);
            })
            ->editColumn('name_of_investigator', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->name_of_investigator, 50);
            })
            ->editColumn('accused', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->accused, 50);
            })
            ->editColumn('narocotic_test_report', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->narocotic_test_report, 10);
            })
            ->editColumn('investigate_result', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->investigate_result, 15);
            })
            ->editColumn('comment', function ($raw) {
                return \Illuminate\Support\Str::limit($raw->comment, 5);
            })
            ->editColumn('sdate', function ($raw) {
                return (! empty($raw->sdate)) ? date('d/m/Y', strtotime($raw->sdate)) : '';
            })
            ->editColumn('tdate', function ($raw) {
                return (! empty($raw->tdate)) ? date('d/m/Y', strtotime($raw->tdate)) : '';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \Narcotic  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Narcotic $model)
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

        return $model->with(['district', 'thana'])->selectRaw('*, narcotics.id AS narcoticsid')->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('narcotic-table')
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
            Column::make('narcoticsid')->title('ট্র্যাকিং নং'),
            Column::make('folder_no')->title('ফোল্ডার নং'),
            Column::make('district.bn_name')->title('জেলা'),
            Column::make('thana.name')->title('থানা'),
            Column::make('village_word')->title('গ্রাম/ওয়ার্ড'),
            Column::make('sdate')->title('মামলার তারিখ'),
            Column::make('case_no')->title('মামলা নং'),
            Column::make('nopc')->title('ধারা'),
            Column::make('name_of_investigator_org')->title('অভিযান পরিচালনাকারী সংস্থা'),
            Column::make('name_of_investigator')->title('অভিযান পরিচালনাকারী অফিসার'),
            Column::make('bp_no')->title('বিপি নং'),
            Column::make('mobile_no')->title('মোবাইল নং'),
            Column::make('gaza')->title('গাঁজা (গ্রাম)'),
            Column::make('gaza_tree')->title('গাঁজা গাছ (সংখ্যা)'),
            Column::make('yaba')->title('ইয়াবা (পিচ)'),
            Column::make('heroine')->title('ইরোইন (গ্রাম)'),
            Column::make('fansdel')->title('ফেনসিডিল (বোতল)'),
            Column::make('cholai_alcohol')->title('চোলাই মদ (লিটার)'),
            Column::make('bidesh_alcohol')->title('বিদেশী মদ (লিটার)'),
            Column::make('lsd')->title('এলএসডি (মাইক্রোগ্রাম)'),
            Column::make('ice')->title('আইস (মাইক্রোগ্রাম)'),
            Column::make('otherd')->title('আন্যান্য'),
            Column::make('number_of_accused')->title('গ্রেফতারকৃত আসামীর সংখ্যা'),
            Column::make('accused')->title('অভিযুক্ত'),
            Column::make('image_video')->title('ছবি তোলা হয়েছে'),
            Column::make('jobdo_list')->title('জব্দ তালিকা'),
            Column::make('narocotic_test_report')->title('মাদকের রিপোর্ট প্রাপ্তি'),
            Column::make('investigate_result')->title('তদন্তের ফলাফল (CS নং)'),
            Column::make('tdate')->title('তারিখ'),
            Column::make('comment')->title('মন্তব্য'),
            Column::make('updated_at')->title('Updated date'),
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
        return 'Narcotic_'.date('YmdHis');
    }
}
