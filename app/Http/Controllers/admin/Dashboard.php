<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
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

       //this method for index function
       public function Index(Request $request)
       {
           //  $this->UpdateLogin($request);

           $data = [];

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
