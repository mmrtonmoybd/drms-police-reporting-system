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

class QrrsController extends Controller
{
    public function __construct()
    {
    }

    //This method list all users
    public function Index(Request $request)
    {
        $query = Qrr::query();
        $query->with(['district', 'thana']);
        $data['qrrs'] = $query->orderBy('id', 'desc')->paginate(20);
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/qrr/qrrs', $data);
    }

    public function report(Request $request, $report)
    {
        $query = Qrr::query();
        $query->with(['district', 'thana']);
        $data['qrrs'] = $query->orderBy('id', 'desc')->where('event_type', $report)->paginate(20);
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
            $fvalue = $request->input('form');
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (!empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $request->input('to');
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
            ;
        }



        //\DB::enableQueryLog();
        $query = Qrr::query();
        $query->with(['district', 'thana']);
        $data['qrrs'] = $query->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);

        //dd(\DB::getQueryLog());

        //$query->where('districtID', '=', $request->input('districtID'))
        //->orWhere('thanaID', '=', $request->input('thanaID'))
        //->orWhere('source_of_info', '=', $request->input('source_of_info'))->orWhereDate('date_time_of_police_news', '=', $request->input('form'))
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        //dd($data['qrrs']);
        //  return view('admin/qrr/qrrs-s', $data);


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

        $data['borgona'] = $borgona;
        $data['barisal'] = $barisal;
        $data['bhola'] = $bhola;
        $data['jalokhati'] = $jalokhati;
        $data['patuakhali'] = $patuakhali;
        $data['pirojpur'] = $pirojpur;

        $request->session()->flash('borgona', $borgona);
        $request->session()->flash('barisal', $barisal);
        $request->session()->flash('bhola', $bhola);
        $request->session()->flash('jalokhati', $jalokhati);
        $request->session()->flash('patuakhali', $patuakhali);
        $request->session()->flash('pirojpur', $pirojpur);

        $data['tin'] = Qrr::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $data['tcat'] = Qrr::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->whereNotNull('case_no')->count();


