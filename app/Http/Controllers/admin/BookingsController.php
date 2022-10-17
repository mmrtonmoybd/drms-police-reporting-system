<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Setting;
use Session;

class BookingsController extends Controller
{
    //This method list all users
    public function Index(Request $request){
        $session_user = Session::get('user');
        $query = Booking::query();
        $query->orderBy('id', 'DESC');
        $query->with(['room', 'banglo', 'user']);
        $data['bookings'] = $query->paginate(20);
        $data['request'] =  $request;
        return view('admin/booking/bookings', $data);
    }

    
    //this method for view edit()
    public function Edit(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/bookings');
        
        $query = Booking::query();
        $query->where('id', $id);
        $query->with(['room', 'banglo', 'user']);
        $data['booking'] = $query->first();
        $data['settings'] = $this->settings();
    
        if(!$data)
            return redirect('admin/bookings');
        return view('admin/booking/bookings-edit', $data);
    }


    //this method for update user
    public function Update(Request $request, $id){
        

        $validated = $request->validate([
            'book_status' => 'required',
            'payment_status' => 'required',
        ]);

        $insertAttr = [
            'status'=>$request->input('book_status'),
            'payment_status'=>$request->input('payment_status')
            
        ];

        
        if(Booking::where('id', $id)->update($insertAttr)){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/bookings');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }

        
        return view('admin/booking/bookings-edit', ['course'=>$data]);
    }


    
    //this method for view Print
    public function Print(Request $request, $id){
        if(!$id or !is_numeric($id))
            return redirect('admin/bookings');
        
        $query = Booking::query();
        $query->where('id', $id);
        $query->with(['room', 'banglo', 'user']);
        $data['booking'] = $query->first();
        $data['settings'] = $this->settings();
    
        if(!$data)
            return redirect('admin/bookings');
        return view('admin/booking/bookings-print', $data);
    }

    
    //this method for  user delete
    public function Delete(Request $request, $id=null){
        if(!$id or !is_numeric($id))
            return redirect('admin/bookings');

        $session_user = Session::get('user');
        if($session_user['type']!='Admin'){
            $request->session()->flash('error_msg', 'You don\'t have permission to delete any data');
            return redirect('admin/dashboard');
        }

        if(Booking::where('id', $id)->delete()){
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/bookings');
        }else{
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/bookings');
        }
        return redirect('admin/bookings');
    }


    
    //this method for return all settings data
    public function settings(){
        $settingsGet = Setting::get();
        $settings = [];
        if($settingsGet){
            foreach($settingsGet as $setting){
                $settings[$setting->data_id] = $setting->data; 
            }
        }

        $settings['header_logo'] = asset('storage/settings'.$settings['header_logo']);
        $settings['footer_logo'] = asset('storage/settings'.$settings['footer_logo']);
        $settings['about_image'] = asset('storage/settings'.$settings['about_image']);

        return $settings;
    }
}
