<?php

namespace App\Exports\Woman;

use App\Models\Woman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class WomanListExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $dvalue = 'kglf';
            $dkey = '!=';
            $tvalue = 'kkdk';
            $tkey = '!=';
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = 'kkdk';
            $tkey = '!=';
        } else {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = auth()->user()->thanaID;
            $tkey = '=';
        }

        return Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'রেফারেন্স নং',
            'জেলা',
            'থানা',
            'গ্রাম/ওয়ার্ড',
            'আগমনের তারিখ ও সময়',
            'ঘটনার ধরণ',
            'ঘটনার সূত্রপাত',
            'ঘটনার সংক্ষিপ্ত বিবরন',
            'বাদীর নাম',
            'বাদীর বয়স',
            'বাদীর ঠিকানা',
            'বাদীর মোবাইল নং',
            'বিবাদীর নাম',
            'বিবাদীর ঠিকানা',
            'অভিযুক্তের সংখ্যা',
            'তদন্তকারী কর্মকর্তার নাম',
            'তদন্তকারী কর্মকর্তার বিপি নাম্বার',
            'মোবাইল নং',
            'জিডি নং',
            'তারিখ',
            'মামলা নং',
            'তারিখ',
            'ধারা',
            'অভিযোগ নং',
            'তারিখ',
            'সমস্যা সমাধান হয়েছে কিনা',
            'গৃহীত ব্যবস্থা',
            'নিষ্পত্তি রিপোর্ট',
            'সন্তুষ্টির মান',
            'মন্তব্য'
        ];
    }

    public function map($woman): array
    {
        if (!empty($woman->wdate)) {
            $date1 = date('d/m/Y H:i', strtotime($woman->wdate));
        } else {
            $date1 = '';
        }

        if (!empty($woman->gd_date)) {
            $date2 = date('d/m/Y', strtotime($woman->gd_date));
        } else {
            $date2 = '';
        }

        if (!empty($woman->mamla_date)) {
            $date3 = date('d/m/Y', strtotime($woman->mamla_date));
        } else {
            $date3 = '';
        }

        if (!empty($woman->complaint_date)) {
            $date4 = date('d/m/Y', strtotime($woman->complaint_date));
        } else {
            $date4 = '';
        }

        return [
            $woman->id,
            $woman->reference_no,
            $woman->district->bn_name,
            $woman->thana->bn_name,
            $woman->village_word,
            $date1,
            $woman->event_type,
            $woman->begening_of_event,
            $woman->short_dettails,
            $woman->badi_name,
            $woman->badi_age,
            $woman->badi_address,
            $woman->badi_phone,
            $woman->vbadi_name,
            $woman->vbadi_address,
            $woman->complaint_reson,
            $woman->investigator_name,
            $woman->investigator_title,
            $woman->mobile_no,
            $woman->gd_no,
            $date2,
            $woman->mamla_no,
            $date3,
            $woman->dhara,
            $woman->complaint_no,
            $date4,
            $woman->problem_fix,
            $woman->action_taken,
            $woman->nreport,
            $woman->satisfy_rate,
            $woman->comment
        ];
    }
}
