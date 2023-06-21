<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Woman\WomanDataTable;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;
use App\Models\Woman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class WomanController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('url_return', $request->fullUrl());
        /*
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

        $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'active')->orderBy('id', 'desc')->paginate(20);

        */

        $datatable = new WomanDataTable();

        return $datatable->render('admin.woman.womans');
    }

    public function reviewList(Request $request)
    {
        $request->session()->put('url_return', $request->fullUrl());

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

        $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->where('status', 'inactive')->orderBy('id', 'desc')->paginate(20);

        return view('admin/woman/womans-review', $data);
    }

    public function reviewShow(Request $request, Woman $woman)
    {
        $data['woman'] = $woman;

        return view('admin/woman/woman-status', $data);
    }

    public function reviewUpdate(Request $request, Woman $woman)
    {
        //$data['qrr'] = $qrr;

        $data = [
            'status' => $request->input('statusg'),
        ];

        //dd($nar, $data);

        if ($woman->update($data)) {
            $request->session()->flash('success_msg', 'Data status updated successfully');
            //dd($nar, $data);
            return redirect('admin/woman/review');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect()->back();
        }
    }

    public function addWoman(Request $request)
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

        return view('admin/woman/woman-add', $data);
    }

    private function reptpenum($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
    }

    public function create(Request $request)
    {
        $dateandtime = Carbon::createFromFormat('d/m/Y H:i', $request->input('wdate').' '.$request->input('incident_time'))->format('Y-m-d H:i');

        if ($request->filled('nreport')) {
            $nreport = $request->input('nreport');
        } else {
            $nreport = 0;
        }

        if ($request->filled('action_taken')) {
            $action_taken = $request->input('action_taken');
        } else {
            $action_taken = 0;
        }

        $request->merge([
            'wdate' => $dateandtime,
            'badi_age' => $this->reptpenum($request->input('badi_age')),
            'badi_phone' => $this->reptpenum($request->input('badi_phone')),
            'mobile_no' => $this->reptpenum($request->input('mobile_no')),
            'gd_no' => $this->reptpenum($request->input('gd_no')),
            'mamla_no' => $this->reptpenum($request->input('mamla_no')),
            'dhara' => $this->reptpenum($request->input('dhara')),
            'complaint_no' => $this->reptpenum($request->input('complaint_no')),
            'user_id' => auth()->user()->id,
            'divisionID' => 1,
            'nreport' => $nreport,
            'action_taken' => $action_taken,
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
        ]);

        $wdatamerge = [];

        if ($request->filled('gd_date')) {
            $wdatamerge['gd_date'] = Carbon::createFromFormat('d/m/Y', $request->input('gd_date'))->format('Y-m-d');
        }

        if ($request->filled('mamla_date')) {
            $wdatamerge['mamla_date'] = Carbon::createFromFormat('d/m/Y', $request->input('mamla_date'))->format('Y-m-d');
        }

        if ($request->filled('complaint_date')) {
            $wdatamerge['complaint_date'] = Carbon::createFromFormat('d/m/Y', $request->input('complaint_date'))->format('Y-m-d');
        }

        $request->merge($wdatamerge);
        // dd($request->all());

        $request->request->remove('incident_time');

        if (Woman::create($request->all())) {
            $request->session()->flash('success_msg', 'Data added successfully');

            return redirect('admin/woman/add');
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

        return view('admin/woman/woman-add', $data);
    }

    public function editShow(Request $request, Woman $woman)
    {
        Gate::authorize('editdeletwoman', $woman);

        $data['woman'] = $woman;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }

        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['woman']->districtID ? Thana::where('district_id', $data['woman']->districtID)->get() : [];

        return view('admin/woman/woman-edit', $data);
    }

    public function update(Request $request, Woman $woman)
    {
        Gate::authorize('editdeletwoman', $woman);

        $data['districts'] = District::where('division_id', 1)->get();

        $dateandtime = Carbon::createFromFormat('d/m/Y H:i', $request->input('wdate').' '.$request->input('incident_time'))->format('Y-m-d H:i');

        if ($request->filled('nreport')) {
            $nreport = $request->input('nreport');
        } else {
            $nreport = 0;
        }

        if ($request->filled('action_taken')) {
            $action_taken = $request->input('action_taken');
        } else {
            $action_taken = 0;
        }

        $request->merge([
            'wdate' => $dateandtime,
            'badi_age' => $this->reptpenum($request->input('badi_age')),
            'badi_phone' => $this->reptpenum($request->input('badi_phone')),
            'mobile_no' => $this->reptpenum($request->input('mobile_no')),
            'gd_no' => $this->reptpenum($request->input('gd_no')),
            'mamla_no' => $this->reptpenum($request->input('mamla_no')),
            'dhara' => $this->reptpenum($request->input('dhara')),
            'complaint_no' => $this->reptpenum($request->input('complaint_no')),
            'nreport' => $nreport,
            'action_taken' => $action_taken,
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
        ]);
        // dd($request->all());

        $wdatamerge = [];

        if ($request->filled('gd_date')) {
            $wdatamerge['gd_date'] = Carbon::createFromFormat('d/m/Y', $request->input('gd_date'))->format('Y-m-d');
        }

        if ($request->filled('mamla_date')) {
            $wdatamerge['mamla_date'] = Carbon::createFromFormat('d/m/Y', $request->input('mamla_date'))->format('Y-m-d');
        }

        if ($request->filled('complaint_date')) {
            $wdatamerge['complaint_date'] = Carbon::createFromFormat('d/m/Y', $request->input('complaint_date'))->format('Y-m-d');
        }

        $request->merge($wdatamerge);

        $request->request->remove('incident_time');
        $request->request->remove('_token');
        $request->request->remove('submit');

        if ($woman->update($request->all())) {
            if (! empty($request->session()->get('url_return'))) {
                //$request->session()->put('qrrparam', $request->all());

                return redirect($request->session()->get('url_return'))->with('success_msg', 'Data updated successfully');
            } else {
                return redirect('admin/woman')->with('success_msg', 'Data updated successfully');
            }
        } else {
            if (! empty($request->session()->get('url_return'))) {
                //$request->session()->put('qrrparam', $request->all());

                return redirect($request->session()->get('url_return'))->with('error_msg', 'Something wrong. Please try again');
            } else {
                return redirect('admin/woman')->with('error_msg', 'Something wrong. Please try again');
            }
        }
    }

    public function delete(Request $request, Woman $woman)
    {
        Gate::authorize('editdeletwoman', $woman);

        if ($woman->delete()) {
            if (! empty($request->session()->get('url_return'))) {
                //$request->session()->put('qrrparam', $request->all());

                return redirect($request->session()->get('url_return'))->with('success_msg', 'Data deleted successfully');
            } else {
                return redirect('admin/woman')->with('success_msg', 'Data deleted successfully');
            }
        } else {
            if (! empty($request->session()->get('url_return'))) {
                //$request->session()->put('qrrparam', $request->all());

                return redirect($request->session()->get('error_msg'))->with('error_msg', 'Something wrong. Please try again');
            } else {
                return redirect('admin/woman')->with('error_msg', 'Something wrong. Please try again');
            }
        }
    }

    public function wview(Request $request, Woman $woman)
    {
        $data['woman'] = $woman;
        $data['request'] = $request;

        return view('admin/woman/woman-view', $data);
    }

    public function pview(Request $request, Woman $woman)
    {
        $data['woman'] = $woman;
        $data['request'] = $request;

        return view('admin/woman/woman-print', $data);
    }

    public function dashboard(Request $request)
    {
        $request->session()->put('url_return', $request->fullUrl());

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        $currentday = Carbon::now()->format('Y-m-d').' 23:59:59';

        $request->session()->flash('currentday', $currentday);

        $agomonthday = Carbon::now()->startOfMonth()->format('Y-m-d').' 00:00:00';

        $request->session()->flash('agomonthday', $agomonthday);

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            // Number of complain graph
            $totalcomplains = Woman::with('district')->selectRaw('COUNT(id) AS totalcomplain, districtID')->whereBetween('wdate', [$agomonthday, $currentday])->where('status', 'active')->groupBy('districtID')->orderBy('districtID', 'ASC')->get();

            //

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw('COUNT(id) AS totalactiontaken, action_taken')->whereBetween('wdate', [$agomonthday, $currentday])->where('status', 'active')->where('action_taken', '!=', '0')->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw('COUNT(id) AS disposalrepor, nreport')->whereBetween('wdate', [$agomonthday, $currentday])->where('status', 'active')->where('nreport', '!=', '0')->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // Number of satisfy rate start

            $satisfyrate = Woman::selectRaw('COUNT(id) AS satisfyrate, satisfy_rate')->whereBetween('wdate', [$agomonthday, $currentday])->where('status', 'active')->whereNotNull('satisfy_rate')->where('satisfy_rate', '!=', '')->groupBy('satisfy_rate')->orderBy('satisfy_rate', 'ASC')->get();
            $request->session()->flash('satisfyrate', $satisfyrate);
            // Number of satisfy rate end

            // total complain
            $data['totalcomplain'] = Woman::where('status', 'active')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            //end total complain

            // total disposal nispotti start

            $data['totalnispotti'] = Woman::where('nreport', 'নিষ্পত্তি')->where('status', 'active')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            // total disposal nispotti end

            // total pending start

            $data['totalpending'] = Woman::where('nreport', '!=', 'নিষ্পত্তি')->where('status', 'active')->whereBetween('wdate', [$agomonthday, $currentday])->count();

            // total pending end

            // Fidback taken

            $data['totalfidback'] = Woman::whereNotNull('satisfy_rate')->where('status', 'active')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            // Fidback taken

            $data['reviewpending'] = Woman::where('status', 'inactive')->count();

            $totalwoman = Woman::where('status', 'active')->count();

            $nispottiwoman = Woman::where('status', 'active')->where('nreport', 'নিষ্পত্তি')->count();

            $data['pendingpercen'] = round(($nispottiwoman / $totalwoman) * 100, 2);

            $data['womanpending'] = $totalwoman - $nispottiwoman;
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw('COUNT(id) AS totalcomplain, thanaID')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('wdate', [$agomonthday, $currentday])->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw('COUNT(id) AS totalactiontaken, action_taken')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('wdate', [$agomonthday, $currentday])->where('action_taken', '!=', '0')->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw('COUNT(id) AS disposalrepor, nreport')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('wdate', [$agomonthday, $currentday])->where('nreport', '!=', '0')->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // Number of satisfy rate start

            $satisfyrate = Woman::selectRaw('COUNT(id) AS satisfyrate, satisfy_rate')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('wdate', [$agomonthday, $currentday])->whereNotNull('satisfy_rate')->where('satisfy_rate', '!=', '')->groupBy('satisfy_rate')->orderBy('satisfy_rate', 'ASC')->get();
            $request->session()->flash('satisfyrate', $satisfyrate);
            // Number of satisfy rate end

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            //end total complain

            // total disposal nispotti start

            $data['totalnispotti'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->where('nreport', 'নিষ্পত্তি')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            // total disposal nispotti end

            // total pending start

            $data['totalpending'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->where('nreport', '!=', 'নিষ্পত্তি')->whereBetween('wdate', [$agomonthday, $currentday])->count();

            // total pending end

            // Fidback taken

            $data['totalfidback'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereNotNull('satisfy_rate')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            // Fidback taken

            $data['reviewpending'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'inactive')->count();

            $totalwoman = Woman::where('status', 'active')->where('districtID', auth()->user()->districtID)->count();

            $nispottiwoman = Woman::where('status', 'active')->where('districtID', auth()->user()->districtID)->where('nreport', 'নিষ্পত্তি')->count();

            $data['pendingpercen'] = round(($nispottiwoman / $totalwoman) * 100, 2);

            $data['womanpending'] = $totalwoman - $nispottiwoman;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw('COUNT(id) AS totalcomplain, thanaID')->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw('COUNT(id) AS totalactiontaken, action_taken')->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->whereBetween('wdate', [$agomonthday, $currentday])->where('action_taken', '!=', '0')->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw('COUNT(id) AS disposalrepor, nreport')->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->whereBetween('wdate', [$agomonthday, $currentday])->where('nreport', '!=', '0')->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // Number of satisfy rate start

            $satisfyrate = Woman::selectRaw('COUNT(id) AS satisfyrate, satisfy_rate')->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->whereBetween('wdate', [$agomonthday, $currentday])->whereNotNull('satisfy_rate')->where('satisfy_rate', '!=', '')->groupBy('satisfy_rate')->orderBy('satisfy_rate', 'ASC')->get();
            $request->session()->flash('satisfyrate', $satisfyrate);
            // Number of satisfy rate end

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('wdate', [$agomonthday, $currentday])->count();
            //end total complain

            // total disposal nispotti start

            $data['totalnispotti'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('nreport', 'নিষ্পত্তি')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            // total disposal nispotti end

            // total pending start

            $data['totalpending'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('nreport', '!=', 'নিষ্পত্তি')->whereBetween('wdate', [$agomonthday, $currentday])->count();

            // total pending end

            // Fidback taken

            $data['totalfidback'] = Woman::where('districtID', auth()->user()->districtID)->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereNotNull('satisfy_rate')->whereBetween('wdate', [$agomonthday, $currentday])->count();
            // Fidback taken

            $data['reviewpending'] = Woman::where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)
                                 ->where('status', 'inactive')->count();

            $totalwoman = Woman::where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->count();

            $nispottiwoman = Woman::where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->where('nreport', 'নিষ্পত্তি')->count();

            $data['pendingpercen'] = round(($nispottiwoman / $totalwoman) * 100, 2);

            $data['womanpending'] = $totalwoman - $nispottiwoman;
        }

        return view('admin/woman/womansc', $data);
    }

    public function dashboardsc(Request $request)
    {
        $request->session()->put('url_return', $request->fullUrl());

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (! empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (! empty($request->input('thanaID'))) {
            $tkey = '=';
            $tvalue = $request->input('thanaID');
        } else {
            $tkey = '!=';
            $tvalue = 'ss';
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

        if (! empty($request->input('action_taken'))) {
            $akey = '=';
            $avalue = $request->input('action_taken');
        } else {
            $akey = '!=';
            $avalue = 'ss';
        }

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            if ($request->filled('districtID')) {
                // Number of complain graph
                $totalcomplains = Woman::with('district')->selectRaw('COUNT(id) AS totalcomplain, districtID, thanaID')
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
        ->where('districtID', $request->input('districtID'))
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();
            } else {
                // Number of complain graph
                $totalcomplains = Woman::with('district')->selectRaw('COUNT(id) AS totalcomplain, districtID')
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('districtID')->orderBy('districtID', 'ASC')->get();
            }

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw('COUNT(id) AS totalactiontaken, action_taken')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->where('action_taken', '!=', '0')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw('COUNT(id) AS disposalrepor, nreport')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->where('nreport', '!=', '0')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // Number of satisfy rate start

            $satisfyrate = Woman::selectRaw('COUNT(id) AS satisfyrate, satisfy_rate')
            ->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
            ->whereNotNull('satisfy_rate')->where('satisfy_rate', '!=', '')->groupBy('satisfy_rate')->orderBy('satisfy_rate', 'ASC')->get();
            $request->session()->flash('satisfyrate', $satisfyrate);
            // Number of satisfy rate end

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->count();
            //end total complain

            // total disposal nispotti start

            $data['totalnispotti'] = Woman::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->where('nreport', 'নিষ্পত্তি')->count();
            // total disposal nispotti end

            // total pending start

            $data['totalpending'] = Woman::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->where('nreport', '!=', 'নিষ্পত্তি')
            ->count();

            // total pending end

            // Fidback taken

            $data['totalfidback'] = Woman::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->whereNotNull('satisfy_rate')->count();
            // Fidback taken

            $data['reviewpending'] = Woman::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
                                 ->where('status', 'inactive')->count();

            $totalwoman = Woman::where('districtID', $dkey, $dvalue)
            ->where('thanaID', $tkey, $tvalue)
            ->where('action_taken', $akey, $avalue)
            ->where('status', 'active')
            ->whereBetween('wdate', ['1971-01-01 11:45:00', $tovalue])->count();

            $nispottiwoman = Woman::where('districtID', $dkey, $dvalue)
            ->where('thanaID', $tkey, $tvalue)
            ->where('action_taken', $akey, $avalue)
            ->where('status', 'active')
            ->whereBetween('wdate', ['1971-01-01 11:45:00', $tovalue])->where('nreport', 'নিষ্পত্তি')->count();

            $data['pendingpercen'] = round(($nispottiwoman / $totalwoman) * 100, 2);

            $data['womanpending'] = $totalwoman - $nispottiwoman;

            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw('COUNT(id) AS totalcomplain, thanaID')
            ->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw('COUNT(id) AS totalactiontaken, action_taken')->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->where('action_taken', '!=', '0')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw('COUNT(id) AS disposalrepor, nreport')->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', '!=', '0')
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // Number of satisfy rate start

            $satisfyrate = Woman::selectRaw('COUNT(id) AS satisfyrate, satisfy_rate')
            ->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
            ->whereNotNull('satisfy_rate')->where('satisfy_rate', '!=', '')->groupBy('satisfy_rate')->orderBy('satisfy_rate', 'ASC')->get();
            $request->session()->flash('satisfyrate', $satisfyrate);
            // Number of satisfy rate end

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->count();
            //end total complain

            // total disposal nispotti start

            $data['totalnispotti'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->where('nreport', 'নিষ্পত্তি')->count();
            // total disposal nispotti end

            // total pending start

            $data['totalpending'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->where('nreport', '!=', 'নিষ্পত্তি')
            ->count();

            // total pending end

            // Fidback taken

            $data['totalfidback'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->whereNotNull('satisfy_rate')->count();
            // Fidback taken

            $data['reviewpending'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->where('action_taken', $akey, $avalue)
                                 ->where('status', 'inactive')->count();

            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);

            $totalwoman = Woman::where('districtID', auth()->user()->districtID)
            ->where('thanaID', $tkey, $tvalue)
            ->where('action_taken', $akey, $avalue)
            ->where('status', 'active')
                ->whereBetween('wdate', ['1971-01-01 11:45:00', $tovalue])->count();

            $nispottiwoman = Woman::where('districtID', auth()->user()->districtID)
            ->where('thanaID', $tkey, $tvalue)
            ->where('action_taken', $akey, $avalue)
            ->where('status', 'active')
            ->whereBetween('wdate', ['1971-01-01 11:45:00', $tovalue])->where('nreport', 'নিষ্পত্তি')->count();

            $data['pendingpercen'] = round(($nispottiwoman / $totalwoman) * 100, 2);

            $data['womanpending'] = $totalwoman - $nispottiwoman;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw('COUNT(id) AS totalcomplain, thanaID')
            ->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw('COUNT(id) AS totalactiontaken, action_taken')->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('action_taken', '!=', '0')
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw('COUNT(id) AS disposalrepor, nreport')->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->where('nreport', '!=', '0')
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // Number of satisfy rate start

            $satisfyrate = Woman::selectRaw('COUNT(id) AS satisfyrate, satisfy_rate')
            ->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
            ->whereNotNull('satisfy_rate')->where('satisfy_rate', '!=', '')->groupBy('satisfy_rate')->orderBy('satisfy_rate', 'ASC')->get();
            $request->session()->flash('satisfyrate', $satisfyrate);
            // Number of satisfy rate end

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->count();
            //end total complain

            // total disposal nispotti start

            $data['totalnispotti'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->where('nreport', 'নিষ্পত্তি')->count();
            // total disposal nispotti end

            // total pending start

            $data['totalpending'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->where('nreport', '!=', 'নিষ্পত্তি')
            ->count();

            // total pending end

            // Fidback taken

            $data['totalfidback'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->whereNotNull('satisfy_rate')->count();
            // Fidback taken

            $data['reviewpending'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
                                 ->where('status', 'inactive')->count();

            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);

            $totalwoman = Woman::where('districtID', auth()->user()->districtID)
            ->where('thanaID', auth()->user()->thanaID)
            ->where('action_taken', $akey, $avalue)
            ->where('status', 'active')
                ->whereBetween('wdate', ['1971-01-01 11:45:00', $tovalue])->count();

            $nispottiwoman = Woman::where('districtID', auth()->user()->districtID)
            ->where('thanaID', auth()->user()->thanaID)
            ->where('action_taken', $akey, $avalue)
            ->where('status', 'active')
            ->whereBetween('wdate', ['1971-01-01 11:45:00', $tovalue])->where('nreport', 'নিষ্পত্তি')->count();

            $data['pendingpercen'] = round(($nispottiwoman / $totalwoman) * 100, 2);

            $data['womanpending'] = $totalwoman - $nispottiwoman;
        }

        return view('admin/woman/womansr', $data);
    }

    public function womancclick(Request $request)
    {
        $request->session()->put('url_return', $request->fullUrl());

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (! empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (! empty($request->input('thanaID'))) {
            $tkey = '=';
            $tvalue = $request->input('thanaID');
        } else {
            $tkey = '!=';
            $tvalue = 'ss';
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

        if (! empty($request->input('action_taken'))) {
            $akey = '=';
            $avalue = $request->input('action_taken');
        } else {
            $akey = '!=';
            $avalue = 'ss';
        }

        if (! empty($request->input('nreport'))) {
            $nkey = '=';
            $nvalue = $request->input('nreport');
        } else {
            $nkey = '!=';
            $nvalue = 'ss';
        }

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            //show data

            if (! empty($request->input('satisfy_rate'))) {
                $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->where('status', 'active')
        ->where('satisfy_rate', $request->input('satisfy_rate'))
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
            } else {
                $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->where('status', 'active')
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
            }
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
            //show data

            if (! empty($request->input('satisfy_rate'))) {
                $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->where('status', 'active')
        ->where('satisfy_rate', $request->input('satisfy_rate'))
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
            } else {
                $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->where('status', 'active')
        ->where('satisfy_rate', $request->input('satisfy_rate'))
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
            }
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            //show data

            if (! empty($request->input('satisfy_rate'))) {
                $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->where('status', 'active')
        ->where('satisfy_rate', $request->input('satisfy_rate'))
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
            } else {
                $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->where('status', 'active')
        ->where('satisfy_rate', $request->input('satisfy_rate'))
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
            }
        }

        return view('admin/woman/woman-chartlink', $data);
    }
}
