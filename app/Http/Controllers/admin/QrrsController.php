<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Qrr;
use App\Models\District;
use App\Models\Thana;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use DataTables;
use Illuminate\Support\Str;
use App\Exports\QrrsviewExport;
use App\Exports\QrrscExport;
use \PDF;

class QrrsController extends Controller
{
    public function __construct()
    {
    }

    //This method list all users
    public function Index(Request $request)
    {
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        $request->session()->put('disexp', $disexp);
        $request->session()->put('disid', $disid);
        $request->session()->put('thaexp', $thaexp);
        $request->session()->put('thaid', $thaid);
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/qrr/qrrs', $data);
    }

    public function qrrinajax(Request $request)
    {
        $disexp = $request->session()->get('disexp');
        $disid = $request->session()->get('disid');
        $thaexp = $request->session()->get('thaexp');
        $thaid = $request->session()->get('thaid');

        //dd($disexp);

        $query = Qrr::query();
        $query->with(['district', 'thana']);
        $qrr = $query->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid);

        return Datatables::of($qrr)
                ->setRowId('id')
                ->editColumn('date_time_of_incident', function ($raw) {
                    return date('d/m/Y h:i A', strtotime($raw->date_time_of_incident));
                })
                ->editColumn('date_time_of_police_news', function ($raw) {
                    return date('d/m/Y h:i A', strtotime($raw->date_time_of_police_news));
                })
                ->editColumn('date_time_response', function ($raw) {
                    return date('d/m/Y h:i A', strtotime($raw->date_time_response));
                })
                ->editColumn('delay_in_response', function ($raw) {
                    $minutes = $raw->delay_in_response;
                    $hours = intdiv($minutes, 60).':'. ($minutes % 60);
                    $minutes = $raw->delay_in_response;
                    $hours = floor($minutes / 60).':'.($minutes - floor($minutes / 60) * 60).':00';
                    return $hours;
                })
                ->editColumn('main_event', function ($raw) {
                    return Str::limit($raw->main_event, 20);
                })
                ->editColumn('short_dettails', function ($raw) {
                    return Str::limit($raw->short_dettails, 5);
                })
                ->editColumn('gd_date', function ($raw) {
                    return date('d/m/Y', strtotime($raw->gd_date));
                })
                ->editColumn('case_date', function ($raw) {
                    return date('d/m/Y', strtotime($raw->case_date));
                })
                ->editColumn('comments', function ($raw) {
                    return Str::limit($raw->comments, 5);
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if (auth()->user()->can('qrr.view')) {
                        $actionBtn .= '<a href="' . url("admin/qrrs/details/$row->id") .'" class="action-icon text-primary"><i class="mdi mdi-eye"></i></a> ';
                    }
                    if (auth()->user()->can('qrr.edit')) {
                        $actionBtn .= '<a href="' . url("admin/qrrs/edit/$row->id") .'" class="action-icon">  <i class="mdi mdi-square-edit-outline"></i></a> ';
                    }
                    if (auth()->user()->can('qrr.delete')) {
                        $actionBtn .= '<a href="' . url("admin/qrrs/delete/$row->id") . '"  onclick="return confirm("Do you want to delete this qrr?")" class="action-icon"> <i class="mdi mdi-delete"></i></a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    public function report(Request $request, $report)
    {
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        $query = Qrr::query();
        $query->with(['district', 'thana']);
        $data['qrrs'] = $query->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->orderBy('id', 'desc')->where('event_type', $report)->paginate(20);
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/qrr/qrrsr', $data);
    }

    public function chart(Request $request)
    {
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        // $from = Carbon::parse();
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (!empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (!empty($request->input('thanaID'))) {
            $tkey = '=';
            $tvalue = $request->input('thanaID');
        } else {
            $tkey = '!=';
            $tvalue = 'jj';
        }

        if (!empty($request->input('source_of_info'))) {
            $skey = '=';
            $svalue = $request->input('source_of_info');
        } else {
            $skey = '!=';
            $svalue = 'gg';
        }

        if (!empty($request->input('form'))) {
            $fkey = '=';
            $fvalue = $from;

            $date = Carbon::parse($fvalue);
            $fvalue = $date->format('Y-m-d') . ' 00:00:00';
        //dd($ggg);
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (!empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $to;

            $date = Carbon::parse($tovalue);
            $tovalue = $date->format('Y-m-d') . ' 23:59:59';
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
        }

        if (($dvalue !== 'ss')) {
            $sdis = District::find($request->input('districtID'));
        }

        if (($tvalue !== 'jj')) {
            $sthan = Thana::find($request->input('thanaID'));
        }

        $data['sdisn'] = ($dvalue !== 'ss') ? $sdis : 'খালি';
        $data['sthan'] = ($tvalue !== 'jj') ? $sthan : 'খালি';
        $data['ssoun'] = ($svalue !== 'gg') ? $svalue : 'খালি';
        $data['ssdate'] = (!empty($request->input('form'))) ? $request->input('form') : 'খালি';
        $data['stdate'] = (!empty($request->input('form'))) ? $request->input('to') : 'খালি';



        //\DB::enableQueryLog();
        // $query = ;
        // $query->with(['district', 'thana']);
        $data['qrrs'] = Qrr::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        Session::put('dkey', $dkey);
        Session::put('dvalue', $dvalue);
        Session::put('tkey', $tkey);
        Session::put('tvalue', $tvalue);
        Session::put('skey', $skey);
        Session::put('svalue', $svalue);
        Session::put('fvalue', $fvalue);
        Session::put('tovalue', $tovalue);
        Session::save();

        // dd($data['qrrs'], $from, $to, \DB::getQueryLog());

        //dd(\DB::getQueryLog());

        //$query->where('districtID', '=', $request->input('districtID'))
        //->orWhere('thanaID', '=', $request->input('thanaID'))
        //->orWhere('source_of_info', '=', $request->input('source_of_info'))->orWhereDate('date_time_of_police_news', '=', $request->input('form'))
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            foreach ($spthana as $key => $value) {
                $dd = Qrr::where('thanaID', $value->id)->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

                $data['spthana'][$key] =  [($dd !== 0) ? $dd : '', $value->bn_name, $value->id];
            }

            $request->session()->flash('spthana', $data['spthana']);

            $data['qrrs'] = Qrr::where('districtID', $disexp, $disid)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        Session::put('dkey', $disexp);
        Session::put('dvalue', $disid);
        Session::put('tkey', $tkey);
        Session::put('tvalue', $tvalue);
        Session::put('skey', $skey);
        Session::put('svalue', $svalue);
        Session::put('fvalue', $fvalue);
        Session::put('tovalue', $tovalue);
        Session::save();


        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            $dd = Qrr::where('thanaID', $octhana->id)->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $val =  ($dd !== 0) ? $dd : '';

            $request->session()->flash('octhananame', $octhana->bn_name);
            $request->session()->flash('octhanavalue', $val);
            $request->session()->flash('octhanaid', $octhana->id);

            $data['qrrs'] = Qrr::where('districtID', $disexp, $disid)
        ->where('thanaID', $thaexp, $thaid)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        Session::put('dkey', $disexp);
        Session::put('dvalue', $disid);
        Session::put('tkey', $thaexp);
        Session::put('tvalue', $thaid);
        Session::put('skey', $skey);
        Session::put('svalue', $svalue);
        Session::put('fvalue', $fvalue);
        Session::put('tovalue', $tovalue);
        Session::save();

        
        }

        //dd($data['qrrs']);
        //  return view('admin/qrr/qrrs-s', $data);

        if (auth()->user()->hasRole('Super Admin')) {
            $borgona = Qrr::where('districtID', 34)->where('source_of_info', $skey, $svalue)
            ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $barisal = Qrr::where('districtID', 35)->where('source_of_info', $skey, $svalue)
            ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $bhola = Qrr::where('districtID', 36)->where('source_of_info', $skey, $svalue)
            ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $jalokhati = Qrr::where('districtID', 37)->where('source_of_info', $skey, $svalue)
            ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $patuakhali = Qrr::where('districtID', 38)->where('source_of_info', $skey, $svalue)
            ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $pirojpur = Qrr::where('districtID', 39)->where('source_of_info', $skey, $svalue)
            ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

            $request->session()->flash('borgona', ($borgona !== 0) ? $borgona : '');
            $request->session()->flash('barisal', ($barisal !== 0) ? $barisal : '');
            $request->session()->flash('bhola', ($bhola !== 0) ? $bhola : '');
            $request->session()->flash('jalokhati', ($jalokhati !== 0) ? $jalokhati : '');
            $request->session()->flash('patuakhali', ($patuakhali !== 0) ? $patuakhali : '');
            $request->session()->flash('pirojpur', ($pirojpur !== 0) ? $pirojpur : '');
        }

        $data['tin'] = Qrr::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $data['tcat'] = Qrr::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->whereNotNull('case_no')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();


        $inscou = Qrr::where('source_of_info', 'কোর্ট')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $ins99 = Qrr::where('source_of_info', '৯৯৯')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $insala = Qrr::where('source_of_info', 'এলাকা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $instha = Qrr::where('source_of_info', 'থানা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $request->session()->flash('inscou', $inscou);
        $request->session()->flash('ins99', $ins99);
        $request->session()->flash('insala', $insala);
        $request->session()->flash('instha', $instha);

        $etmara = Qrr::where('event_type', 'মারামারি')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etkun = Qrr::where('event_type', 'খুন')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etchori = Qrr::where('event_type', 'চুরি')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etdakati = Qrr::where('event_type', 'ডাকাতি')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etsompds = Qrr::where('event_type', 'বিরোধ')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etsorokd = Qrr::where('event_type', 'সড়ক দুর্ঘটনা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etnarios = Qrr::where('event_type', 'নারী ও শিশু')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etagun = Qrr::where('event_type', 'অগ্নিকান্ড')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etmadok = Qrr::where('event_type', 'মাদক')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etcyber = Qrr::where('event_type', 'সাইবার')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etprota = Qrr::where('event_type', 'প্রতারণা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etrajnoi = Qrr::where('event_type', 'দুর্ঘটনা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etonno = Qrr::where('event_type', 'অন্যান্য')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etnikoj = Qrr::where('event_type', 'নিখোঁজ-অপহরণ')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etdusht = Qrr::where('event_type', 'দস্যুতা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $etjua = Qrr::where('event_type', 'জুয়া')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();


        $request->session()->flash('etmara', ($etmara !== 0) ? $etmara : '');
        $request->session()->flash('etkun', ($etkun !== 0) ? $etkun : '');
        $request->session()->flash('etchori', ($etchori !== 0) ? $etchori : '');
        $request->session()->flash('etdakati', ($etdakati !== 0) ? $etdakati : '');
        $request->session()->flash('etsompds', ($etsompds !== 0) ? $etsompds : '');
        $request->session()->flash('etsorokd', ($etsorokd !== 0) ? $etsorokd : '');
        $request->session()->flash('etnarios', ($etnarios !== 0) ? $etnarios : '');
        $request->session()->flash('etagun', ($etagun !== 0) ? $etagun : '');
        $request->session()->flash('etmadok', ($etmadok !== 0) ? $etmadok : '');
        $request->session()->flash('etcyber', ($etcyber !== 0) ? $etcyber : '');
        $request->session()->flash('etprota', ($etprota !== 0) ? $etprota : '');
        $request->session()->flash('etrajnoi', ($etrajnoi !== 0) ? $etrajnoi : '');
        $request->session()->flash('etonno', ($etonno !== 0) ? $etonno : '');
        $request->session()->flash('etnikoj', ($etnikoj !== 0) ? $etnikoj : '');
        $request->session()->flash('etdusht', ($etdusht !== 0) ? $etdusht : '');
        $request->session()->flash('etjua', ($etjua !== 0) ? $etjua : '');




        return view('admin/qrr/qrrsg', $data);
    }

    public function qrrscexcel(Request $request)
    {
        $dkey = Session::get('dkey');
        $dvalue = Session::get('dvalue');
        $tkey = Session::get('tkey');
        $tvalue = Session::get('tvalue');
        $skey = Session::get('skey');
        $svalue = Session::get('svalue');
        $fvalue = Session::get('fvalue');
        $tovalue = Session::get('tovalue');

        //dd(Session::all());

        $name = uniqid('qrrsc_');

        return (new QrrscExport($dkey, $dvalue, $tkey, $tvalue, $skey, $svalue, $fvalue, $tovalue))->download($name.'.xlsx');
    }

    public function qrrspdf(Request $request)
    {
        $dkey = Session::get('dkey');
        $dvalue = Session::get('dvalue');
        $tkey = Session::get('tkey');
        $tvalue = Session::get('tvalue');
        $skey = Session::get('skey');
        $svalue = Session::get('svalue');
        $fvalue = Session::get('fvalue');
        $tovalue = Session::get('tovalue');

        //dd(Session::all());

        $data['qrrs'] =  Qrr::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->get();

       // dd($this, $qry);
       return view('admin/qrr/qrrscpdf', $data);
    }


    public function chartdata(Request $request)
    {
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        // $from = Carbon::parse();
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (!empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (!empty($request->input('thanaID'))) {
            $tkey = '=';
            $tvalue = $request->input('thanaID');
        } else {
            $tkey = '!=';
            $tvalue = 'jj';
        }

        if (!empty($request->input('source_of_info'))) {
            $skey = '=';
            $svalue = $request->input('source_of_info');
        } else {
            $skey = '!=';
            $svalue = 'gg';
        }

        if (!empty($request->input('eventtype'))) {
            $ekey = '=';
            $evalue = $request->input('eventtype');
        } else {
            $ekey = '!=';
            $evalue = 'jpend';
        }

        if (!empty($request->input('form'))) {
            $fkey = '=';
            $fvalue = $from;

            $date = Carbon::parse($fvalue);
            $fvalue = $date->format('Y-m-d') . ' 00:00:00';
        //dd($ggg);
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (!empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $to;

            $date = Carbon::parse($tovalue);
            $tovalue = $date->format('Y-m-d') . ' 23:59:59';
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
        }

        if (($dvalue !== 'ss')) {
            $sdis = District::find($request->input('districtID'));
        }

        if (($tvalue !== 'jj')) {
            $sthan = Thana::find($request->input('thanaID'));
        }

        $data['sdisn'] = ($dvalue !== 'ss') ? $sdis : 'খালি';
        $data['sthan'] = ($tvalue !== 'jj') ? $sthan : 'খালি';
        $data['ssoun'] = ($svalue !== 'gg') ? $svalue : 'খালি';
        $data['ssdate'] = (!empty($request->input('form'))) ? $request->input('form') : 'খালি';
        $data['stdate'] = (!empty($request->input('form'))) ? $request->input('to') : 'খালি';



        //\DB::enableQueryLog();
        // $query = ;
        // $query->with(['district', 'thana']);
        $data['qrrs'] = Qrr::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->where('event_type', $ekey, $evalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        Session::put('dkey', $dkey);
        Session::put('dvalue', $dvalue);
        Session::put('tkey', $tkey);
        Session::put('tvalue', $tvalue);
        Session::put('skey', $skey);
        Session::put('svalue', $svalue);
        Session::put('fvalue', $fvalue);
        Session::put('tovalue', $tovalue);
        Session::save();

        // dd($data['qrrs'], $from, $to, \DB::getQueryLog());

        //dd(\DB::getQueryLog());

        //$query->where('districtID', '=', $request->input('districtID'))
        //->orWhere('thanaID', '=', $request->input('thanaID'))
        //->orWhere('source_of_info', '=', $request->input('source_of_info'))->orWhereDate('date_time_of_police_news', '=', $request->input('form'))
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['qrrs'] = Qrr::where('districtID', $disexp, $disid)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        Session::put('dkey', $disexp);
        Session::put('dvalue', $disid);
        Session::put('tkey', $tkey);
        Session::put('tvalue', $tvalue);
        Session::put('skey', $skey);
        Session::put('svalue', $svalue);
        Session::put('fvalue', $fvalue);
        Session::put('tovalue', $tovalue);
        Session::save();
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            $data['qrrs'] = Qrr::where('districtID', $disexp, $disid)
        ->where('thanaID', $thaexp, $thaid)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        Session::put('dkey', $disexp);
        Session::put('dvalue', $disid);
        Session::put('tkey', $thaexp);
        Session::put('tvalue', $thaid);
        Session::put('skey', $skey);
        Session::put('svalue', $svalue);
        Session::put('fvalue', $fvalue);
        Session::put('tovalue', $tovalue);
        Session::save();
        }

        return view('admin/qrr/qrrscdata', $data);
    }


    //This method add new users
    public function Addqrr(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }

        return view('admin/qrr/qrrs-add', $data);
    }

    public function srcs(Request $request)
    {
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            foreach ($spthana as $key => $value) {
                $dd = Qrr::where('thanaID', $value->id)->count();

                $data['spthana'][$key] =  [($dd !== 0) ? $dd : '', $value->bn_name];
            }

            $request->session()->flash('spthana', $data['spthana']);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            $dd = Qrr::where('thanaID', $octhana->id)->count();

            $val =  ($dd !== 0) ? $dd : '';

            $request->session()->flash('octhananame', $octhana->bn_name);
            $request->session()->flash('octhanavalue', $val);
        }

        if (auth()->user()->hasRole('Super Admin')) {
            $borgona = Qrr::where('districtID', 34)->count();
            $barisal = Qrr::where('districtID', 35)->count();
            $bhola = Qrr::where('districtID', 36)->count();
            $jalokhati = Qrr::where('districtID', 37)->count();
            $patuakhali = Qrr::where('districtID', 38)->count();
            $pirojpur = Qrr::where('districtID', 39)->count();

            $request->session()->flash('borgona', ($borgona !== 0) ? $borgona : '');
            $request->session()->flash('barisal', ($barisal !== 0) ? $barisal : '');
            $request->session()->flash('bhola', ($bhola !== 0) ? $bhola : '');
            $request->session()->flash('jalokhati', ($jalokhati !== 0) ? $jalokhati : '');
            $request->session()->flash('patuakhali', ($patuakhali !== 0) ? $patuakhali : '');
            $request->session()->flash('pirojpur', ($pirojpur !== 0) ? $pirojpur : '');
        }

        $data['tin'] = Qrr::where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $data['tcat'] = Qrr::whereNotNull('case_no')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $inscou = Qrr::where('source_of_info', 'কোর্ট')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $ins99 = Qrr::where('source_of_info', '৯৯৯')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $insala = Qrr::where('source_of_info', 'এলাকা')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $instha = Qrr::where('source_of_info', 'থানা')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();

        $request->session()->flash('inscou', $inscou);
        $request->session()->flash('ins99', $ins99);
        $request->session()->flash('insala', $insala);
        $request->session()->flash('instha', $instha);

        $etmara = Qrr::where('event_type', 'মারামারি')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etkun = Qrr::where('event_type', 'খুন')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etchori = Qrr::where('event_type', 'চুরি')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etdakati = Qrr::where('event_type', 'ডাকাতি')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etsompds = Qrr::where('event_type', 'বিরোধ')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etsorokd = Qrr::where('event_type', 'সড়ক দুর্ঘটনা')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etnarios = Qrr::where('event_type', 'নারী ও শিশু')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etagun = Qrr::where('event_type', 'অগ্নিকান্ড')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etmadok = Qrr::where('event_type', 'মাদক')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etcyber = Qrr::where('event_type', 'সাইবার')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etprota = Qrr::where('event_type', 'প্রতারণা')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etrajnoi = Qrr::where('event_type', 'দুর্ঘটনা')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etonno = Qrr::where('event_type', 'অন্যান্য')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etnikoj = Qrr::where('event_type', 'নিখোঁজ-অপহরণ')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etdusht = Qrr::where('event_type', 'দস্যুতা')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();
        $etjua = Qrr::where('event_type', 'জুয়া')->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->count();


        $request->session()->flash('etmara', ($etmara !== 0) ? $etmara : '');
        $request->session()->flash('etkun', ($etkun !== 0) ? $etkun : '');
        $request->session()->flash('etchori', ($etchori !== 0) ? $etchori : '');
        $request->session()->flash('etdakati', ($etdakati !== 0) ? $etdakati : '');
        $request->session()->flash('etsompds', ($etsompds !== 0) ? $etsompds : '');
        $request->session()->flash('etsorokd', ($etsorokd !== 0) ? $etsorokd : '');
        $request->session()->flash('etnarios', ($etnarios !== 0) ? $etnarios : '');
        $request->session()->flash('etagun', ($etagun !== 0) ? $etagun : '');
        $request->session()->flash('etmadok', ($etmadok !== 0) ? $etmadok : '');
        $request->session()->flash('etcyber', ($etcyber !== 0) ? $etcyber : '');
        $request->session()->flash('etprota', ($etprota !== 0) ? $etprota : '');
        $request->session()->flash('etrajnoi', ($etrajnoi !== 0) ? $etrajnoi : '');
        $request->session()->flash('etonno', ($etonno !== 0) ? $etonno : '');
        $request->session()->flash('etnikoj', ($etnikoj !== 0) ? $etnikoj : '');
        $request->session()->flash('etdusht', ($etdusht !== 0) ? $etdusht : '');
        $request->session()->flash('etjua', ($etjua !== 0) ? $etjua : '');


        return view('admin/qrr/qrrsc', $data);
    }

    private function reptpenum($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
    }

    //this method for add new user
    public function Create(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();

        $uid = auth()->user()->id;

        $insertAttr = [
            'divisionID'=>1,
            'districtID'=> ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID'=>  (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'village_word'=>$request->input('village_word'),
            'source_of_info'=>$request->input('source_of_info'),
            'date_time_of_incident'=>null,
            'date_time_of_police_news'=>null,
            'date_time_response'=>null,
            'delay_in_response'=>null,
            'main_event'=>$request->input('main_event'),
            'event_type'=>$request->input('event_type'),
            'begening_of_event'=>$request->input('begening_of_event'),
            'gd_no'=> $this->reptpenum($request->input('gd_no')),
            'gd_date'=>null,
            'case_no'=> $this->reptpenum($request->input('case_no')),
            'case_date'=> $request->input('case_date'),
            'clause'=> $this->reptpenum($request->input('clause')),
            'nopc'=>$request->input('nopc'),
            'plaintiff_mobile'=> $this->reptpenum($request->input('plaintiff_mobile')),
            'number_of_victims'=>$request->input('number_of_victims'),
            'number_of_accused'=>$request->input('number_of_accused'),
            'name_of_investigator'=>$request->input('name_of_investigator'),
            'bp_no'=> $this->reptpenum($request->input('bp_no')),
            'mobile_no'=> $this->reptpenum($request->input('mobile_no')),
            'image_video'=>$request->input('image_video'),
            'media_quality'=>$request->input('media_quality'),
            'comments'=>$request->input('comments'),
            'user_id' => $uid,
            'short_dettails' => $request->input('short_dettails'),

        ];

        if ($request->input('date_time_of_incident')) {
            $insertAttr['date_time_of_incident'] = Carbon::createFromFormat('d/m/Y h:i A', $request->input('date_time_of_incident').' '.$request->input('incident_time'))->format('Y-m-d H:s:i');
        }

        if ($request->input('date_time_of_police_news')) {
            $insertAttr['date_time_of_police_news'] = Carbon::createFromFormat('d/m/Y h:i A', $request->input('date_time_of_police_news').' '.$request->input('police_news_time'))->format('Y-m-d H:s:i');
        }

        if ($request->input('date_time_response')) {
            $insertAttr['date_time_response'] = Carbon::createFromFormat('d/m/Y h:i A', $request->input('date_time_response').' '.$request->input('response_time'))->format('Y-m-d H:s:i');
        }

        if ($request->input('gd_date')) {
            $insertAttr['gd_date'] = Carbon::createFromFormat('d/m/Y', $request->input('gd_date'))->format('Y-m-d');
        }

        if ($request->input('case_date')) {
            $insertAttr['case_date'] = Carbon::createFromFormat('d/m/Y', $request->input('case_date'))->format('Y-m-d');
        }


        //delay count in  response
        if ($insertAttr['date_time_of_police_news'] and $insertAttr['date_time_response']) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $insertAttr['date_time_response']);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $insertAttr['date_time_of_police_news']);

            $insertAttr['delay_in_response'] = $to->diffInMinutes($from);
        }


        if (Qrr::insert($insertAttr)) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/qrrs/add');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }


        return view('admin/qrr/qrrs-add');
    }


    //this method for view edit()
    public function Edit(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/qrrs');
        }

        $data['qrr'] = Qrr::where('id', $id)->first();

        Gate::authorize('editdeleteqrr', $data['qrr']);

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }

        if (!$data) {
            return redirect('admin/qrrs');
        }
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['qrr']->districtID ? Thana::where('district_id', $data['qrr']->districtID)->get() : [] ;
        return view('admin/qrr/qrrs-edit', $data);
    }


    //this method for update user
    public function Update(Request $request, $id)
    {
        $qrrf = Qrr::find($id);
        Gate::authorize('editdeleteqrr', $qrrf);
        $data['districts'] = District::where('division_id', 1)->get();

        $insertAttr = [
            'divisionID'=>1,
            'districtID'=> ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID'=> (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'village_word'=>$request->input('village_word'),
            'source_of_info'=>$request->input('source_of_info'),
            'date_time_of_incident'=>null,
            'date_time_of_police_news'=>null,
            'date_time_response'=>null,
            'delay_in_response'=>null,
            'main_event'=>$request->input('main_event'),
            'event_type'=>$request->input('event_type'),
            'begening_of_event'=>$request->input('begening_of_event'),
            'gd_no'=> $this->reptpenum($request->input('gd_no')),
            'gd_date'=>null,
            'case_no'=> $this->reptpenum($request->input('case_no')),
            'case_date'=>$request->input('case_date'),
            'clause'=> $this->reptpenum($request->input('clause')),
            'nopc'=> $request->input('nopc'),
            'plaintiff_mobile'=> $this->reptpenum($request->input('plaintiff_mobile')),
            'number_of_victims'=>$request->input('number_of_victims'),
            'number_of_accused'=>$request->input('number_of_accused'),
            'name_of_investigator'=>$request->input('name_of_investigator'),
            'bp_no'=> $this->reptpenum($request->input('bp_no')),
            'mobile_no'=> $this->reptpenum($request->input('mobile_no')),
            'image_video'=>$request->input('image_video'),
            'media_quality'=>$request->input('media_quality'),
            'comments'=>$request->input('comments'),

        ];

        if ($request->input('date_time_of_incident')) {
            $insertAttr['date_time_of_incident'] = Carbon::createFromFormat('d/m/Y h:i A', $request->input('date_time_of_incident').' '.$request->input('incident_time'))->format('Y-m-d h:i:s');
        }

        if ($request->input('date_time_of_police_news')) {
            $insertAttr['date_time_of_police_news'] = Carbon::createFromFormat('d/m/Y h:i A', $request->input('date_time_of_police_news').' '.$request->input('police_news_time'))->format('Y-m-d h:i:s');
        }

        if ($request->input('date_time_response')) {
            $insertAttr['date_time_response'] = Carbon::createFromFormat('d/m/Y h:i A', $request->input('date_time_response').' '.$request->input('response_time'))->format('Y-m-d h:i:s');
        }

        if ($request->input('gd_date')) {
            $insertAttr['gd_date'] = Carbon::createFromFormat('d/m/Y', $request->input('gd_date'))->format('Y-m-d');
        }

        if ($request->input('case_date')) {
            $insertAttr['case_date'] = Carbon::createFromFormat('d/m/Y', $request->input('case_date'))->format('Y-m-d');
        }


        //delay count in  response
        if ($insertAttr['date_time_of_police_news'] and $insertAttr['date_time_response']) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $insertAttr['date_time_response']);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $insertAttr['date_time_of_police_news']);

            $insertAttr['delay_in_response'] = $to->diffInMinutes($from);
        }


