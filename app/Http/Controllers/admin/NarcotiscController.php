<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Narcotic;
use App\Models\District;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Thana;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class NarcotiscController extends Controller
{
    public function addShow(Request $request)
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

        return view('admin/narcotic/narcotic-add', $data);
    }

    private function reptpenum($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
    }

    public function addData(Request $request)
    {
        $date = Carbon::createFromFormat('d/m/Y', $request->input('sdate'));
        $day = $date->day;
        $month = $date->month;
        $year = $date->year;

        $request->merge([
           'serial' => $this->reptpenum($request->input('serial')),
           'folder_no' => $this->reptpenum($request->input('folder_no')),
           'case_no' => $this->reptpenum($request->input('case_no')),
           'nopc' => $this->reptpenum($request->input('nopc')),
           'bp_no' => $this->reptpenum($request->input('bp_no')),
           'mobile_no' => $this->reptpenum($request->input('mobile_no')),
           'gaza' => $this->reptpenum($request->input('gaza')),
           'gaza_tree' => $this->reptpenum($request->input('gaza_tree')),
           'yaba' => $this->reptpenum($request->input('yaba')),
           'heroine' => $this->reptpenum($request->input('heroine')),
           'fansdel' => $this->reptpenum($request->input('fansdel')),
           'cholai_alcohol' => $this->reptpenum($request->input('cholai_alcohol')),
           'bidesh_alcohol' => $this->reptpenum($request->input('bidesh_alcohol')),
           'lsd' => $this->reptpenum($request->input('lsd')),
           'ice' => $this->reptpenum($request->input('ice')),
           'otherd' => $this->reptpenum($request->input('otherd'))
        ]);

        $serial = $request->input('serial');
        $serialn = ($serial <= 9) ? '0' . $serial : $serial;

        $trakingid = $year . $month . $day . $serialn;

        $uid = auth()->user()->id;

        $request->request->add([
            'trakingID' => $trakingid,
            'user_id' => $uid, 'divisionID' => 1,
    ]);
        $request->merge(['sdate' => Carbon::createFromFormat('d/m/Y', $request->input('sdate'))->format('Y-m-d'),
     'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
    'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID')
    ]);
        if (!empty($request->input('tdate'))) {
            $request->merge(['tdate' => Carbon::createFromFormat('d/m/Y', $request->input('tdate'))->format('Y-m-d')]);
        }



        if (Narcotic::create($request->all())) {
            $request->session()->flash('success_msg', 'Data created successfully');
            return redirect('admin/narcotic/add');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/narcotic/add');
        }
    }

    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('districtID', auth()->user()->districtID)->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->orderBy('id', 'desc')->paginate(20);
        }


        return view('admin/narcotic/narcotic', $data);
    }

    public function editShow(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->first();

        if (!$data) {
            return redirect('admin/qrrs');
        }

        Gate::authorize('editdeletenarcotic', $data['nar']);

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
        $data['thanas'] = $data['nar']->districtID ? Thana::where('district_id', $data['nar']->districtID)->get() : [] ;

        return view('admin/narcotic/narcotic-edit', $data);
    }

    public function editUpdate(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->first();

        if (!$data) {
            return redirect('admin/qrrs');
        }

        Gate::authorize('editdeletenarcotic', $data['nar']);

        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['nar']->districtID ? Thana::where('district_id', $data['nar']->districtID)->get() : [] ;

        $date = Carbon::createFromFormat('d/m/Y', $request->input('sdate'));
        $day = $date->day;
        $month = $date->month;
        $year = $date->year;

        $request->merge([
            'serial' => $this->reptpenum($request->input('serial')),
            'folder_no' => $this->reptpenum($request->input('folder_no')),
            'case_no' => $this->reptpenum($request->input('case_no')),
            'nopc' => $this->reptpenum($request->input('nopc')),
            'bp_no' => $this->reptpenum($request->input('bp_no')),
            'mobile_no' => $this->reptpenum($request->input('mobile_no')),
            'gaza' => $this->reptpenum($request->input('gaza')),
            'gaza_tree' => $this->reptpenum($request->input('gaza_tree')),
            'yaba' => $this->reptpenum($request->input('yaba')),
            'heroine' => $this->reptpenum($request->input('heroine')),
            'fansdel' => $this->reptpenum($request->input('fansdel')),
            'cholai_alcohol' => $this->reptpenum($request->input('cholai_alcohol')),
            'bidesh_alcohol' => $this->reptpenum($request->input('bidesh_alcohol')),
            'lsd' => $this->reptpenum($request->input('lsd')),
            'ice' => $this->reptpenum($request->input('ice')),
            'otherd' => $this->reptpenum($request->input('otherd')),
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID')
        ]);

        $serial = $request->input('serial');
        $serialn = ($serial <= 9) ? '0' . $serial : $serial;

        $trakingid = $year . $month . $day . $serialn;

        $request->request->add(['trakingID' => $trakingid]);
        $request->merge(['sdate' => Carbon::createFromFormat('d/m/Y', $request->input('sdate'))->format('Y-m-d')]);
        if (!empty($request->input('tdate'))) {
            $request->merge(['tdate' => Carbon::createFromFormat('d/m/Y', $request->input('tdate'))->format('Y-m-d')]);
        }

        $request->request->remove('_token');
        $request->request->remove('submit');

        if (Narcotic::where('id', $id)->update($request->all())) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/narcotic');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }


        return view('admin/narcotic/narcotic-edit', $data);
    }

    public function delete(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $nar = Narcotic::find($id);
        Gate::authorize('editdeletenarcotic', $nar);

        if (Narcotic::where('id', $id)->delete()) {
            $request->session()->flash('success_msg', 'Data deleted successfully');
            return redirect('admin/narcotic');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/narcotic');
        }
        return redirect('admin/narcotic');
    }

    public function pView(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->with(['district', 'thana'])->first();

        if (!$data) {
            return redirect('admin/narcotic');
        }
        $data['request'] = $request;
        return view('admin/narcotic/narcotic-view', $data);
    }

    public function PrintView(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->with(['district', 'thana'])->first();

        if (!$data) {
            return redirect('admin/narcotic');
        }
        $data['request'] = $request;
        return view('admin/narcotic/narcotic-print-view', $data);
    }

    public function dashp(Request $request)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $data['districts'] = District::where('division_id', 1)->get();
            $data['request'] = $request;

            $data['narcotics'] = Narcotic::with('district')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            districtID
            ")->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza'] = Narcotic::sum('gaza');
            $data['gtgazatree'] = Narcotic::sum('gaza_tree');
            $data['gtyaba'] = Narcotic::sum('yaba');
            $data['gtheroine'] = Narcotic::sum('heroine');
            $data['gtfansdel'] = Narcotic::sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::sum('lsd');
            $data['gtice'] = Narcotic::sum('ice');
            $data['gtotherd'] = Narcotic::sum('otherd');

            $data['narcoticsthas'] = Narcotic::with('thana')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            districtID,
            thanaID
            ")->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            // Number of case graph

            $numofcase = Narcotic::with('district')->selectRaw("COUNT(case_no) AS totalcase, districtID")->whereNotNull('case_no')->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw("COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org")->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('district')->selectRaw("SUM(number_of_accused) AS totalarrast, districtID")->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->count('case_no');

            $data['totalarrast'] = Narcotic::sum('number_of_accused');
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['request'] = $request;
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['narcotics'] = Narcotic::with('thana')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            thanaID,
            districtID
            ")->where('districtID', auth()->user()->districtID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('gaza');
            $data['gtgazatree'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('yaba');
            $data['gtheroine'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('lsd');
            $data['gtice'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('ice');
            $data['gtotherd'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw("COUNT(case_no) AS totalcase, thanaID")->whereNotNull('case_no')->where('districtID', auth()->user()->districtID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw("COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org")->where('districtID', auth()->user()->districtID)->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw("SUM(number_of_accused) AS totalarrast, districtID, thanaID")->where('districtID', auth()->user()->districtID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('districtID', auth()->user()->districtID)->count('case_no');

            $data['totalarrast'] = Narcotic::where('districtID', auth()->user()->districtID)->sum('number_of_accused');
        }


        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['request'] = $request;

            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            $data['narcotics'] = Narcotic::with('thana')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            thanaID,
            districtID
            ")->where('thanaID', auth()->user()->thanaID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('gaza');
            $data['gtgazatree'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('yaba');
            $data['gtheroine'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('lsd');
            $data['gtice'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('ice');
            $data['gtotherd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw("COUNT(case_no) AS totalcase, thanaID")->whereNotNull('case_no')->where('thanaID', auth()->user()->thanaID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw("COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org")->where('thanaID', auth()->user()->thanaID)->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw("SUM(number_of_accused) AS totalarrast, districtID, thanaID")->where('thanaID', auth()->user()->thanaID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('thanaID', auth()->user()->thanaID)->count('case_no');

            $data['totalarrast'] = Narcotic::where('thanaID', auth()->user()->thanaID)->sum('number_of_accused');
        }



        return view('admin/narcotic/narcoticsc', $data);
    }

    public function dashsc(Request $request)
    {
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
            $tvalue = 'jj';
        }

        if (!empty($request->input('name_of_investigator_org'))) {
            $skey = '=';
            $svalue = $request->input('name_of_investigator_org');
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

        if (auth()->user()->hasRole('Super Admin')) {
            $data['narcotics'] = Narcotic::with('district')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            districtID
            ")->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza');

            $data['gtgazatree'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('yaba');
            $data['gtheroine'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('lsd');
            $data['gtice'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('ice');
            $data['gtotherd'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('otherd');

            $data['narcoticsthas'] = Narcotic::with('thana')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            districtID,
            thanaID
            ")->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            // Number of case graph

            $numofcase = Narcotic::with('district')->selectRaw("COUNT(case_no) AS totalcase, districtID") ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->whereNotNull('case_no')->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw("COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org")->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('district')->selectRaw("SUM(number_of_accused) AS totalarrast, districtID")
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->count('case_no');

            $data['totalarrast'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('number_of_accused');

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
            ->where('thanaID', $tkey, $tvalue)
            ->where('name_of_investigator_org', $skey, $svalue)
            ->whereBetween('sdate', [$fvalue, $tovalue])->paginate(20);
        }



        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['narcotics'] = Narcotic::with('thana')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            thanaID,
            districtID
            ")->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza');
            $data['gtgazatree'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('yaba');
            $data['gtheroine'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('lsd');
            $data['gtice'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('ice');
            $data['gtotherd'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw("COUNT(case_no) AS totalcase, thanaID")->whereNotNull('case_no')->where('districtID', auth()->user()->districtID)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw("COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org")->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw("SUM(number_of_accused) AS totalarrast, districtID, thanaID")->where('districtID', auth()->user()->districtID)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('districtID', auth()->user()->districtID)->count('case_no');

            $data['totalarrast'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
        ->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('number_of_accused');

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->where('name_of_investigator_org', $skey, $svalue)
            ->whereBetween('sdate', [$fvalue, $tovalue])->paginate(20);
        }


        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['request'] = $request;

            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            $data['narcotics'] = Narcotic::with('thana')->selectRaw("SUM(gaza) AS gazac,
            SUM(gaza_tree) AS gaza_treec,
            SUM(yaba) AS yabac,
            SUM(heroine) AS heroinec,
            SUM(fansdel) AS fansdelc,
            SUM(cholai_alcohol) AS cholai_alcoholc,
            SUM(bidesh_alcohol) AS bidesh_alcoholc,
            SUM(lsd) AS lsdc,
            SUM(ice) AS icec,
            SUM(otherd) AS otherdc,
            thanaID,
            districtID
            ")->where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza');
            $data['gtgazatree'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('yaba');
            $data['gtheroine'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('lsd');
            $data['gtice'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('ice');
            $data['gtotherd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw("COUNT(case_no) AS totalcase, thanaID")->whereNotNull('case_no')->where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw("COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org")->where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw("SUM(number_of_accused) AS totalarrast, districtID, thanaID")->where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('thanaID', auth()->user()->thanaID)->count('case_no');

            $data['totalarrast'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('number_of_accused');

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('thanaID', auth()->user()->thanaID)->where('name_of_investigator_org', $skey, $svalue)
            ->whereBetween('sdate', [$fvalue, $tovalue])->paginate(20);
        }



        return view('admin/narcotic/narcoticsc', $data);
    }
}
