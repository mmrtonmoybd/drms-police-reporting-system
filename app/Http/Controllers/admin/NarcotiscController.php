<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Narcotic;
use App\Models\District;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Thana;
use Illuminate\Support\Str;

class NarcotiscController extends Controller
{
    public function addShow(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

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

        $request->request->add(['trakingID' => $trakingid, 'user_id' => $uid, 'divisionID' => 1,]);
        $request->merge(['sdate' => Carbon::createFromFormat('d/m/Y', $request->input('sdate'))->format('Y-m-d')]);
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
        $session_user = Session::get('user');
        $query = Narcotic::query();
        $query->with(['district', 'thana']);
        $data['narcotics'] = $query->orderBy('id', 'desc')->paginate(20);

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
            'otherd' => $this->reptpenum($request->input('otherd'))
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

        return view('admin/narcotic/narcotic-edit', $data);
    }

    public function delete(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/narcotic');
        }

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
}