        if (qrr::where('id', $id)->update($insertAttr)) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/qrrs');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }


        return view('admin/qrr/qrrs-edit', $data);
    }




    //this method for  user delete
    public function Delete(Request $request, $id=null)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/qrrs');
        }

        $qrrf = Qrr::find($id);
        Gate::authorize('editdeleteqrr', $qrrf);

        if (qrr::where('id', $id)->delete()) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/qrrs');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/qrrs');
        }
        return redirect('admin/qrrs');
    }

    //this method for short Services
    public function Short(Request $request)
    {
        if ($request->input('orders')) {
            $orders = $request->input('orders');
            if ($orders) {
                $counter=0;
                foreach ($orders as $id) {
                    $counter++;
                    $attr=array('order_by'=>$counter);
                    Qrr::where('id', $id)->update($attr);
                }
            }
        }
    }


    //this method for view edit()
    public function View(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/qrrs');
        }

        $data['qrr'] = Qrr::where('id', $id)->with(['district', 'thana'])->first();

        Gate::authorize('editdeleteqrr', $data['qrr']);

        if (!$data) {
            return redirect('admin/qrrs');
        }
        $data['request'] = $request;
        return view('admin/qrr/qrrs-view', $data);
    }


    //this method for view edit()
    public function PrintView(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/qrrs');
        }

        $data['qrr'] = Qrr::where('id', $id)->with(['district', 'thana'])->first();

        Gate::authorize('editdeleteqrr', $data['qrr']);

        if (!$data) {
            return redirect('admin/qrrs');
        }
        $data['request'] = $request;
        return view('admin/qrr/qrrs-print-view', $data);
    }

    public function excelView(Qrr $qrr) {
        Gate::authorize('editdeleteqrr', $qrr);

        $name = uniqid('qrrview_');

        return (new QrrsviewExport)->forId($qrr->id)->download($name.'.xlsx');
    }

    public function pdfView(Request $request, Qrr $qrr)
    {
        $data['qrr'] = $qrr;

        Gate::authorize('editdeleteqrr', $data['qrr']);

        $data['request'] = $request;
        $data['pdfname'] = uniqid('qrrview_').'.pdf';
/* 
        $pdf = PDF::loadView('admin/qrr/qrr-pdf-view', $data);
        $name = uniqid('qrrview_');
        //return $pdf->download($name.'.pdf');
        return $pdf->stream();

        

        //header('Content-type: application/pdf');
        //header('Content-Disposition: inline; filename="hhh.pdf"');
        //header('Content-Transfer-Encoding: binary');
        //header('Accept-Ranges: bytes');
*/

        return view('admin/qrr/qrr-pdf-view', $data);
    }
}
