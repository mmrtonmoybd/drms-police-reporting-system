<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\User;
use App\Models\Warrant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Thana;
use Illuminate\Support\Facades\Session;

class WarrantController extends Controller
{
    public function index(Request $request)
    {
        //$session_user = Session::get('user');
        $query = Warrant::query();
        $query->with(['district', 'thana']);
        $data['wars'] = $query->paginate(20);
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/warrant/warrant', $data);
    }

    public function addShow(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        return view('admin/warrant/warrant-add', $data);
    }

    public function addData(Request $request)
    {
        $request->validate([
            'districtID' => 'required|integer',
            'thanaID' => 'required|integer',
            'date' => 'required',
            'gr_recive' => 'required|numeric',
            'cr_recive' => 'required|numeric',
            'saja_gr_recive' => 'required|numeric',
            'saja_cr_recive' => 'required|numeric',
            'gr_tamil' => 'required|numeric',
            'cr_tamil' => 'required|numeric',
            'saja_gr_tamil' => 'required|numeric',
            'saja_cr_tamil' => 'required|numeric',
            'recall_other' => 'required|numeric',
        ]);
        $date = $request->input('date');

        $request->merge(['date' => Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d')]);
        $user = Session::get('user');

        $uid = $user['id'];
        //dd();

        $request->request->add(['divisionID' => 1, 'user_id' => $uid]);

        if (Warrant::create($request->all())) {
           $request->session()->flash('success_msg', 'Data updated successfully');
           return redirect('admin/warrant');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/warrant/add');
        }

        return view('admin/warrant/warrant-add');
    }

    public function editShow(Request $request, $id)
    {
        if(!$id or !is_numeric($id))
            return redirect('admin/warrant');
        
        $data['war'] = Warrant::where('id', $id)->first();
    
        if(!$data)
            return redirect('admin/warrant');
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['war']->districtID ? Thana::where('district_id', $data['war']->districtID)->get() : [] ;
        return view('admin/warrant/warrant-edit', $data);
    }

    public function editUpdate(Request $request, $id)
    {
        $request->validate([
            'districtID' => 'required|integer',
            'thanaID' => 'required|integer',
            'date' => 'required',
            'gr_recive' => 'required|numeric',
            'cr_recive' => 'required|numeric',
            'saja_gr_recive' => 'required|numeric',
            'saja_cr_recive' => 'required|numeric',
            'gr_tamil' => 'required|numeric',
            'cr_tamil' => 'required|numeric',
            'saja_gr_tamil' => 'required|numeric',
            'saja_cr_tamil' => 'required|numeric',
            'recall_other' => 'required|numeric',
        ]);
        $date = $request->input('date');

        $request->merge(['date' => Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d')]);

        $request->request->remove('_token');
        $request->request->remove('submit');

        if(Warrant::where('id', $id)->update($request->all())){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/warrant');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/warrant/warrant-edit', $data);
    }

    public function delete(Request $request, $id)
    {
        if(!$id or !is_numeric($id))
            return redirect('admin/warrant');

        if(Warrant::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/warrant');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/warrant');
        }
        return redirect('admin/warrant');
    }

    public function pView(Request $request, $id)
    {
        if(!$id or !is_numeric($id))
            return redirect('admin/qrrs');
        
        $data['war'] = Warrant::where('id', $id)->with(['district', 'thana'])->first();
    
        if(!$data)
            return redirect('admin/warrant');
        $data['request'] = $request;
        return view('admin/warrant/warrant-view', $data);
    }

    public function PrintView(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/warrant');
        
        $data['war'] = Warrant::where('id', $id)->with(['district', 'thana'])->first();
    
        if(!$data)
            return redirect('admin/warrant');
        $data['request'] = $request;
        return view('admin/warrant/warrant-print-view', $data);
    }
}
