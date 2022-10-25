<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Narcotic;
use App\Models\District;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Thana;

class NarcotiscController extends Controller
{
    public function addShow(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        return view('admin/narcotic/narcotic-add', $data);
    }

    public function addData(Request $request)
    {
        $date = Carbon::createFromFormat('d/m/Y', $request->input('sdate'));
        $day = $date->day;
        $month = $date->month;
        $year = $date->year;

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
         if(!$id or !is_numeric($id))
            return redirect('admin/narcotic');
        
        $data['nar'] = Narcotic::where('id', $id)->first();
    
        if(!$data)
            return redirect('admin/qrrs');
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['nar']->districtID ? Thana::where('district_id', $data['nar']->districtID)->get() : [] ;

        return view('admin/narcotic/narcotic-edit', $data);
    }

    public function editUpdate(Request $request, $id)
    {
         if(!$id or !is_numeric($id))
            return redirect('admin/narcotic');
        
        $data['nar'] = Narcotic::where('id', $id)->first();
    
        if(!$data)
            return redirect('admin/qrrs');
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['nar']->districtID ? Thana::where('district_id', $data['nar']->districtID)->get() : [] ;

        $date = Carbon::createFromFormat('d/m/Y', $request->input('sdate'));
        $day = $date->day;
        $month = $date->month;
        $year = $date->year;

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

        if(Narcotic::where('id', $id)->update($request->all())){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/narcotic');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        return view('admin/narcotic/narcotic-edit', $data);
    }

    public function delete(Request $request, $id)
    {
        if(!$id or !is_numeric($id))
            return redirect('admin/narcotic');

        if(Narcotic::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data deleted successfully');
            return redirect('admin/narcotic');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/narcotic');
        }
        return redirect('admin/narcotic');
    }

    public function pView(Request $request, $id)
    {
        if(!$id or !is_numeric($id))
            return redirect('admin/narcotic');
        
        $data['nar'] = Narcotic::where('id', $id)->with(['district', 'thana'])->first();
    
        if(!$data)
            return redirect('admin/narcotic');
        $data['request'] = $request;
        return view('admin/narcotic/narcotic-view', $data);
    }

    public function PrintView(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/narcotic');
        
        $data['nar'] = Narcotic::where('id', $id)->with(['district', 'thana'])->first();
    
        if(!$data)
            return redirect('admin/narcotic');
        $data['request'] = $request;
        return view('admin/narcotic/narcotic-print-view', $data);
    }

}
