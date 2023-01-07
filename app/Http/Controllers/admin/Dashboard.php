<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

           $currentday = Carbon::now()->format('Y-m-d').' 23:59:59';

           $request->session()->flash('currentday', $currentday);

           $agomonthday = Carbon::now()->subMonth()->format('Y-m-d').' 00:00:00';

           $request->session()->flash('agomonthday', $agomonthday);

           //$data = [];

           $data['qrrase'] = District::withCount([
               'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                   return $query->where('status', 'active')->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
               },

               'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                   return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('status', 'active')->whereBetween('case_date', [$agomonthday, $currentday]);
               },

               'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                   return $query->where('status', 'active')->whereBetween('case_date', [$agomonthday, $currentday]);
               },

               'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                   return $query->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday]);
               },

               'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                   return $query->whereBetween('wdate', [$agomonthday, $currentday])
                       ->where('status', 'inactive');
               },
           ])

               ->withSum(['warrant AS udcase' => function ($query) use ($currentday, $agomonthday) {
               return $query->whereNotNull('unnatural_death_case')->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday]);
           }],
                   'unnatural_death_case'
               )
                    ->where('division_id', 1)->groupBy('id')->get();

           //dd($data);

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
