<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\Slider;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Banglo;
use App\Models\Contact;

use App\Http\Controllers\admin\SmsSender;

use Session;

class Dashboard extends Controller
{
    //this method for index function
    public function Index(Request $request){

        $this->UpdateLogin($request);
        
        $current_user = null;
        $session_user = Session::get('user');
        
            
        $data=array();


        $data['user_type'] = $session_user['type'];

        $data['total_logedin'] = User::where('last_login','>=' , time())->count();
        $data['total_user'] = User::count();

       
        return view('admin/dashboard', $data);
    }

    //this method for update user login
    public function  UpdateLogin(Request $request){
        $user = $request->session()->get('user');
        User::where('id', $user['id'])->update(['last_login'=>time()+30]);
        return $user;
    }

    //this method for index function
    public function NotFound(){
        return view('errors/404');
    }

    public function smsTest(){
        echo SmsSender::send('8801737963893', 'Hello ashraful isalm');
        //echo SmsSender::getBalance();
    }
}
