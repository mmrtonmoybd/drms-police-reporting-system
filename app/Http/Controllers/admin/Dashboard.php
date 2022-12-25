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
    
    
    ////////////Modified By Rashad ////////////
  public function home()
    {
        return view('home');
    }
    
    
    public function seba()
    {
        return view('seba');
    }
    
    
        public function cfrom()
    {
        return view('cfrom');
    }
   
     ////////////Modified By Rashad ////////////
    
    
    //this method for index function
    public function Index(Request $request)
    {
        //  $this->UpdateLogin($request);




        $data=array();





        return view('admin/dashboard', $data);
    }

    //this method for update user login


    //this method for index function
    public function NotFound()
    {
        return view('errors/404');
    }

    public function admin()
    {
        return redirect('admin/dashboard');
    }

    public function smsTest()
    {
        echo SmsSender::send('8801737963893', 'Hello ashraful isalm');
        //echo SmsSender::getBalance();
    }
}
