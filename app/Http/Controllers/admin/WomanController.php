<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\Woman;
use Illuminate\Support\Facades\Gate;

class WomanController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super Admin')) {
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

        $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->orderBy('id', 'desc')->paginate(20);

        return view('admin/woman/womans', $data);
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
        $dateandtime = Carbon::createFromFormat('d/m/Y h:i A', $request->input('wdate').' '.$request->input('incident_time'))->format('Y-m-d H:s:i');
        $request->merge(['wdate' => $dateandtime,
    'badi_age' => $this->reptpenum($request->input('badi_age')),
'badi_phone' => $this->reptpenum($request->input('badi_phone')),
'mobile_no' => $this->reptpenum($request->input('mobile_no')),
'gd_no' => $this->reptpenum($request->input('gd_no')),
'mamla_no' => $this->reptpenum($request->input('mamla_no')),
'dhara' => $this->reptpenum($request->input('dhara')),
'complaint_no' => $this->reptpenum($request->input('complaint_no')),
'gd_date' => Carbon::createFromFormat('d/m/Y', $request->input('gd_date'))->format('Y-m-d'),
'mamla_date' => Carbon::createFromFormat('d/m/Y', $request->input('mamla_date'))->format('Y-m-d'),
'user_id' => auth()->user()->id,
'divisionID' => 1,
 'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
 'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID')
]);
        // dd($request->all());

        $request->request->remove('incident_time');

        if (Woman::create($request->all())) {
            $request->session()->flash('success_msg', 'Data updated successfully');
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
        $data['thanas'] = $data['woman']->districtID ? Thana::where('district_id', $data['woman']->districtID)->get() : [] ;

        return view('admin/woman/woman-edit', $data);
    }

    public function update(Request $request, Woman $woman)
    {
        Gate::authorize('editdeletwoman', $woman);

        $data['districts'] = District::where('division_id', 1)->get();

        $dateandtime = Carbon::createFromFormat('d/m/Y h:i A', $request->input('wdate').' '.$request->input('incident_time'))->format('Y-m-d H:s:i');
        $request->merge([
                       'wdate' => $dateandtime,
                       'badi_age' => $this->reptpenum($request->input('badi_age')),
                       'badi_phone' => $this->reptpenum($request->input('badi_phone')),
                       'mobile_no' => $this->reptpenum($request->input('mobile_no')),
                       'gd_no' => $this->reptpenum($request->input('gd_no')),
                       'mamla_no' => $this->reptpenum($request->input('mamla_no')),
                       'dhara' => $this->reptpenum($request->input('dhara')),
                       'complaint_no' => $this->reptpenum($request->input('complaint_no')),
                       'gd_date' => Carbon::createFromFormat('d/m/Y', $request->input('gd_date'))->format('Y-m-d'),
                       'mamla_date' => Carbon::createFromFormat('d/m/Y', $request->input('mamla_date'))->format('Y-m-d'),
                       'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
                       'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID')
                       ]);
        // dd($request->all());

        $request->request->remove('incident_time');
        $request->request->remove('_token');
        $request->request->remove('submit');

        if ($woman->update($request->all())) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/woman');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect()->back();
        }
    }

    public function delete(Woman $woman)
    {
        Gate::authorize('editdeletwoman', $woman);

        if ($woman->delete()) {
            $request->session()->flash('success_msg', 'Data deleted successfully');
            return redirect('admin/woman');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect()->back();
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
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;


        if (auth()->user()->hasRole('Super Admin')) {
            // Number of complain graph
            $totalcomplains = Woman::with('district')->selectRaw("COUNT(id) AS totalcomplain, districtID")->groupBy('districtID')->orderBy('districtID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw("COUNT(id) AS totalactiontaken, action_taken")->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw("COUNT(id) AS disposalrepor, nreport")->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // total complain
            $data['totalcomplain'] = Woman::count();
            //end total complain
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw("COUNT(id) AS totalcomplain, thanaID")->where('districtID', auth()->user()->districtID)->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw("COUNT(id) AS totalactiontaken, action_taken")->where('districtID', auth()->user()->districtID)->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw("COUNT(id) AS disposalrepor, nreport")->where('districtID', auth()->user()->districtID)->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // total complain
            $data['totalcomplain'] = Woman::count();
            //end total complain
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw("COUNT(id) AS totalcomplain, thanaID")->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw("COUNT(id) AS totalactiontaken, action_taken")->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw("COUNT(id) AS disposalrepor, nreport")->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // total complain
            $data['totalcomplain'] = Woman::count();
            //end total complain
        }

        return view('admin/woman/womansc', $data);
    }

    public function dashboardsc(Request $request)
    {
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
            $tvalue = 'ss';
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

        if (!empty($request->input('action_taken'))) {
            $akey = '=';
            $avalue = $request->input('action_taken');
        } else {
            $akey = '!=';
            $avalue = 'ss';
        }

        if (auth()->user()->hasRole('Super Admin')) {
            // Number of complain graph
            $totalcomplains = Woman::with('district')->selectRaw("COUNT(id) AS totalcomplain, districtID")
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('districtID')->orderBy('districtID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw("COUNT(id) AS totalactiontaken, action_taken")->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw("COUNT(id) AS disposalrepor, nreport")->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->count();
            //end total complain

            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw("COUNT(id) AS totalcomplain, thanaID")
            ->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw("COUNT(id) AS totalactiontaken, action_taken")->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw("COUNT(id) AS disposalrepor, nreport")->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->count();
            //end total complain

            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            // Number of complain graph
            $totalcomplains = Woman::with('thana')->selectRaw("COUNT(id) AS totalcomplain, thanaID")
            ->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('thanaID')->orderBy('thanaID', 'ASC')->get();

            //dd($totalcomplain);
            $request->session()->flash('totalcomplains', $totalcomplains);
            // end number of complain

            // Number of action taken graph
            $actiontakens = Woman::selectRaw("COUNT(id) AS totalactiontaken, action_taken")->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('action_taken')->orderBy('action_taken', 'ASC')->get();

            $request->session()->flash('actiontakens', $actiontakens);
            //end Number of action taken

            // Number of disposal report graph
            $disposalrepors = Woman::selectRaw("COUNT(id) AS disposalrepor, nreport")->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->groupBy('nreport')->orderBy('nreport', 'ASC')->get();
            $request->session()->flash('disposalrepors', $disposalrepors);
            //end number of disposal report

            // total complain
            $data['totalcomplain'] = Woman::where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->count();
            //end total complain

            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        return view('admin/woman/womansr', $data);
    }

    public function womancclick(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

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
            $tvalue = 'ss';
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

        if (!empty($request->input('action_taken'))) {
            $akey = '=';
            $avalue = $request->input('action_taken');
        } else {
            $akey = '!=';
            $avalue = 'ss';
        }

        if (!empty($request->input('nreport'))) {
            $nkey = '=';
            $nvalue = $request->input('nreport');
        } else {
            $nkey = '!=';
            $nvalue = 'ss';
        }

        if (auth()->user()->hasRole('Super Admin')) {
            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', $tkey, $tvalue)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            //show data

            $data['womans'] = Woman::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)
        ->where('thanaID', auth()->user()->thanaID)
        ->where('action_taken', $akey, $avalue)
        ->where('nreport', $nkey, $nvalue)
        ->whereBetween('wdate', [$fvalue, $tovalue])->paginate(20);
        }

        return view('admin/woman/woman-chartlink', $data);
    }
}
