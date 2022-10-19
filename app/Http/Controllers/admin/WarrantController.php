<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\User;
use App\Models\Warrant;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class WarrantController extends Controller
{
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
           return redirect('admin/warrant/add');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/warrant/add');
        }

        return view('admin/warrant/warrant-add');
    }
}