        $inscou = Qrr::where('source_of_info', 'কোর্ট')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $ins99 = Qrr::where('source_of_info', '৯৯৯')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $insala = Qrr::where('source_of_info', 'এলাকা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $instha = Qrr::where('source_of_info', 'থানা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $request->session()->flash('inscou', $inscou);
        $request->session()->flash('ins99', $ins99);
        $request->session()->flash('insala', $insala);
        $request->session()->flash('instha', $instha);

        $etmara = Qrr::where('event_type', 'মারামারি')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etkun = Qrr::where('event_type', 'খুন')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etchori = Qrr::where('event_type', 'চুরি')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etdakati = Qrr::where('event_type', 'ডাকাতি')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etsompds = Qrr::where('event_type', 'সম্পত্তি সংক্রান্ত')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etsorokd = Qrr::where('event_type', 'সড়ক দুর্ঘটনা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etnarios = Qrr::where('event_type', 'নারী ও শিশু')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etagun = Qrr::where('event_type', 'অগ্নিকান্ড')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etmadok = Qrr::where('event_type', 'মাদক')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etcyber = Qrr::where('event_type', 'সাইবার')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etprota = Qrr::where('event_type', 'প্রতারণা')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etrajnoi = Qrr::where('event_type', 'রাজনৈতিক')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();

        $etonno = Qrr::where('event_type', 'অন্যান্য')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->count();


        $request->session()->flash('etmara', $etmara);
        $request->session()->flash('etkun', $etkun);
        $request->session()->flash('etchori', $etchori);
        $request->session()->flash('etdakati', $etdakati);
        $request->session()->flash('etsompds', $etsompds);
        $request->session()->flash('etsorokd', $etsorokd);
        $request->session()->flash('etnarios', $etnarios);
        $request->session()->flash('etagun', $etagun);
        $request->session()->flash('etmadok', $etmadok);
        $request->session()->flash('etcyber', $etcyber);
        $request->session()->flash('etprota', $etprota);
        $request->session()->flash('etrajnoi', $etrajnoi);
        $request->session()->flash('etonno', $etonno);


        return view('admin/qrr/qrrsg', $data);
    }


    //This method add new users
    public function Addqrr(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        return view('admin/qrr/qrrs-add', $data);
    }

    public function srcs(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $borgona = Qrr::where('districtID', 34)->count();
        $barisal = Qrr::where('districtID', 35)->count();
        $bhola = Qrr::where('districtID', 36)->count();
        $jalokhati = Qrr::where('districtID', 37)->count();
        $patuakhali = Qrr::where('districtID', 38)->count();
        $pirojpur = Qrr::where('districtID', 39)->count();

        $data['borgona'] = $borgona;
        $data['barisal'] = $barisal;
        $data['bhola'] = $bhola;
        $data['jalokhati'] = $jalokhati;
        $data['patuakhali'] = $patuakhali;
        $data['pirojpur'] = $pirojpur;

        $request->session()->flash('borgona', $borgona);
        $request->session()->flash('barisal', $barisal);
        $request->session()->flash('bhola', $bhola);
        $request->session()->flash('jalokhati', $jalokhati);
        $request->session()->flash('patuakhali', $patuakhali);
        $request->session()->flash('pirojpur', $pirojpur);

        $data['tin'] = Qrr::count();
        $data['tcat'] = Qrr::whereNotNull('case_no')->count();

        $inscou = Qrr::where('source_of_info', 'কোর্ট')->count();
        $ins99 = Qrr::where('source_of_info', '৯৯৯')->count();
        $insala = Qrr::where('source_of_info', 'এলাকা')->count();
        $instha = Qrr::where('source_of_info', 'থানা')->count();

        $request->session()->flash('inscou', $inscou);
        $request->session()->flash('ins99', $ins99);
        $request->session()->flash('insala', $insala);
        $request->session()->flash('instha', $instha);

        $etmara = Qrr::where('event_type', 'মারামারি')->count();
        $etkun = Qrr::where('event_type', 'খুন')->count();
        $etchori = Qrr::where('event_type', 'চুরি')->count();
        $etdakati = Qrr::where('event_type', 'ডাকাতি')->count();
        $etsompds = Qrr::where('event_type', 'সম্পত্তি সংক্রান্ত')->count();
        $etsorokd = Qrr::where('event_type', 'সড়ক দুর্ঘটনা')->count();
        $etnarios = Qrr::where('event_type', 'নারী ও শিশু')->count();
        $etagun = Qrr::where('event_type', 'অগ্নিকান্ড')->count();
        $etmadok = Qrr::where('event_type', 'মাদক')->count();
        $etcyber = Qrr::where('event_type', 'সাইবার')->count();
        $etprota = Qrr::where('event_type', 'প্রতারণা')->count();
        $etrajnoi = Qrr::where('event_type', 'রাজনৈতিক')->count();
        $etonno = Qrr::where('event_type', 'অন্যান্য')->count();


        $request->session()->flash('etmara', $etmara);
        $request->session()->flash('etkun', $etkun);
        $request->session()->flash('etchori', $etchori);
        $request->session()->flash('etdakati', $etdakati);
        $request->session()->flash('etsompds', $etsompds);
        $request->session()->flash('etsorokd', $etsorokd);
        $request->session()->flash('etnarios', $etnarios);
        $request->session()->flash('etagun', $etagun);
        $request->session()->flash('etmadok', $etmadok);
        $request->session()->flash('etcyber', $etcyber);
        $request->session()->flash('etprota', $etprota);
        $request->session()->flash('etrajnoi', $etrajnoi);
        $request->session()->flash('etonno', $etonno);




        return view('admin/qrr/qrrsc', $data);
    }

    public function SearchSort(Request $request)
    {
        $session_user = Session::get('user');

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
            $fvalue = $request->input('form');
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (!empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $request->input('to');
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
            ;
        }



        //\DB::enableQueryLog();
        $query = Qrr::query();
        $query->with(['district', 'thana']);
        $data['qrrs'] = $query->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('source_of_info', $skey, $svalue)
        ->whereBetween('date_time_of_police_news', [$fvalue, $tovalue])->get();

        //dd(\DB::getQueryLog());

        //$query->where('districtID', '=', $request->input('districtID'))
        //->orWhere('thanaID', '=', $request->input('thanaID'))
        //->orWhere('source_of_info', '=', $request->input('source_of_info'))->orWhereDate('date_time_of_police_news', '=', $request->input('form'))
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        //dd($data['qrrs']);
        return view('admin/qrr/qrrs-s', $data);
    }

    //this method for add new user
    public function Create(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();

        $validated = $request->validate([
            'districtID' => 'required',
        ]);

        $uid = auth()->user()->id;

        $insertAttr = [
            'divisionID'=>1,
            'districtID'=>$request->input('districtID'),
            'thanaID'=>$request->input('thanaID'),
            'village_word'=>$request->input('village_word'),
            'source_of_info'=>$request->input('source_of_info'),
            'date_time_of_incident'=>null,
            'date_time_of_police_news'=>null,
            'date_time_response'=>null,
            'delay_in_response'=>null,
            'main_event'=>$request->input('main_event'),
            'event_type'=>$request->input('event_type'),
            'begening_of_event'=>$request->input('begening_of_event'),
            'gd_no'=>$request->input('gd_no'),
            'gd_date'=>null,
            'case_no'=>$request->input('case_no'),
            'case_date'=>$request->input('case_date'),
            'clause'=>$request->input('clause'),
            'nopc'=>$request->input('nopc'),
            'plaintiff_mobile'=>$request->input('plaintiff_mobile'),
            'number_of_victims'=>$request->input('number_of_victims'),
            'number_of_accused'=>$request->input('number_of_accused'),
            'name_of_investigator'=>$request->input('name_of_investigator'),
            'bp_no'=>$request->input('bp_no'),
            'mobile_no'=>$request->input('mobile_no'),
            'image_video'=>$request->input('image_video'),
            'media_quality'=>$request->input('media_quality'),
            'comments'=>$request->input('comments'),
            'user_id' => $uid,

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


        if (Qrr::insert($insertAttr)) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/qrrs/add');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
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
        $data['districts'] = District::where('division_id', 1)->get();

        $validated = $request->validate([
            'districtID' => 'required',
        ]);

        $insertAttr = [
            'divisionID'=>1,
            'districtID'=>$request->input('districtID'),
            'thanaID'=>$request->input('thanaID'),
            'village_word'=>$request->input('village_word'),
            'source_of_info'=>$request->input('source_of_info'),
            'date_time_of_incident'=>null,
            'date_time_of_police_news'=>null,
            'date_time_response'=>null,
            'delay_in_response'=>null,
            'main_event'=>$request->input('main_event'),
            'event_type'=>$request->input('event_type'),
            'begening_of_event'=>$request->input('begening_of_event'),
            'gd_no'=>$request->input('gd_no'),
            'gd_date'=>null,
            'case_no'=>$request->input('case_no'),
            'case_date'=>$request->input('case_date'),
            'clause'=>$request->input('clause'),
            'nopc'=>$request->input('nopc'),
            'plaintiff_mobile'=>$request->input('plaintiff_mobile'),
            'number_of_victims'=>$request->input('number_of_victims'),
            'number_of_accused'=>$request->input('number_of_accused'),
            'name_of_investigator'=>$request->input('name_of_investigator'),
            'bp_no'=>$request->input('bp_no'),
            'mobile_no'=>$request->input('mobile_no'),
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


        return view('admin/qrr/qrrs-edit', $data);
    }




    //this method for  user delete
    public function Delete(Request $request, $id=null)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/qrrs');
        }

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

        if (!$data) {
            return redirect('admin/qrrs');
        }
        $data['request'] = $request;
        return view('admin/qrr/qrrs-print-view', $data);
    }
}
