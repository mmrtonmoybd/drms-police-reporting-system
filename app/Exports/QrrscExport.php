<?php

namespace App\Exports;

use App\Models\Qrr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class QrrscExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    private $dkey;
    private $dvalue;
    private $tkey;
    private $tvalue;
    private $skey;
    private $svalue;
    private $fvalue;
    private $tovalue;

    public function __construct($dkey, $dvalue, $tkey, $tvalue, $skey, $svalue, $fvalue, $tovalue)
    {
        $this->dkey = $dkey;
        $this->dvalue = $dvalue;
        $this->tkey = $tkey;
        $this->tvalue = $tvalue;
        $this->skey = $skey;
        $this->svalue = $svalue;
        $this->fvalue = $fvalue;
        $this->tovalue = $tovalue;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $qry =  Qrr::with(['district', 'thana'])->where('districtID', $this->dkey, $this->dvalue)
        ->where('thanaID', $this->tkey, $this->tvalue)
        ->where('source_of_info', $this->skey, $this->svalue)
        ->whereBetween('date_time_of_police_news', [$this->fvalue, $this->tovalue])->get();

        // dd($this, $qry);
        return $qry;
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

    public function map($qrrsc): array
    {
        if (!empty($qrrsc->date_time_of_incident)) {
            $date1 = date('d/m/Y H:i:s', strtotime($qrrsc->date_time_of_incident));
        } else {
            $date1 = '';
        }

        if (!empty($qrrsc->date_time_of_police_news)) {
            $date2 = date('d/m/Y H:i:s', strtotime($qrrsc->date_time_of_police_news));
        } else {
            $date2 = '';
        }



        if (!empty($qrrsc->date_time_response)) {
            $date3 = date('d/m/Y H:i:s', strtotime($qrrsc->date_time_response));
        } else {
            $date3 = '';
        }


        if (!empty($qrrsc->gd_date)) {
            $date4 = date('d/m/Y', strtotime($qrrsc->gd_date));
        } else {
            $date4 = '';
        }

        if (!empty($qrrsc->case_date)) {
            $date5 = date('d/m/Y', strtotime($qrrsc->case_date));
        } else {
            $date5 = '';
        }

        if (!empty($qrrsc->delay_in_response)) {
            $minutes = $qrrsc->delay_in_response;
            $hours = intdiv($minutes, 60).':'. ($minutes % 60);
            $minutes = $qrrsc->delay_in_response;

            $hour1 = floor($minutes / 60);
            $minutes2 = ($minutes - floor($minutes / 60) * 60);
            //$isohour = sprintf("%02d:%02d", $hour1, $minutes2);
            $hours = explode('.', str_pad($hour1, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes2, 2, '0', STR_PAD_LEFT));

            //return $hours;
            $date6 = $hours[0].':'.str_pad(mt_rand(0, 59), 2, '0', STR_PAD_LEFT);
        } else {
            $date6 = '';
        }


        return [
            $qrrsc->id,
            $qrrsc->district->bn_name,
            $qrrsc->thana->name,
            $qrrsc->village_word,
            $qrrsc->source_of_info,
            $date1,
            $date2,
            $date3,
            $date6,
            $qrrsc->event_type,
            $qrrsc->begening_of_event,
            $qrrsc->short_dettails,
            $qrrsc->action_taken,
            $qrrsc->gd_no,
            $date4,
            $qrrsc->case_no,
            $date5,
            $qrrsc->clause,
            $qrrsc->nopc,
            $qrrsc->plaintiff_mobile,
            $qrrsc->number_of_victims,
            $qrrsc->number_of_accused,
            $qrrsc->name_of_investigator,
            $qrrsc->bp_no,
            $qrrsc->mobile_no,
            $qrrsc->image_video,
            $qrrsc->media_quality,
            $qrrsc->comments
        ];
    }
}
