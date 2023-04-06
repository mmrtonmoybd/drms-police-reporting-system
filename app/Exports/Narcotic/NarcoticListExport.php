<?php

namespace App\Exports\Narcotic;

use App\Models\Narcotic;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class NarcoticListExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data = $query->where('status', 'active')->get();
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data = $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->get();
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data = $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->get();
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'রেফারেন্স নং',
            'ট্র্যাকিং নং',
            'ফোল্ডার নং',
            'জেলা',
            'থানা',
            'গ্রাম/ওয়ার্ড',
            'ঘটনার তারিখ',
            'মামলা নং',
            'ধারা',
            'অভিযান পরিচালনাকারী সংস্থা',
            'অভিযান পরিচালনাকারী অফিসার',
            'বিপি নং',
            'মোবাইল নং',
            'গাঁজা (গ্রাম)',
            'গাঁজা গাছ (সংখ্যা)',
            'ইয়াবা (পিচ)',
            'ইরোইন (গ্রাম)	',
            'ফেনসিডিল (বোতল)	',
            'চোলাই মদ (লিটার)	',
            'বিদেশী মদ (লিটার)	',
            'এলএসডি (মাইক্রোগ্রাম)	',
            'আইস (মাইক্রোগ্রাম)	',
            'আন্যান্য',
            'গ্রেফতারকৃত আসামীর সংখ্যা	',
            'অভিযুক্ত',
            'ছবি তোলা হয়েছে	',
            'জব্দ তালিকা	',
            'মাদকের রিপোর্ট প্রাপ্তি	',
            'তদন্তের ফলাফল (CS নং)	',
            'তারিখ',
            'মন্তব্য',
        ];
    }

    public function map($nar): array
    {
        if (! empty($nar->sdate)) {
            $date1 = date('d/m/Y', strtotime($nar->sdate));
        } else {
            $date1 = '';
        }

        if (! empty($nar->tdate)) {
            $date2 = date('d/m/Y', strtotime($nar->tdate));
        } else {
            $date2 = '';
        }

        return [
            $nar->id,
            $nar->trakingID,
            $nar->folder_no,
            $nar->district->bn_name,
            $nar->thana->name,
            $nar->village_word,
            $date1,
            $nar->case_no,
            $nar->nopc,
            $nar->name_of_investigator_org,
            $nar->name_of_investigator,
            $nar->bp_no,
            $nar->mobile_no,
            $nar->gaza,
            $nar->gaza_tree,
            $nar->yaba,
            $nar->heroine,
            $nar->fansdel,
            (int) $nar->cholai_alcohol / 1000,
            (int) $nar->bidesh_alcohol / 1000,
            $nar->lsd,
            $nar->ice,
            $nar->otherd,
            $nar->number_of_accused,
            $nar->accused,
            $nar->image_video,
            $nar->jobdo_list,
            $nar->narocotic_test_report,
            $nar->investigate_result,
            $date2,
            $nar->comment,
        ];
    }
}
