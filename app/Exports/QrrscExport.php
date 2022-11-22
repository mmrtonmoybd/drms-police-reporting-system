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
            'মূল ঘটনা',
            'ঘটনার ধরণ',
            'ঘটনার সূত্রপাত',
            'ঘটনার সংক্ষিপ্ত বিবরন',
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
        return [
            $qrrsc->id,
            $qrrsc->district->bn_name,
            $qrrsc->thana->name,
            $qrrsc->village_word,
            $qrrsc->source_of_info,
            date('d/m/Y H:i:s', strtotime($qrrsc->date_time_of_incident)),
            date('d/m/Y H:i:s', strtotime($qrrsc->date_time_of_police_news)),
            date('d/m/Y H:i:s', strtotime($qrrsc->date_time_response)),
            $qrrsc->main_event,
            $qrrsc->event_type,
            $qrrsc->begening_of_event,
            $qrrsc->short_dettails,
            $qrrsc->gd_no,
            date('d/m/Y', strtotime($qrrsc->gd_date)),
            $qrrsc->case_no,
            date('d/m/Y', strtotime($qrrsc->case_date)),
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
