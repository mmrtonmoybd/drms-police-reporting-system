<?php

namespace App\Exports;

use App\Models\Qrr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class QrrsviewExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;
    private $qrrid;

    public function forId(int $qrrid)
    {
        $this->qrrid = $qrrid;

        return $this;
    }


    public function query()
    {
        return Qrr::with(['district', 'thana'])->where('id', $this->qrrid);
    }

     public function headings(): array
     {
         return [
             'রেফারেন্স নং',
             'জেলা',
             'থানা',
             'গ্রাম/ওয়ার্ড',
             'তথ্য প্রাপ্তির উৎস',
             'ঘটনার তারিখ ও সময়',
             'পুলিশের সংবাদ প্রাপ্তির তারিখ ও সময়',
             'রেসপন্সের তারিখ ও সময়',
             'রেসপন্সে বিলম্ব',
             'ঘটনার ধরণ',
             'ঘটনার সূত্রপাত',
             'ঘটনার সংক্ষিপ্ত বিবরন',
             'গৃহীত ব্যবস্থা',
             'জিডি নং',
             'তারিখ',
             'মামলা নং',
             'তারিখ',
             'ধারা',
             'বাদীর/ সংবাদদাতার নাম',
             'বাদীর মোবাইল নং',
             'ভিকটিমের সংখ্যা',
             'এজাহারভুক্ত আসামীর সংখ্যা',
             'রেসপন্সকারী/ তদন্তকারী কর্মকর্তার নাম',
             'বিপি নং',
             'মোবাইল নং',
             'ছবি/ভিডিও প্রাপ্তি',
             'সন্তুষ্টির মান',
             'মন্তব্য'
         ];
     }

    public function map($qrrview): array
    {
        if (!empty($qrrview->date_time_of_incident)) {
            $date1 = date('d/m/Y H:i:s', strtotime($qrrview->date_time_of_incident));
        } else {
            $date1 = '';
        }

        if (!empty($qrrview->date_time_of_police_news)) {
            $date2 = date('d/m/Y H:i:s', strtotime($qrrview->date_time_of_police_news));
        } else {
            $date2 = '';
        }



        if (!empty($qrrview->date_time_response)) {
            $date3 = date('d/m/Y H:i:s', strtotime($qrrview->date_time_response));
        } else {
            $date3 = '';
        }


        if (!empty($qrrview->gd_date)) {
            $date4 = date('d/m/Y', strtotime($qrrview->gd_date));
        } else {
            $date4 = '';
        }

        if (!empty($qrrview->case_date)) {
            $date5 = date('d/m/Y', strtotime($qrrview->case_date));
        } else {
            $date5 = '';
        }

        if (!empty($qrrview->delay_in_response)) {
            $cal = floor($qrrview->delay_in_response / 3600);
            $date6 = str_pad($cal, 2, '0', STR_PAD_LEFT) . gmdate(":i:s", $qrrview->delay_in_response % 3600);
        } else {
            $date6 = '';
        }


        return [
            $qrrview->id,
            $qrrview->district->bn_name,
            $qrrview->thana->name,
            $qrrview->village_word,
            $qrrview->source_of_info,
            $date1,
            $date2,
            $date3,
            $date6,
            $qrrview->event_type,
            $qrrview->begening_of_event,
            $qrrview->short_dettails,
            $qrrview->action_taken,
            $qrrview->gd_no,
            $date4,
            $qrrview->case_no,
            $date5,
            $qrrview->clause,
            $qrrview->nopc,
            $qrrview->plaintiff_mobile,
            $qrrview->number_of_victims,
            $qrrview->number_of_accused,
            $qrrview->name_of_investigator,
            $qrrview->bp_no,
            $qrrview->mobile_no,
            $qrrview->image_video,
            $qrrview->media_quality,
            $qrrview->comments
        ];
    }
}
