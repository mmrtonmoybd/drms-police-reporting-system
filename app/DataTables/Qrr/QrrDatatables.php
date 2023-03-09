<?php

namespace App\DataTables\Qrr;

use App\Models\Qrr;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QrrDatatables extends DataTable
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
            ->editColumn('date_time_of_incident', function ($raw) {
                if (! empty($raw->date_time_of_incident)) {
                    $date = date('d/m/Y H:i:s', strtotime($raw->date_time_of_incident));
                } else {
                    $date = '';
                }

                return $date;
            })
            ->editColumn('date_time_of_police_news', function ($raw) {
                if (! empty($raw->date_time_of_police_news)) {
                    $date = date('d/m/Y H:i:s', strtotime($raw->date_time_of_police_news));
                } else {
                    $date = '';
                }

                return $date;
                //return date('d/m/Y H:i', strtotime($raw->date_time_of_police_news));
            })
            ->editColumn('date_time_response', function ($raw) {
                if (! empty($raw->date_time_response)) {
                    $date = date('d/m/Y H:i:s', strtotime($raw->date_time_response));
                } else {
                    $date = '';
                }

                return $date;
                //return date('d/m/Y H:i', strtotime($raw->date_time_response));
            })
            ->editColumn('delay_in_response', function ($raw) {
                /*
                $minutes = $raw->delay_in_response;
                $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                $minutes = $raw->delay_in_response;

                $hour1 = floor($minutes / 60);
                $minutes2 = ($minutes - floor($minutes / 60) * 60);
                //$isohour = sprintf("%02d:%02d", $hour1, $minutes2);
                $hours = explode('.', str_pad($hour1, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes2, 2, '0', STR_PAD_LEFT));

                return $hours[0].':'.str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);

                */
                $cal = floor($raw->delay_in_response / 3600);

                return  str_pad($cal, 2, '0', STR_PAD_LEFT).gmdate(':i:s', $raw->delay_in_response % 3600);
            })
            ->editColumn('main_event', function ($raw) {
                return Str::limit($raw->main_event, 20);
            })
            ->editColumn('short_dettails', function ($raw) {
                return Str::limit($raw->short_dettails, 5);
            })
            ->editColumn('gd_date', function ($raw) {
                if (! empty($raw->gd_date)) {
                    $date = date('d/m/Y', strtotime($raw->gd_date));
                } else {
                    $date = '';
                }

                return $date;
                //return date('d/m/Y', strtotime($raw->gd_date));
            })
            ->editColumn('case_date', function ($raw) {
                if (! empty($raw->case_date)) {
                    $date = date('d/m/Y', strtotime($raw->case_date));
                } else {
                    $date = '';
                }

                return $date;
                //return date('d/m/Y', strtotime($raw->case_date));
            })
            ->editColumn('comments', function ($raw) {
                return Str::limit($raw->comments, 5);
            })
            ->addColumn('action', function ($row) {
                $actionBtn = '';
                if (auth()->user()->can('qrr.view')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/details/$row->qrrid").'" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                }
                if (auth()->user()->can('qrr.edit')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/edit/$row->qrrid").'" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                }
                if (auth()->user()->can('qrr.review')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/review/update/$row->qrrid").'" class="action-icon">  <i class="fas fa-unlock-alt"></i></a> ';
                }
                if (auth()->user()->can('qrr.delete')) {
                    $actionBtn .= '<a href="'.url("admin/qrrs/delete/$row->qrrid").'"  onclick="return confirm(\'Do you want to delete this qrr?\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                }

                return $actionBtn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \Qrr  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Qrr $model)
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

        return $model->with(['district', 'thana'])->selectRaw('*, qrrs.id AS qrrid')->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('qrrs-table')
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
            Column::make('qrrid')->title('রেফারেন্স নং')->searchable(false),
            Column::make('district.bn_name')->title('জেলা'),
            Column::make('thana.name')->title('থানা'),
            Column::make('village_word')->title('গ্রাম/ওয়ার্ড'),
            Column::make('source_of_info')->title('তথ্য প্রাপ্তির উৎস'),
            Column::make('date_time_of_incident')->title('ঘটনার তারিখ ও সময়'),
            Column::make('date_time_of_police_news')->title('পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময়'),
            Column::make('date_time_response')->title('রেসপন্সের তারিখ ও সময়'),
            Column::make('delay_in_response')->title('রেসপন্সে বিলম্ব'),
            Column::make('event_type')->title('ঘটনার ধরণ'),
            Column::make('begening_of_event')->title('ঘটনার সূত্রপাত'),
            Column::make('short_dettails')->title('ঘটনার সংক্ষিপ্ত বিবরন'),
            Column::make('action_taken')->title('গৃহীত ব্যবস্থা'),
            Column::make('gd_no')->title('জিডি নং'),
            Column::make('gd_date')->title('তারিখ'),
            Column::make('case_no')->title('মামলা নং'),
            Column::make('case_date')->title('তারিখ'),
            Column::make('clause')->title('ধারা'),
            Column::make('nopc')->title('বাদীর/ সংবাদদাতার নাম'),
            Column::make('plaintiff_mobile')->title('বাদীর মোবাইল নং'),
            Column::make('number_of_victims')->title('ভিকটিমের সংখ্যা'),
            Column::make('number_of_accused')->title('এজাহারভুক্ত আসামীর সংখ্যা'),
            Column::make('name_of_investigator')->title('রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম'),
            Column::make('bp_no')->title('বিপি নং'),
            Column::make('mobile_no')->title('মোবাইল নং'),
            Column::make('image_video')->title('ছবি/ভিডিও প্রাপ্তি'),
            Column::make('media_quality')->title('সন্তুষ্টির মান'),
            Column::make('comments')->title('মন্তব্য'),
            Column::make('created_at')->title('Input date'),
            Column::make('updated_at')->title('Update date'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Qrr'.date('YmdHis');
    }
}
