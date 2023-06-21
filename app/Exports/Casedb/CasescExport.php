<?php

namespace App\Exports\Casedb;

use App\Models\Casedb;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;
use App\Models\CaseType;
use App\Models\Circle;
use App\Models\District;
use App\Models\Thana;

class CasescExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public function collection()
    {
        $request = \request();
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();

            if (! empty($request->input('districtID'))) {
                $dkey = '=';
                $dvalue = $request->input('districtID');
            } else {
                $dkey = '!=';
                $dvalue = 'ss';
            }

            if (! empty($request->input('circleID'))) {
                $ckey = '=';
                $cvalue = $request->input('circleID');
            } else {
                $ckey = '!=';
                $cvalue = 'cc';
            }

            if (! empty($request->input('thanaID'))) {
                $tkey = '=';
                $tvalue = $request->input('thanaID');
            } else {
                $tkey = '!=';
                $tvalue = 'jj';
            }
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();

            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $dkey = '=';
            $dvalue = auth()->user()->districtID;

            if (! empty($request->input('circleID'))) {
                $ckey = '=';
                $cvalue = $request->input('circleID');
            } else {
                $ckey = '!=';
                $cvalue = 'cc';
            }

            if (! empty($request->input('thanaID'))) {
                $tkey = '=';
                $tvalue = $request->input('thanaID');
            } else {
                $tkey = '!=';
                $tvalue = 'jj';
            }
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);

            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            // oc

            $dkey = '=';
            $dvalue = auth()->user()->districtID;

            $tvalue = auth()->user()->thanaID;
            $tkey = '=';

            $thana = Thana::find($request->input('thanaID'));
            $cvalue = $thana->circle_id;
            $ckey = '=';

            // oc
        }

        if (! empty($request->input('form'))) {
            $fkey = '=';
            $fvalue = $from;

            $date = Carbon::parse($fvalue);
            $fvalue = $date->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $to;

            $date = Carbon::parse($tovalue);
            $tovalue = $date->format('Y-m-d').' 23:59:59';
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
        }

        if (! empty($request->input('nispotti_type'))) {
            $nispotti_type = $request->input('nispotti_type');
            $nispotti_type_key = '=';
        } else {
            $nispotti_type = 'DD';
            $nispotti_type_key = '!=';
        }

        if (! empty($request->input('caseTypeID'))) {
            $caseTypeID = $request->input('caseTypeID');
            $caseTypeID_key = '=';
        } else {
            $caseTypeID = '500';
            $caseTypeID_key = '!=';
        }

        if (! empty($request->input('casesubID'))) {
            $casesubID = $request->input('casesubID');
            $casesubID_key = '=';
        } else {
            $casesubID = '500';
            $casesubID_key = '!=';
        }

        if ($request->filled('nispotti_type')) {
           return  $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])
                          ->where('districtID', $dkey, $dvalue)
                          ->where('thanaID', $tkey, $tvalue)
                          ->where('status', 'active')
                          ->where('nispotti_type', $nispotti_type_key, $nispotti_type)
                          ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                          ->whereNotNull('nispotti_date')
                          ->whereBetween('nispotti_date', [$fvalue, $tovalue])
                          ->orderBy('id', 'desc')
                          ->get();
        } else {
           return $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])
                           ->where('districtID', $dkey, $dvalue)
                           ->where('thanaID', $tkey, $tvalue)
                           ->where('status', 'active')
                           ->where('nispotti_type', $nispotti_type_key, $nispotti_type)
                           ->where('case_type', $caseTypeID_key, $caseTypeID)
                           ->where('casesub_type', $casesubID_key, $casesubID)
                           ->whereBetween('case_date', [$fvalue, $tovalue])
                           ->orderBy('id', 'desc')
                           ->get();
        }
    }

    public function headings(): array {

        return [
            'রেফারেন্স নং',
            'জেলা',
            'সার্কেল',
            'থানা',
            'মামলার কোড (CDMS)', 
            'উৎস', 
            'জি আর নং', 
            'মামলা নং',
            'ধারা', 
            'তারিখ',
            'মামলার ধরন', 
            'উপধরন',
            'ঘটনার তারিখ',
            'মামলার সারসংক্ষেপ',
            'এজাহার নামীয় আসামির সংখ্যা',
            'নিস্পত্তি / মুলতবি',
            'নিস্পত্তির ধরন', 
            'সিএক্স/এফ আর নং',
            'তারিখ',
            'পুলিশ রিপোর্ট আসামির সংখ্যা', 
            'গ্রেফতারকৃত আসামির সংখ্যা', 
            'জামিন প্রাপ্ত', 
            'পলাতক',
            'এজাহার বহির্ভুত তদন্তে প্রাপ্ত',
            'অব্যহিত প্রাপ্ত', 
            '১৬১ গ্রহন (পাবলিক)', 
            '১৬১ গ্রহন (পাবলিক)', 
            'তদন্তের মান', 
            'মন্তব্য',
        ];
    }

    public function map($casesc): array {

        if (! empty($casesc->case_date)) {
            $date1 = date('d/m/Y', strtotime($casesc->case_date));
        } else {
            $date1 = '';
        }

        if (! empty($casesc->incident_date_time)) {
            $date2 = date('d/m/Y', strtotime($casesc->incident_date_time));
        } else {
            $date2 = '';
        }

        if (! empty($casesc->nispotti_date)) {
            $date3 = date('d/m/Y', strtotime($casesc->nispotti_date));
        } else {
            $date3 = '';
        }

        if (! empty($casesc->casesubtype)) {
            $tt = $casesc->casesubtype->type;
        } else {
            $tt = '';
        }

        if ($casesc->nispotti_type != 0) {
            $mm = $casesc->nispotti_type;
        } else {
            $mm = '';
        }

        return [
            $casesc->id,
            $casesc->district->bn_name,
            $casesc->circle->name,
            $casesc->thana->bn_name,
            $casesc->cdms_pg_id,
            $casesc->source_of_info,
            $casesc->gr_no,
            $casesc->case_no,
            $casesc->dhara,
            $date1,
            $casesc->casetype->type,
            $tt,
            $date2,
            $casesc->short_dettails,
            $casesc->azahar_namio_victims,
            $casesc->nispotti_or_multobi,
            $mm,
            $casesc->cs_or_fr_no,
            $date3,
            $casesc->police_report_victim,
            $casesc->number_of_accused,
            $casesc->jamin_prapto,
            $casesc->polatok,
            $casesc->azahar_vukto_invistigate,
            $casesc->ovohoti,
            $casesc->sixtyone_recive,
            $casesc->sixtyfour_recive,
            $casesc->invistigate_rate,
            $casesc->comment,
        ];

    }
}
