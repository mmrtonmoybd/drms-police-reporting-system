<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Narcotic\NarcoticDataTable;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Narcotic;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

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
            'otherd' => $this->reptpenum($request->input('otherd')),
            'number_of_include' => $this->reptpenum($request->input('number_of_include')),
        ]);

        $serial = $request->input('serial');
        $serialn = ($serial <= 9) ? '0'.$serial : $serial;

        $trakingid = $year.$month.$day.$serialn;

        $uid = auth()->user()->id;

        $request->request->add([
            'trakingID' => $trakingid,
            'user_id' => $uid, 'divisionID' => 1,
        ]);
        $request->merge(['sdate' => Carbon::createFromFormat('d/m/Y', $request->input('sdate'))->format('Y-m-d'),
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
        ]);
        if (! empty($request->input('tdate'))) {
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
        /*
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('status', 'active')->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->orderBy('id', 'desc')->paginate(20);
        }

        */

        $datatable = new NarcoticDataTable();

        return $datatable->render('admin.narcotic.narcotic');

        //return view('admin/narcotic/narcotic', $data);
    }

    public function reviewList(Request $request)
    {
        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('status', 'inactive')->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('status', 'inactive')->where('districtID', auth()->user()->districtID)->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $query = Narcotic::query();
            $query->with(['district', 'thana']);
            $data['narcotics'] = $query->where('status', 'inactive')->where('districtID', auth()->user()->districtID)->where('thanaID', auth()->user()->thanaID)->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin/narcotic/narcotic-review', $data);
    }

    public function reviewShow(Request $request, Narcotic $nar)
    {
        $data['nar'] = $nar;

        return view('admin/narcotic/narcotic-status', $data);
    }

    public function reviewUpdate(Request $request, Narcotic $nar)
    {
        //$data['qrr'] = $qrr;

        $data = [
            'status' => $request->input('statusg'),
        ];

        //dd($nar, $data);

        if ($nar->update($data)) {
            $request->session()->flash('success_msg', 'Data status updated successfully');
            //dd($nar, $data);
            return redirect('admin/narcotic/review');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect()->back();
        }
    }

    public function editShow(Request $request, $id)
    {
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->first();

        if (! $data) {
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
        $data['thanas'] = $data['nar']->districtID ? Thana::where('district_id', $data['nar']->districtID)->get() : [];

        return view('admin/narcotic/narcotic-edit', $data);
    }

    public function editUpdate(Request $request, $id)
    {
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->first();

        if (! $data) {
            return redirect('admin/qrrs');
        }

        Gate::authorize('editdeletenarcotic', $data['nar']);

        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['nar']->districtID ? Thana::where('district_id', $data['nar']->districtID)->get() : [];

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
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'number_of_include' => $this->reptpenum($request->input('number_of_include')),
        ]);

        $serial = $request->input('serial');
        $serialn = ($serial <= 9) ? '0'.$serial : $serial;

        $trakingid = $year.$month.$day.$serialn;

        $request->request->add(['trakingID' => $trakingid]);
        $request->merge(['sdate' => Carbon::createFromFormat('d/m/Y', $request->input('sdate'))->format('Y-m-d')]);
        if (! empty($request->input('tdate'))) {
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
        if (! $id or ! is_numeric($id)) {
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
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->with(['district', 'thana'])->first();

        if (! $data) {
            return redirect('admin/narcotic');
        }
        $data['request'] = $request;

        return view('admin/narcotic/narcotic-view', $data);
    }

    public function PrintView(Request $request, $id)
    {
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/narcotic');
        }

        $data['nar'] = Narcotic::where('id', $id)->with(['district', 'thana'])->first();

        if (! $data) {
            return redirect('admin/narcotic');
        }
        $data['request'] = $request;

        return view('admin/narcotic/narcotic-print-view', $data);
    }

    public function dashp(Request $request)
    {
        $currentday = Carbon::now()->format('Y-m-d').' 23:59:59';

        $request->session()->flash('currentday', $currentday);

        $agomonthday = Carbon::now()->startOfMonth()->format('Y-m-d').' 00:00:00';

        $request->session()->flash('agomonthday', $agomonthday);

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();
            $data['request'] = $request;

            $data['narcotics'] = Narcotic::with('district')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('status', 'active')
            ->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('gaza');
            $data['gtgazatree'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('yaba');
            $data['gtheroine'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('heroine');
            $data['gtfansdel'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('lsd');
            $data['gtice'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('ice');
            $data['gtotherd'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('otherd');

            $data['narcoticsthas'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            // Number of case graph

            $numofcase = Narcotic::with('district')->selectRaw('COUNT(case_no) AS totalcase, districtID')->where('status', 'active')->whereNotNull('case_no')->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw('COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('district')->selectRaw('SUM(number_of_accused) AS totalarrast, districtID')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->count('case_no');

            $data['totalarrast'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])->where('status', 'active')->sum('number_of_accused');

            $data['reviewpending'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])
                                 ->where('status', 'inactive')->count();
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['request'] = $request;
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['narcotics'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->where('districtID', auth()->user()->districtID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('gaza');
            $data['gtgazatree'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('yaba');
            $data['gtheroine'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('lsd');
            $data['gtice'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('ice');
            $data['gtotherd'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw('COUNT(case_no) AS totalcase, thanaID')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->whereNotNull('case_no')->where('districtID', auth()->user()->districtID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw('COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->where('districtID', auth()->user()->districtID)->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw('SUM(number_of_accused) AS totalarrast, districtID, thanaID')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->where('districtID', auth()->user()->districtID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->count('case_no');

            $data['totalarrast'] = Narcotic::where('districtID', auth()->user()->districtID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('number_of_accused');

            $data['reviewpending'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])
                                  ->where('districtID', auth()->user()->districtID)
                                 ->where('status', 'inactive')->count();
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['request'] = $request;

            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            $data['narcotics'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->where('thanaID', auth()->user()->thanaID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('gaza');
            $data['gtgazatree'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('gaza_tree');
            $data['gtyaba'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('yaba');
            $data['gtheroine'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('heroine');
            $data['gtfansdel'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('fansdel');
            $data['gtcholai_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('bidesh_alcohol');
            $data['gtlsd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('lsd');
            $data['gtice'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('ice');
            $data['gtotherd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw('COUNT(case_no) AS totalcase, thanaID')->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->whereNotNull('case_no')->where('thanaID', auth()->user()->thanaID)->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw('COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw('SUM(number_of_accused) AS totalarrast, districtID, thanaID')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('sdate', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->count('case_no');

            $data['totalarrast'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday])->sum('number_of_accused');

            $data['reviewpending'] = Narcotic::whereBetween('sdate', [$agomonthday, $currentday])
                                  ->where('thanaID', auth()->user()->thanaID)
                                 ->where('status', 'inactive')->count();
        }

        return view('admin/narcotic/narcoticsc', $data);
    }

    public function dashsc(Request $request)
    {
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
            $tvalue = 'jj';
        }

        if (! empty($request->input('name_of_investigator_org')) && is_array($request->input('name_of_investigator_org'))) {
            $skey = '=';
            $svalue = $request->input('name_of_investigator_org');
        } else {
            $skey = '!=';
            $svalue = ['থানা পুলিশ', 'ডিবি', 'র‍্যাব', 'এপিবিএন', 'মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর', 'কোস্টগার্ড', 'অন্যান্য'];
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

        // dd($request->all(), $request->input('name_of_investigator_org'));

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();
            $data['request'] = $request;
            $data['narcotics'] = Narcotic::with('district')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza');

            $data['gtgazatree'] = Narcotic::where('districtID', $dkey, $dvalue)
            ->where('status', 'active')
        ->where('thanaID', $tkey, $tvalue)
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza_tree');

            $data['gtyaba'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('yaba');

            $data['gtheroine'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('heroine');

            $data['gtfansdel'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('fansdel');

            $data['gtcholai_alcohol'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('cholai_alcohol');

            $data['gtbidesh_alcohol'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('bidesh_alcohol');

            $data['gtlsd'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('lsd');

            $data['gtice'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('ice');

            $data['gtotherd'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('otherd');

            $data['narcoticsthas'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->where('status', 'active')
        ->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            if ($request->filled('districtID')) {
                // Number of case graph

                $numofcase = Narcotic::with(['district', 'thana'])->selectRaw('COUNT(case_no) AS totalcase, districtID, thanaID')
                ->whereIn('name_of_investigator_org', $svalue)
                             ->where('districtID', $request->input('districtID'))
                             ->where('thanaID', $tkey, $tvalue)
                             ->where('status', 'active')
                             ->whereBetween('sdate', [$fvalue, $tovalue])->whereNotNull('case_no')->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

                // arrest by unit

                $arrastbyu = Narcotic::with(['district', 'thana'])->selectRaw('SUM(number_of_accused) AS totalarrast, districtID, thanaID')
                ->whereIn('name_of_investigator_org', $svalue)
                             ->where('districtID', $request->input('districtID'))
                             ->where('thanaID', $tkey, $tvalue)
                             ->where('status', 'active')
                             ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();
            } else {
                // Number of case graph

                $numofcase = Narcotic::with('district')->selectRaw('COUNT(case_no) AS totalcase, districtID')->whereIn('name_of_investigator_org', $svalue)
                             ->where('status', 'active')
                             ->whereBetween('sdate', [$fvalue, $tovalue])->whereNotNull('case_no')->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

                // arrest by unit

                $arrastbyu = Narcotic::with('district')->selectRaw('SUM(number_of_accused) AS totalarrast, districtID')
                ->whereIn('name_of_investigator_org', $svalue)
                               ->where('status', 'active')
                               ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();
            }

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw('COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit
            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->count('case_no');

            $data['totalarrast'] = Narcotic::where('districtID', $dkey, $dvalue)
        ->where('thanaID', $tkey, $tvalue)
        ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('number_of_accused');

            $data['reviewpending'] = Narcotic::where('districtID', $dkey, $dvalue)
                ->where('thanaID', $tkey, $tvalue)
                ->whereIn('name_of_investigator_org', $svalue)
                ->whereBetween('sdate', [$fvalue, $tovalue])
                                     ->where('status', 'inactive')->count();

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
            ->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
            ->where('status', 'active')
            ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['narcotics'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza');

            $data['gtgazatree'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza_tree');

            $data['gtyaba'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('yaba');

            $data['gtheroine'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('heroine');

            $data['gtfansdel'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('fansdel');

            $data['gtcholai_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('cholai_alcohol');

            $data['gtbidesh_alcohol'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('bidesh_alcohol');

            $data['gtlsd'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('lsd');

            $data['gtice'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('ice');

            $data['gtotherd'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw('COUNT(case_no) AS totalcase, thanaID')->whereNotNull('case_no')->where('districtID', auth()->user()->districtID)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw('COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org')->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw('SUM(number_of_accused) AS totalarrast, districtID, thanaID')->where('districtID', auth()->user()->districtID)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('districtID', auth()->user()->districtID)->count('case_no');

            $data['totalarrast'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
        ->where('status', 'active')
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('number_of_accused');

            $data['reviewpending'] = Narcotic::where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
                ->whereBetween('sdate', [$fvalue, $tovalue])
                                     ->where('status', 'inactive')->count();

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
            ->where('status', 'active')
            ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['request'] = $request;

            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
            $data['narcotics'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza');

            $data['gtgazatree'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('gaza_tree');

            $data['gtyaba'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('yaba');

            $data['gtheroine'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('heroine');

            $data['gtfansdel'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('fansdel');

            $data['gtcholai_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('cholai_alcohol');

            $data['gtbidesh_alcohol'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('bidesh_alcohol');

            $data['gtlsd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('lsd');

            $data['gtice'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('ice');

            $data['gtotherd'] = Narcotic::where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->sum('otherd');

            // Number of case graph

            $numofcase = Narcotic::with('thana')->selectRaw('COUNT(case_no) AS totalcase, thanaID')->whereNotNull('case_no')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('numofcase', $numofcase);

            // operation conducting authority

            $conduautho = Narcotic::selectRaw('COUNT(name_of_investigator_org) AS totalinvisauth, name_of_investigator_org')->where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('status', 'active')->orderBy('name_of_investigator_org', 'ASC')->groupBy('name_of_investigator_org')->get();
            $request->session()->flash('conduautho', $conduautho);
            // dd($numofcase);

            // arrest by unit

            $arrastbyu = Narcotic::with('thana')->selectRaw('SUM(number_of_accused) AS totalarrast, districtID, thanaID')->where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('status', 'active')->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $request->session()->flash('arrastbyu', $arrastbyu);

            $data['totalcase'] = Narcotic::whereNotNull('case_no')->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->count('case_no');

            $data['totalarrast'] = Narcotic::where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
        ->whereBetween('sdate', [$fvalue, $tovalue])->where('status', 'active')->sum('number_of_accused');

            $data['reviewpending'] = Narcotic::where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
                ->whereBetween('sdate', [$fvalue, $tovalue])
                                     ->where('status', 'inactive')->count();

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
            ->whereBetween('sdate', [$fvalue, $tovalue])->where('status', 'active')->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin/narcotic/narcoticsc', $data);
    }

    public function chartlink(Request $request)
    {
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
            $tvalue = 'jj';
        }

        if (! empty($request->input('name_of_investigator_org')) && is_array($request->input('name_of_investigator_org'))) {
            $skey = '=';
            $svalue = $request->input('name_of_investigator_org');
        } else {
            $skey = '!=';
            $svalue = ['থানা পুলিশ', 'ডিবি', 'র‍্যাব', 'এপিবিএন', 'মাদকদ্রব্য নিয়ন্ত্রণ অধিদপ্তর', 'কোস্টগার্ড', 'অন্যান্য'];
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

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();
            $data['request'] = $request;
            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)
            ->where('thanaID', $tkey, $tvalue)
            ->where('status', 'active')
            ->whereIn('name_of_investigator_org', $svalue)
            ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)
            ->whereIn('name_of_investigator_org', $svalue)
            ->where('status', 'active')
            ->whereBetween('sdate', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['request'] = $request;

            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;

            $data['narcotics2'] = Narcotic::with(['district', 'thana'])->where('thanaID', auth()->user()->thanaID)->whereIn('name_of_investigator_org', $svalue)
            ->whereBetween('sdate', [$fvalue, $tovalue])->where('status', 'active')->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin/narcotic/narcotic-clickchart', $data);
    }

    public function narcoticcase(Request $request)
    {
        $data['request'] = $request;

        return view('admin/narcotic/narcotic-totalcase', $data);
    }

    private function repmonntobn($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
    }

    public function tcsrc(Request $request)
    {
        $request->validate([
            'to1' => 'required|date',
            'form1' => 'required|date',
            'to2' => 'required|date',
            'form2' => 'required|date',
        ]);

        $data['request'] = $request;

        $to1 = Carbon::parse($request->input('to1'))->toDateTimeString();
        $from1 = Carbon::parse($request->input('form1'))->toDateTimeString();

        $to2 = Carbon::parse($request->input('to2'))->toDateTimeString();
        $from2 = Carbon::parse($request->input('form2'))->toDateTimeString();

        if (! empty($request->input('form1'))) {
            $fkey1 = '=';
            $fvalue1 = $from1;

            $date1 = Carbon::parse($fvalue1);
            $fvalue1 = $date1->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey1 = '=';
            $fvalue1 = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to1'))) {
            $tokey1 = '=';
            $tovalue1 = $to1;

            $date1 = Carbon::parse($tovalue1);
            $tovalue1 = $date1->format('Y-m-d').' 23:59:59';
        } else {
            $tokey1 = '=';
            $tovalue1 = Carbon::now()->toDateTimeString();
        }

        $monnaf1 = Carbon::parse($fvalue1);
        $data['monnf1'] = $monnaf1->format('d F Y');

        $monnat1 = Carbon::parse($tovalue1);
        $data['monnt1'] = $monnat1->format('d F Y');

        if (! empty($request->input('form2'))) {
            $fkey2 = '=';
            $fvalue2 = $from2;

            $date2 = Carbon::parse($fvalue2);
            $fvalue2 = $date2->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey2 = '=';
            $fvalue2 = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to2'))) {
            $tokey2 = '=';
            $tovalue2 = $to2;

            $date2 = Carbon::parse($tovalue2);
            $tovalue2 = $date2->format('Y-m-d').' 23:59:59';
        } else {
            $tokey2 = '=';
            $tovalue2 = Carbon::now()->toDateTimeString();
        }

        $monnaf2 = Carbon::parse($fvalue2);
        $data['monnf2'] = $monnaf2->format('d F Y');

        $monnat2 = Carbon::parse($tovalue2);
        $data['monnt2'] = $monnat2->format('d F Y');

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['narcotic1'] = Narcotic::with('district')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->whereBetween('sdate', [$fvalue1, $tovalue1])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('gaza');
            $data['gtgazatree1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('gaza_tree');
            $data['gtyaba1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('yaba');
            $data['gtheroine1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('heroine');
            $data['gtfansdel1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('fansdel');
            $data['gtcholai_alcohol1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('cholai_alcohol');
            $data['gtbidesh_alcohol1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('bidesh_alcohol');
            $data['gtlsd1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('lsd');
            $data['gtice1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('ice');
            $data['gtotherd1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->sum('otherd');

            $data['narcotic2'] = Narcotic::with('district')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->whereBetween('sdate', [$fvalue2, $tovalue2])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('gaza');
            $data['gtgazatree2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('gaza_tree');
            $data['gtyaba2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('yaba');
            $data['gtheroine2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('heroine');
            $data['gtfansdel2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('fansdel');
            $data['gtcholai_alcohol2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('cholai_alcohol');
            $data['gtbidesh_alcohol2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('bidesh_alcohol');
            $data['gtlsd2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('lsd');
            $data['gtice2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('ice');
            $data['gtotherd2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->sum('otherd');

            $data['narcoticdatas'] = Narcotic::with(['district', 'thana'])
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->where('status', 'active')->orderBy('id', 'desc')->paginate(20);

            // dd($data['narcoticdatas']);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['narcotic1'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->where('districtID', auth()->user()->districtID)
             ->whereBetween('sdate', [$fvalue1, $tovalue1])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            //dd($data['narcotic1']);

            $data['gtgaza1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('gaza');
            $data['gtgazatree1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('gaza_tree');
            $data['gtyaba1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('yaba');
            $data['gtheroine1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('heroine');
            $data['gtfansdel1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('fansdel');
            $data['gtcholai_alcohol1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('cholai_alcohol');
            $data['gtbidesh_alcohol1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('bidesh_alcohol');
            $data['gtlsd1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('lsd');
            $data['gtice1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('ice');
            $data['gtotherd1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('otherd');

            $data['narcotic2'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('status', 'active')->where('districtID', auth()->user()->districtID)
              ->whereBetween('sdate', [$fvalue2, $tovalue2])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            //dd($data['narcotic2']);

            $data['gtgaza2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('gaza');
            $data['gtgazatree2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('gaza_tree');
            $data['gtyaba2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('yaba');
            $data['gtheroine2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('heroine');
            $data['gtfansdel2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('fansdel');
            $data['gtcholai_alcohol2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('cholai_alcohol');
            $data['gtbidesh_alcohol2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('bidesh_alcohol');
            $data['gtlsd2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('lsd');
            $data['gtice2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('ice');
            $data['gtotherd2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->sum('otherd');

            $data['narcoticdatas'] = Narcotic::with(['district', 'thana'])
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->where('status', 'active')->where('districtID', auth()->user()->districtID)->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['narcotic1'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('districtID', auth()->user()->districtID)
            ->where('thanaID', auth()->user()->thanaID)
            ->where('status', 'active')
             ->whereBetween('sdate', [$fvalue1, $tovalue1])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('gaza');
            $data['gtgazatree1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('gaza_tree');
            $data['gtyaba1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('yaba');
            $data['gtheroine1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('heroine');
            $data['gtfansdel1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('fansdel');
            $data['gtcholai_alcohol1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('cholai_alcohol');
            $data['gtbidesh_alcohol1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('bidesh_alcohol');
            $data['gtlsd1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('lsd');
            $data['gtice1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('ice');
            $data['gtotherd1'] = Narcotic::whereBetween('sdate', [$fvalue1, $tovalue1])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('otherd');

            $data['narcotic2'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')->where('districtID', auth()->user()->districtID)
            ->where('thanaID', auth()->user()->thanaID)
            ->where('status', 'active')
              ->whereBetween('sdate', [$fvalue2, $tovalue2])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('gaza');
            $data['gtgazatree2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('gaza_tree');
            $data['gtyaba2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('yaba');
            $data['gtheroine2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('heroine');
            $data['gtfansdel2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('fansdel');
            $data['gtcholai_alcohol2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('cholai_alcohol');
            $data['gtbidesh_alcohol2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('bidesh_alcohol');
            $data['gtlsd2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('lsd');
            $data['gtice2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('ice');
            $data['gtotherd2'] = Narcotic::whereBetween('sdate', [$fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->sum('otherd');

            $data['narcoticdatas'] = Narcotic::with(['district', 'thana'])
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->orderBy('id', 'desc')->paginate(20);
        }

        // dd($data['narcotic1'], $data['narcotic2']);

        return view('admin/narcotic/narcotic-totalcase', $data);
    }

    public function narrecover(Request $request)
    {
        $data['request'] = $request;

        return view('admin/narcotic/narcotic-recover', $data);
    }

    public function narrecoversrc(Request $request)
    {
        $request->validate([
            'to1' => 'required|date',
            'form1' => 'required|date',
            'to2' => 'required|date',
            'form2' => 'required|date',
            'org1' => 'required',
            'org2' => 'required',
        ]);

        $data['request'] = $request;

        $to1 = Carbon::parse($request->input('to1'))->toDateTimeString();
        $from1 = Carbon::parse($request->input('form1'))->toDateTimeString();

        $to2 = Carbon::parse($request->input('to2'))->toDateTimeString();
        $from2 = Carbon::parse($request->input('form2'))->toDateTimeString();

        if (! empty($request->input('form1'))) {
            $fkey1 = '=';
            $fvalue1 = $from1;

            $date1 = Carbon::parse($fvalue1);
            $fvalue1 = $date1->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey1 = '=';
            $fvalue1 = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to1'))) {
            $tokey1 = '=';
            $tovalue1 = $to1;

            $date1 = Carbon::parse($tovalue1);
            $tovalue1 = $date1->format('Y-m-d').' 23:59:59';
        } else {
            $tokey1 = '=';
            $tovalue1 = Carbon::now()->toDateTimeString();
        }

        $monnaf1 = Carbon::parse($fvalue1);
        $data['monnf1'] = $monnaf1->format('d F Y');

        $monnat1 = Carbon::parse($tovalue1);
        $data['monnt1'] = $monnat1->format('d F Y');

        if (! empty($request->input('form2'))) {
            $fkey2 = '=';
            $fvalue2 = $from2;

            $date2 = Carbon::parse($fvalue2);
            $fvalue2 = $date2->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey2 = '=';
            $fvalue2 = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to2'))) {
            $tokey2 = '=';
            $tovalue2 = $to2;

            $date2 = Carbon::parse($tovalue2);
            $tovalue2 = $date2->format('Y-m-d').' 23:59:59';
        } else {
            $tokey2 = '=';
            $tovalue2 = Carbon::now()->toDateTimeString();
        }

        $monnaf2 = Carbon::parse($fvalue2);
        $data['monnf2'] = $monnaf2->format('d F Y');

        $monnat2 = Carbon::parse($tovalue2);
        $data['monnt2'] = $monnat2->format('d F Y');

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['narcotic1'] = Narcotic::with('district')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('name_of_investigator_org', $request->input('org1'))
            ->where('status', 'active')
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza');
            $data['gtgazatree1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza_tree');
            $data['gtyaba1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('yaba');
            $data['gtheroine1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('heroine');
            $data['gtfansdel1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('fansdel');
            $data['gtcholai_alcohol1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('bidesh_alcohol');
            $data['gtlsd1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('lsd');
            $data['gtice1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('ice');
            $data['gtotherd1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('otherd');

            $data['narcotic2'] = Narcotic::with('district')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('name_of_investigator_org', $request->input('org2'))
            ->where('status', 'active')
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

            $data['gtgaza2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza');
            $data['gtgazatree2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza_tree');
            $data['gtyaba2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('yaba');
            $data['gtheroine2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('heroine');
            $data['gtfansdel2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('fansdel');
            $data['gtcholai_alcohol2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('bidesh_alcohol');
            $data['gtlsd2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('lsd');
            $data['gtice2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('ice');
            $data['gtotherd2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('otherd');

            $data['narcoticdatas'] = Narcotic::with(['district', 'thana'])
            ->whereIn('name_of_investigator_org', [$request->input('org1'), $request->input('org2')])
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->where('status', 'active')
            ->orderBy('id', 'desc')->paginate(20);

            //dd($data['narcotic1'], $data['narcoticdatas']);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['narcotic1'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('status', 'active')
            ->where('name_of_investigator_org', $request->input('org1'))
            ->where('districtID', auth()->user()->districtID)
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza');
            $data['gtgazatree1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza_tree');
            $data['gtyaba1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('yaba');
            $data['gtheroine1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('heroine');
            $data['gtfansdel1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('fansdel');
            $data['gtcholai_alcohol1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('bidesh_alcohol');
            $data['gtlsd1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('lsd');
            $data['gtice1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('ice');
            $data['gtotherd1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('otherd');

            $data['narcotic2'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('name_of_investigator_org', $request->input('org2'))
            ->where('districtID', auth()->user()->districtID)
            ->where('status', 'active')
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza');
            $data['gtgazatree2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza_tree');
            $data['gtyaba2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('yaba');
            $data['gtheroine2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('heroine');
            $data['gtfansdel2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('fansdel');
            $data['gtcholai_alcohol2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('bidesh_alcohol');
            $data['gtlsd2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('lsd');
            $data['gtice2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('ice');
            $data['gtotherd2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('otherd');

            $data['narcoticdatas'] = Narcotic::with(['district', 'thana'])
            ->where('districtID', auth()->user()->districtID)
            ->where('status', 'active')
            ->whereIn('name_of_investigator_org', [$request->input('org1'), $request->input('org2')])
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $data['narcotic1'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('name_of_investigator_org', $request->input('org1'))
            ->where('districtID', auth()->user()->districtID)
            ->where('status', 'active')
            ->where('thanaID', auth()->user()->thanaID)
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza');
            $data['gtgazatree1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza_tree');
            $data['gtyaba1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('yaba');
            $data['gtheroine1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('heroine');
            $data['gtfansdel1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('fansdel');
            $data['gtcholai_alcohol1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('bidesh_alcohol');
            $data['gtlsd1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('lsd');
            $data['gtice1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('ice');
            $data['gtotherd1'] = Narcotic::where('name_of_investigator_org', $request->input('org1'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('otherd');

            $data['narcotic2'] = Narcotic::with('thana')->selectRaw('SUM(gaza) AS gazac,
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
            ')
            ->where('status', 'active')
            ->where('name_of_investigator_org', $request->input('org2'))
            ->where('districtID', auth()->user()->districtID)
             ->where('thanaID', auth()->user()->thanaID)
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['gtgaza2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza');
            $data['gtgazatree2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('gaza_tree');
            $data['gtyaba2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('yaba');
            $data['gtheroine2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('heroine');
            $data['gtfansdel2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('fansdel');
            $data['gtcholai_alcohol2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('cholai_alcohol');
            $data['gtbidesh_alcohol2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('bidesh_alcohol');
            $data['gtlsd2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('lsd');
            $data['gtice2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('ice');
            $data['gtotherd2'] = Narcotic::where('name_of_investigator_org', $request->input('org2'))->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->where('districtID', auth()->user()->districtID)->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])->sum('otherd');

            $data['narcoticdatas'] = Narcotic::with(['district', 'thana'])
            ->where('districtID', auth()->user()->districtID)
            ->whereIn('name_of_investigator_org', [$request->input('org1'), $request->input('org2')])
            ->where('thanaID', auth()->user()->thanaID)
            ->where('status', 'active')
            ->whereRaw('((`sdate` BETWEEN ? AND ?) OR (`sdate` BETWEEN ? AND ?))', [$fvalue1, $tovalue1, $fvalue2, $tovalue2])
            ->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin/narcotic/narcotic-recover', $data);
    }
}
