<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\CaseType;
use App\Models\Casedb;
use App\Models\Circle;
use App\Models\Thana;
use Illuminate\Support\Carbon;

class CaseController extends Controller
{
    public function index()
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

        $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active')->orderBy('id', 'desc')->paginate(20);

        return view('admin/case/cases', $data);
    }


    public function reviewList()
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

        $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'inactive')->orderBy('id', 'desc')->paginate(20);

        return view('admin/case/case-review', $data);
    }


    public function reviewShow(Request $request, Casedb $casedb)
    {
        $data['casedb'] = $casedb;

        return view('admin/case/case-status', $data);
    }

    public function reviewUpdate(Request $request, Casedb $casedb)
    {
        //$data['qrr'] = $qrr;

        $data = [
            'status' => $request->input('statusg')
        ];

        if ($casedb->update($data)) {
            $request->session()->flash('success_msg', 'Data status updated successfully');
            return redirect('admin/case/review');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect()->back();
        }
    }


    public function addShow(Request $request)
    {
        $data['request'] = $request;
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);
        }

        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();

        return view('admin/case/case-add', $data);
    }

    private function reptpenum($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
    }

    public function create(Request $request)
    {
        $cdms_pg_id_result_final = '';

        if ($request->filled('cdms_pg_id')) {
            $cdms_pg_id = $request->input('cdms_pg_id');
            $cdms_pg_id_result = preg_replace("/[^a-zA-Z0-9]+/", "", $cdms_pg_id);
            $cdms_pg_id_result_final = strtoupper($cdms_pg_id_result);
        }

        $case_date = '';

        if ($request->filled('case_date')) {
            $case_date = Carbon::createFromFormat('d/m/Y', $request->input('case_date'))->format('Y-m-d');
        }

        $incident_date_time = '';

        if ($request->filled('incident_date_time')) {
            $incident_date_time = Carbon::createFromFormat('d/m/Y', $request->input('incident_date_time'))->format('Y-m-d');
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $thana = Thana::find($request->input('thanaID'));
            $circleid = $thana->circle_id;
        } else {
            $circleid = $request->input('circleID');
        }

        if ($request->filled('casesubID')) {
            $casesub_type = $request->input('casesubID');
        } else {
            $casesub_type = 0;
        }

        $request->merge([
            'cdms_pg_id' => $cdms_pg_id_result_final,
            'case_date' => $case_date,
            'incident_date_time' => $incident_date_time,
            'gr_no' => $this->reptpenum($request->input('gr_no')),
            'case_no' => $this->reptpenum($request->input('case_no')),
            'dhara' => $this->reptpenum($request->input('dhara')),
            'azahar_namio_victims' => $this->reptpenum($request->input('azahar_namio_victims')),
            'nispotti_or_multobi' => 'মুলতবি',
            'nispotti_type' => 0,
            'divisionID' => 1,
            'user_id' => auth()->user()->id,
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'circleID' => $circleid,
            'case_type' => $request->input('caseTypeID'),
            'casesub_type' => $casesub_type,
        ]);

        //dd($request->all());

        if (Casedb::create($request->all())) {
            return redirect('admin/case/add')->with('success_msg', 'Data added successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong. Please try again');
        }

        //dd($request->all());
    }

    public function editShow(Request $request, Casedb $casedb)
    {
        $data['case'] = $casedb;


        $data['request'] = $request;
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);
        }

        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();

        return view('admin/case/case-edit', $data);
    }

    public function update(Request $request, Casedb $casedb)
    {
        $cdms_pg_id_result_final = '';

        if ($request->filled('cdms_pg_id')) {
            $cdms_pg_id = $request->input('cdms_pg_id');
            $cdms_pg_id_result = preg_replace("/[^a-zA-Z0-9]+/", "", $cdms_pg_id);
            $cdms_pg_id_result_final = strtoupper($cdms_pg_id_result);
        }



        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $thana = Thana::find($request->input('thanaID'));
            $circleid = $thana->circle_id;
        } else {
            $circleid = $request->input('circleID');
        }

        if ($request->filled('nispotti_type')) {
            $nispotti_type = $request->input('nispotti_type');
        } else {
            $nispotti_type = 0;
        }

        if ($request->filled('casesubID')) {
            $casesub_type = $request->input('casesubID');
        } else {
            $casesub_type = 0;
        }

        $request->merge([
            'cdms_pg_id' => $cdms_pg_id_result_final,
            'gr_no' => $this->reptpenum($request->input('gr_no')),
            'case_no' => $this->reptpenum($request->input('case_no')),
            'dhara' => $this->reptpenum($request->input('dhara')),
            'azahar_namio_victims' => $this->reptpenum($request->input('azahar_namio_victims')),
            'nispotti_or_multobi' => $request->input('nispotti_or_multobi'),
            'divisionID' => 1,
            'user_id' => auth()->user()->id,
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'circleID' => $circleid,
            'case_type' => $request->input('caseTypeID'),
            'casesub_type' => $casesub_type,
            'nispotti_type' => $nispotti_type,
            'cs_or_fr_no' => $this->reptpenum($request->input('cs_or_fr_no')),
            'police_report_victim' => $this->reptpenum($request->input('police_report_victim')),
            'number_of_accused' => $this->reptpenum($request->input('number_of_accused')),
            'jamin_prapto' => $this->reptpenum($request->input('jamin_prapto')),
            'polatok' => $this->reptpenum($request->input('polatok')),
            'azahar_vukto_invistigate' => $this->reptpenum($request->input('azahar_vukto_invistigate')),
            'ovohoti' => $this->reptpenum($request->input('ovohoti')),
            'sixtyone_recive' => $this->reptpenum($request->input('sixtyone_recive')),
            'sixtyfour_recive' => $this->reptpenum($request->input('sixtyfour_recive'))
        ]);



        if ($request->filled('case_date')) {
            $case_date = Carbon::createFromFormat('d/m/Y', $request->input('case_date'))->format('Y-m-d');

            $request->merge([
                'case_date' => $case_date
            ]);
        }





        if ($request->filled('incident_date_time')) {
            $incident_date_time = Carbon::createFromFormat('d/m/Y', $request->input('incident_date_time'))->format('Y-m-d');

            $request->merge([
                'incident_date_time' => $incident_date_time
            ]);
        }



        if ($request->filled('nispotti_date')) {
            $nispotti_date = Carbon::createFromFormat('d/m/Y', $request->input('nispotti_date'))->format('Y-m-d');

            $request->merge([
                'nispotti_date' => $nispotti_date
            ]);
        }



        if ($request->filled('nispotti_date') && $request->filled('case_date')) {
            $to = Carbon::createFromFormat('Y-m-d', $nispotti_date);
            $from = Carbon::createFromFormat('Y-m-d', $case_date);

            $nispottisecond = $to->diffInSeconds($from);


            $request->merge([
            'nispottisecond' => $nispottisecond
            ]);
        }



        $request->request->remove('_token');
        $request->request->remove('submit');

        if ($casedb->update($request->all())) {
            return redirect('admin/case')->with('success_msg', 'Data updated successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong. Please try again');
        }


        //dd($request->all());
    }

    public function caseView(Request $request, Casedb $casedb)
    {
        $data['request'] = $request;
        $data['case'] = $casedb;

        return view('admin/case/case-view', $data);
    }

    public function casePrint(Request $request, Casedb $casedb)
    {
        $data['request'] = $request;
        $data['case'] = $casedb;

        return view('admin/case/case-print', $data);
    }

    public function delete(Casedb $casedb)
    {
        if ($casedb->delete()) {
            return redirect('admin/case')->with('success_msg', 'Data deleted successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong. Please try again');
        }
    }

    public function dashboard(Request $request)
    {
        $data['request'] = $request;
        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();

        $currentday = Carbon::now()->format('Y-m-d') . ' 23:59:59';

        $request->session()->flash('currentday', $currentday);

        $agomonthday = Carbon::now()->subMonth()->format('Y-m-d') . ' 00:00:00';

        $request->session()->flash('agomonthday', $agomonthday);


        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $dvalue = 'kglf';
            $dkey = '!=';
            $tvalue = 'kkdk';
            $tkey = '!=';
            $cvalue = 'dkikEK';
            $ckey = '!=';


            $data['districts'] = District::where('division_id', 1)->get();

            // District wise case start

            $diswisecase = Casedb::with('district')->selectRaw('COUNT(case_no) AS countcase, districtID')->whereBetween('case_date', [$agomonthday, $currentday])->where('status', 'active')->whereNotNull('case_no')->groupBy('districtID')->orderBy('districtID', 'ASC')->get();

            // District wise case end


            $request->session()->flash('diswisecase', $diswisecase);
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = 'kkdk';
            $tkey = '!=';
            $cvalue = 'dkikEK';
            $ckey = '!=';


            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();

            // Circle wise case start

            $circlewise = Casedb::with('circle')->selectRaw('COUNT(case_no) AS countcase, circleID')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereNotNull('case_no')->whereBetween('case_date', [$agomonthday, $currentday])->groupBy('circleID')->orderBy('circleID', 'ASC')->get();
            // Circle wise case end

            $request->session()->flash('circlewise', $circlewise);
        } else {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = auth()->user()->thanaID;
            $tkey = '=';

            $data['thanades'] = Thana::find(auth()->user()->thanaID);

            // Thana wise case start

            $thanawise = Casedb::with('thana')->selectRaw('COUNT(case_no) AS countcase, thanaID')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('case_date', [$agomonthday, $currentday])->whereNotNull('case_no')->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();
            // Thana wise case end

            $request->session()->flash('thanawise', $thanawise);
        }

        // Case type chart start

        $casetypec = Casedb::with('casetype')->selectRaw('COUNT(case_type) AS countcase_type, case_type')
        ->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereBetween('case_date', [$agomonthday, $currentday])
        ->groupBy('case_type')
        ->orderBy('case_type', 'ASC')
        ->get();

        $request->session()->flash('casetypec', $casetypec);
        // Case type chart end

        // Case sub type start

        $casesubtypec = Casedb::with('casesubtype')->selectRaw('COUNT(casesub_type) AS countcasesub_type, casesub_type, case_type')
        ->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('casesub_type', '!=', 0)
        ->where('status', 'active')
        ->whereBetween('case_date', [$agomonthday, $currentday])
        ->groupBy('casesub_type')
        ->orderBy('casesub_type', 'ASC')
        ->get();

        $request->session()->flash('casesubtypec', $casesubtypec);
        // Case sub type end

        // Case ending typyes start

        $caseendingtypes = Casedb::selectRaw('COUNT(nispotti_type) AS countnispotti_type, nispotti_type')->where('status', 'active')->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->where('nispotti_type', '!=', '0')->groupBy('nispotti_type')->orderBy('nispotti_type', 'ASC')->get();

        $request->session()->flash('caseendingtypes', $caseendingtypes);
        // Case ending typyes start

        // Total case start
        $data['totalcase'] = Casedb::whereNotNull('case_no')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->count('case_no');

        // Total case end

        // Total ending case start

        $data['totalendingcase'] = Casedb::whereNotNull('case_no')->where('nispotti_or_multobi', 'নিস্পত্তি')->where('status', 'active')->whereBetween('case_date', [$agomonthday, $currentday])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->count('nispotti_or_multobi');

        // Total ending case end

        // Total multobi case start
        $data['totalmultobicase'] = Casedb::whereNotNull('case_no')->where('nispotti_or_multobi', 'মুলতবি')->where('status', 'active')->whereBetween('case_date', [$agomonthday, $currentday])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->count('nispotti_or_multobi');
        // Total multobi case end

        // Avg case ending time
        $data['avgendingcasetime'] = Casedb::whereNotNull('nispottisecond')->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('case_date', [$agomonthday, $currentday])->where('thanaID', $tkey, $tvalue)->avg('nispottisecond');
        // Avg case ending time end

        //Last  3 month case start

        $last_three_month = Carbon::now()->startOfMonth()->subMonth(2);
        $this_month = Carbon::now()->endOfMonth();

        $lastthreemonthcase = Casedb::selectRaw('DATE_FORMAT(case_date, "%b") AS month, DATE_FORMAT(case_date, "%Y-%b") AS monthyear, COUNT(case_no) AS totalcase')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereNotNull('case_no')->whereBetween('case_date', [$last_three_month,$this_month])->groupBy('monthyear')->orderBy(\DB::raw('MONTH(case_date)'), 'ASC')->get();
        //echo $this_month;

        //dd($lastthreemonthcase);

        $request->session()->flash('lastthreemonthcase', $lastthreemonthcase);
        // last 3 month case end

        // Ak nojora case details start

        $data['azaharnamioasami'] = Casedb::whereNotNull('azahar_namio_victims')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('azahar_namio_victims');

        $data['accusedasami'] = Casedb::whereNotNull('number_of_accused')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('number_of_accused');

        $data['jaminprapto'] = Casedb::whereNotNull('jamin_prapto')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('jamin_prapto');

        $data['ovohotiprapto'] = Casedb::whereNotNull('ovohoti')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('ovohoti');
        
        $data['nispottimamlaiazahar'] = Casedb::whereNotNull('azahar_namio_victims')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->where('nispotti_or_multobi', 'নিস্পত্তি')->whereBetween('case_date', [$agomonthday, $currentday])->sum('azahar_namio_victims');
        
        $data['onesixtyrecive'] = Casedb::whereNotNull('sixtyone_recive')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('sixtyone_recive');
        
        $data['onesixtyfourrecive'] = Casedb::whereNotNull('sixtyfour_recive')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('sixtyfour_recive');

        $data['azaharnewinvistigateprapto'] = Casedb::whereNotNull('azahar_vukto_invistigate')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('azahar_vukto_invistigate');
        
        $data['policereportprapti'] = Casedb::whereNotNull('police_report_victim')->where('districtID', $dkey, $dvalue)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('case_date', [$agomonthday, $currentday])->sum('police_report_victim');
        // Ak nojora case details end

        $data['reviewpending'] = Casedb::where('districtID', $dkey, $dvalue)
                                 ->where('thanaID', $tkey, $tvalue)
                                 ->whereBetween('case_date', [$agomonthday, $currentday])
                                 ->where('status', 'inactive')->count();
        //dd($lastthreemonthcase);

        return view('admin/case/case-dashboard', $data);
    }

    public function dashboardsc(Request $request)
    {
        $data['request'] = $request;
        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            if (!empty($request->input('districtID'))) {
                $dkey = '=';
                $dvalue = $request->input('districtID');
            } else {
                $dkey = '!=';
                $dvalue = 'ss';
            }

            if (!empty($request->input('circleID'))) {
                $ckey = '=';
                $cvalue = $request->input('circleID');
            } else {
                $ckey = '!=';
                $cvalue = 'cc';
            }

            if (!empty($request->input('thanaID'))) {
                $tkey = '=';
                $tvalue = $request->input('thanaID');
            } else {
                $tkey = '!=';
                $tvalue = 'jj';
            }
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();

            $dkey = '=';
            $dvalue = auth()->user()->districtID;

            if (!empty($request->input('circleID'))) {
                $ckey = '=';
                $cvalue = $request->input('circleID');
            } else {
                $ckey = '!=';
                $cvalue = 'cc';
            }

            if (!empty($request->input('thanaID'))) {
                $tkey = '=';
                $tvalue = $request->input('thanaID');
            } else {
                $tkey = '!=';
                $tvalue = 'jj';
            }
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);
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

        if (!empty($request->input('caseTypeID'))) {
            $caseTypeID = $request->input('caseTypeID');
            $caseTypeID_key = '=';
        } else {
            $caseTypeID = '500';
            $caseTypeID_key = '!=';
        }

        if (!empty($request->input('casesubID'))) {
            $casesubID = $request->input('casesubID');
            $casesubID_key = '=';
        } else {
            $casesubID = '500';
            $casesubID_key = '!=';
        }


        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();



            if (empty($request->input('districtID')) && empty($request->input('thanaID')) && empty($request->input('circleID'))) {
                // District wise case start
                $diswisecase = Casedb::with('district')->selectRaw('COUNT(case_no) AS countcase, districtID')
                ->where('case_type', $caseTypeID_key, $caseTypeID)
                ->where('status', 'active')
                          ->where('casesub_type', $casesubID_key, $casesubID)->whereNotNull('case_no')->whereBetween('case_date', [$fvalue, $tovalue])->groupBy('districtID')->orderBy('districtID', 'ASC')->get();

                //dd($diswisecase);
                $request->session()->flash('diswisecase', $diswisecase);
            // District wise case end
            } elseif (!empty($request->input('districtID')) && (empty($request->input('thanaID')) && empty($request->input('circleID')))) {
                // Circle wise case start

                $circlewisecase = Casedb::with('circle')->selectRaw('COUNT(case_no) AS countcase, circleID')
                                   ->whereNotNull('case_no')
                                   ->where('districtID', $dkey, $dvalue)
                                   ->where('status', 'active')
                                   ->where('case_type', $caseTypeID_key, $caseTypeID)
                                   ->where('casesub_type', $casesubID_key, $casesubID)
                                   ->whereBetween('case_date', [$fvalue, $tovalue])
                                   ->groupBy('circleID')
                                   ->orderBy('circleID', 'ASC')
                                   ->get();

                //dd($circlewisecase);
                $request->session()->flash('circlewisecase', $circlewisecase);
            // Circle wise case end
            } elseif ((!empty($request->input('districtID')) && !empty($request->input('circleID'))) && empty($request->input('thanaID'))) {
                // Circle wise thana start
                $circlewisethanacase = Casedb::with('thana')->selectRaw('COUNT(case_no) AS countcase, thanaID')
                                   ->whereNotNull('case_no')
                                   ->where('districtID', $dkey, $dvalue)
                                   ->where('circleID', $ckey, $cvalue)
                                   ->where('status', 'active')
                                   ->where('case_type', $caseTypeID_key, $caseTypeID)
                                   ->where('casesub_type', $casesubID_key, $casesubID)
                                   ->whereBetween('case_date', [$fvalue, $tovalue])
                                   ->groupBy('thanaID')
                                   ->orderBy('thanaID', 'ASC')
                                   ->get();

                //dd($circlewisethanacase);

                $request->session()->flash('circlewisethanacase', $circlewisethanacase);
            // Circle wise thana end
            } elseif (!empty($request->input('districtID')) && !empty($request->input('circleID')) && !empty($request->input('thanaID'))) {
                // Search thana case
                $searchthanacase = Casedb::with('thana')->selectRaw('COUNT(case_no) AS countcase, thanaID')
                               ->whereNotNull('case_no')
                               ->where('districtID', $dkey, $dvalue)
                               ->where('circleID', $ckey, $cvalue)
                               ->where('status', 'active')
                               ->where('thanaID', $tkey, $tvalue)
                               ->where('case_type', $caseTypeID_key, $caseTypeID)
                               ->where('casesub_type', $casesubID_key, $casesubID)
                               ->whereBetween('case_date', [$fvalue, $tovalue])
                               ->groupBy('thanaID')
                               ->orderBy('thanaID', 'ASC')
                               ->get();

                $ggg = 'ffff';

                //dd($searchthanacase, $ggg);

                $request->session()->flash('searchthanacase', $searchthanacase);
                // Search thana case
            }
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            if (empty($request->input('circleID')) && empty($request->input('thanaID'))) {
                $circlewisecase = Casedb::with('circle')->selectRaw('COUNT(case_no) AS countcase, circleID')
                                  ->where('districtID', $dkey, $dvalue)
                                  ->where('circleID', $ckey, $cvalue)
                                  ->where('thanaID', $tkey, $tvalue)
                                  ->where('status', 'active')
                                  ->where('case_type', $caseTypeID_key, $caseTypeID)
                                  ->where('casesub_type', $casesubID_key, $casesubID)
                                  ->whereBetween('case_date', [$fvalue, $tovalue])
                                  ->whereNotNull('case_no')->groupBy('circleID')
                                  ->orderBy('circleID', 'ASC')
                                  ->get();

                $request->session()->flash('circlewisecase', $circlewisecase);
            } elseif (!empty($request->input('circleID')) && empty($request->input('thanaID'))) {
                // Circle thana wise case

                $circlethanawisecase = Casedb::with('thana')->selectRaw('COUNT(case_no) AS countcase, thanaID')
                                  ->whereNotNull('case_no')
                                  ->where('districtID', $dkey, $dvalue)
                                  ->where('circleID', $ckey, $cvalue)
                                  ->where('status', 'active')
                                  ->where('case_type', $caseTypeID_key, $caseTypeID)
                                  ->where('casesub_type', $casesubID_key, $casesubID)
                                  ->whereBetween('case_date', [$fvalue, $tovalue])
                                  ->groupBy('thanaID')
                                  ->orderBy('thanaID', 'ASC')
                                  ->get();

                $request->session()->flash('circlethanawisecase', $circlethanawisecase);
            // Circle thana wise case
            } elseif (!empty($request->input('circleID')) && !empty($request->input('thanaID'))) {
                // Search thana case
                $searchthanacase = Casedb::with('thana')->selectRaw('COUNT(case_no) AS countcase, thanaID')
                               ->whereNotNull('case_no')
                               ->where('districtID', $dkey, $dvalue)
                               ->where('circleID', $ckey, $cvalue)
                               ->where('status', 'active')
                               ->where('thanaID', $tkey, $tvalue)
                               ->where('case_type', $caseTypeID_key, $caseTypeID)
                               ->where('casesub_type', $casesubID_key, $casesubID)
                               ->whereBetween('case_date', [$fvalue, $tovalue])
                               ->groupBy('thanaID')
                               ->orderBy('thanaID', 'ASC')
                               ->get();

                $ggg = 'ffff';

                //dd($searchthanacase, $ggg);

                $request->session()->flash('searchthanacase', $searchthanacase);
                // Search thana case
            }
        } else {
            // OC thana case
            $octhanacase = Casedb::with('thana')->selectRaw('COUNT(case_no) AS countcase, thanaID')
                           ->whereNotNull('case_no')
                           ->where('districtID', $dkey, $dvalue)
                           ->where('status', 'active')
                           ->where('circleID', $ckey, $cvalue)
                           ->where('thanaID', $tkey, $tvalue)
                           ->where('case_type', $caseTypeID_key, $caseTypeID)
                           ->where('casesub_type', $casesubID_key, $casesubID)
                           ->whereBetween('case_date', [$fvalue, $tovalue])
                           ->groupBy('thanaID')
                           ->orderBy('thanaID', 'ASC')
                           ->get();

            $ggg = 'ffff';

            //dd($searchthanacase, $ggg);

            $request->session()->flash('octhanacase', $octhanacase);
            // OC thana case
        }


        // Case type chart start

        $casetypec = Casedb::with('casetype')->selectRaw('COUNT(case_type) AS countcase_type, case_type')
        ->where('districtID', $dkey, $dvalue)
                              ->where('circleID', $ckey, $cvalue)
                              ->where('thanaID', $tkey, $tvalue)
                              ->where('status', 'active')
                              ->where('case_type', $caseTypeID_key, $caseTypeID)
                              ->where('casesub_type', $casesubID_key, $casesubID)
                              ->whereBetween('case_date', [$fvalue, $tovalue])
        ->groupBy('case_type')
        ->orderBy('case_type', 'ASC')
        ->get();

        $request->session()->flash('casetypec', $casetypec);
        // Case type chart end

        // Case sub type start

        $casesubtypec = Casedb::with('casesubtype')->selectRaw('COUNT(casesub_type) AS countcasesub_type, casesub_type, case_type')
        ->where('districtID', $dkey, $dvalue)
                              ->where('circleID', $ckey, $cvalue)
                              ->where('status', 'active')
                              ->where('thanaID', $tkey, $tvalue)
                              ->where('case_type', $caseTypeID_key, $caseTypeID)
                              ->where('casesub_type', $casesubID_key, $casesubID)
                              ->whereBetween('case_date', [$fvalue, $tovalue])
        ->where('casesub_type', '!=', 0)
        ->groupBy('casesub_type')
        ->orderBy('casesub_type', 'ASC')
        ->get();

        $request->session()->flash('casesubtypec', $casesubtypec);
        // Case sub type end


        // Case ending typyes start

        $caseendingtypes = Casedb::selectRaw('COUNT(nispotti_type) AS countnispotti_type, nispotti_type')
                              ->where('districtID', $dkey, $dvalue)
                              ->where('circleID', $ckey, $cvalue)
                              ->where('status', 'active')
                              ->where('thanaID', $tkey, $tvalue)
                              ->where('case_type', $caseTypeID_key, $caseTypeID)
                              ->where('casesub_type', $casesubID_key, $casesubID)
                              ->whereBetween('case_date', [$fvalue, $tovalue])
                              ->where('nispotti_type', '!=', '0')->groupBy('nispotti_type')->orderBy('nispotti_type', 'ASC')->get();

        $request->session()->flash('caseendingtypes', $caseendingtypes);
        // Case ending typyes start

        // Total case start
        $data['totalcase'] = Casedb::whereNotNull('case_no')
                               ->where('districtID', $dkey, $dvalue)
                               ->where('circleID', $ckey, $cvalue)
                               ->where('status', 'active')
                               ->where('thanaID', $tkey, $tvalue)
                               ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                               ->whereBetween('case_date', [$fvalue, $tovalue])
        ->count('case_no');

        // Total case end

        // Total ending case start

        $data['totalendingcase'] = Casedb::whereNotNull('case_no')->where('nispotti_or_multobi', 'নিস্পত্তি')

        ->where('districtID', $dkey, $dvalue)
                               ->where('circleID', $ckey, $cvalue)
                               ->where('thanaID', $tkey, $tvalue)
                               ->where('status', 'active')
                               ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                               ->whereBetween('case_date', [$fvalue, $tovalue])
        ->count('nispotti_or_multobi');

        // Total ending case end

        // Total multobi case start
        $data['totalmultobicase'] = Casedb::whereNotNull('case_no')->where('nispotti_or_multobi', 'মুলতবি')
        ->where('districtID', $dkey, $dvalue)
                               ->where('circleID', $ckey, $cvalue)
                               ->where('thanaID', $tkey, $tvalue)
                               ->where('status', 'active')
                               ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                               ->whereBetween('case_date', [$fvalue, $tovalue])
        ->count('nispotti_or_multobi');
        // Total multobi case end

        // Avg case ending time
        $data['avgendingcasetime'] = Casedb::whereNotNull('nispottisecond')
        ->where('districtID', $dkey, $dvalue)
                                  ->where('circleID', $ckey, $cvalue)
                                  ->where('thanaID', $tkey, $tvalue)
                                  ->where('status', 'active')
                                  ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                  ->whereBetween('case_date', [$fvalue, $tovalue])
        ->avg('nispottisecond');
        // Avg case ending time end


        // Ak nojora case details start

        $data['azaharnamioasami'] = Casedb::whereNotNull('azahar_namio_victims')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('status', 'active')
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->sum('azahar_namio_victims');

        $data['accusedasami'] = Casedb::whereNotNull('number_of_accused')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->sum('number_of_accused');

        $data['jaminprapto'] = Casedb::whereNotNull('jamin_prapto')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->sum('jamin_prapto');

        $data['ovohotiprapto'] = Casedb::whereNotNull('ovohoti')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->sum('ovohoti');

        $data['azaharnewinvistigateprapto'] = Casedb::whereNotNull('azahar_vukto_invistigate')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->sum('azahar_vukto_invistigate');
        
        $data['nispottimamlaiazahar'] = Casedb::whereNotNull('azahar_namio_victims')
        
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->where('nispotti_or_multobi', 'নিস্পত্তি')->sum('azahar_namio_victims');
        
        $data['onesixtyrecive'] = Casedb::whereNotNull('sixtyone_recive')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])->sum('sixtyone_recive');
        
        $data['onesixtyfourrecive'] = Casedb::whereNotNull('sixtyfour_recive')
       ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])->sum('sixtyfour_recive');
                                
        $data['policereportprapti'] = Casedb::whereNotNull('police_report_victim')
        ->where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('status', 'active')
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
        ->sum('police_report_victim');
        // Ak nojora case details end

        $data['reviewpending'] = Casedb::where('districtID', $dkey, $dvalue)
                                ->where('circleID', $ckey, $cvalue)
                                ->where('thanaID', $tkey, $tvalue)
                                ->where('case_type', $caseTypeID_key, $caseTypeID)
                                ->where('casesub_type', $casesubID_key, $casesubID)
                                ->whereBetween('case_date', [$fvalue, $tovalue])
                                 ->where('status', 'inactive')->count();


        //dd($lastthreemonthcase);

        $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])
                          ->where('districtID', $dkey, $dvalue)
                          ->where('circleID', $ckey, $cvalue)
                          ->where('thanaID', $tkey, $tvalue)
                          ->where('status', 'active')
                          ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                          ->whereBetween('case_date', [$fvalue, $tovalue])
                          ->orderBy('id', 'desc')
                          ->paginate(20);

        return view('admin/case/case-dashsc', $data);
    }


    public function chartdata(Request $request)
    {
        $data['request'] = $request;
        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();


            if (!empty($request->input('districtID'))) {
                $dkey = '=';
                $dvalue = $request->input('districtID');
            } else {
                $dkey = '!=';
                $dvalue = 'ss';
            }

            if (!empty($request->input('circleID'))) {
                $ckey = '=';
                $cvalue = $request->input('circleID');
            } else {
                $ckey = '!=';
                $cvalue = 'cc';
            }

            if (!empty($request->input('thanaID'))) {
                $tkey = '=';
                $tvalue = $request->input('thanaID');
            } else {
                $tkey = '!=';
                $tvalue = 'jj';
            }
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();

            $dkey = '=';
            $dvalue = auth()->user()->districtID;

            if (!empty($request->input('circleID'))) {
                $ckey = '=';
                $cvalue = $request->input('circleID');
            } else {
                $ckey = '!=';
                $cvalue = 'cc';
            }

            if (!empty($request->input('thanaID'))) {
                $tkey = '=';
                $tvalue = $request->input('thanaID');
            } else {
                $tkey = '!=';
                $tvalue = 'jj';
            }
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);
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


        if (!empty($request->input('nispotti_type'))) {
            $nispotti_type = $request->input('nispotti_type');
            $nispotti_type_key = '=';
        } else {
            $nispotti_type = 'DD';
            $nispotti_type_key = '!=';
        }

        if (!empty($request->input('caseTypeID'))) {
            $caseTypeID = $request->input('caseTypeID');
            $caseTypeID_key = '=';
        } else {
            $caseTypeID = '500';
            $caseTypeID_key = '!=';
        }

        if (!empty($request->input('casesubID'))) {
            $casesubID = $request->input('casesubID');
            $casesubID_key = '=';
        } else {
            $casesubID = '500';
            $casesubID_key = '!=';
        }


        $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])
                          ->where('districtID', $dkey, $dvalue)
                          ->where('circleID', $ckey, $cvalue)
                          ->where('thanaID', $tkey, $tvalue)
                          ->where('status', 'active')
                          ->where('nispotti_type', $nispotti_type_key, $nispotti_type)
                          ->where('case_type', $caseTypeID_key, $caseTypeID)
                          ->where('casesub_type', $casesubID_key, $casesubID)
                          ->whereBetween('case_date', [$fvalue, $tovalue])
                          ->orderBy('id', 'desc')
                          ->paginate(20);

        return view('admin/case/case-data', $data);
    }
}
