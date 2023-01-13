<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;
use App\Models\User;
use App\Models\Warrant;
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

           if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
               $data['qrrase'] = District::withCount([
                   'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
                   },

                   'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('status', 'active')->whereNotNull('nispotti_date')->whereBetween('nispotti_date', [$agomonthday, $currentday]);
                   },

                   'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->whereBetween('case_date', [$agomonthday, $currentday]);
                   },

                   'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->whereBetween('sdate', [$agomonthday, $currentday]);
                   },

                   'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('wdate', [$agomonthday, $currentday])
                           ->where('status', 'active');
                   },
               ])

                  ->withSum(['warrant AS udcase' => function ($query) use ($currentday, $agomonthday) {
                      return $query->whereNotNull('unnatural_death_case')->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday]);
                  }],
                      'unnatural_death_case'
                  )
                       ->where('division_id', 1)->groupBy('id')->get();

               $data['warrantarrast'] = Warrant::selectRaw('
        (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_nispotti,
        (SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_recive,
        SUM(gr_tamil) AS total_gr_tamil,
        SUM(cr_tamil) AS total_cr_tamil,
        SUM(saja_gr_tamil) AS total_saja_gr_tamil,
        SUM(saja_cr_tamil) AS total_saja_cr_tamil,
        SUM(recall_other) AS total_recall,
         SUM(ucase_arrast) AS sumucase_arrast,
         
        districtID
        ')->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

               $data['datawarrantother'] = Warrant::with(['district', 'thana'])->selectRaw('
        SUM(ucase_arrast) AS sumucase_arrast,
        SUM(ruju_case) AS sumruju_case,
        SUM(case_nispotti) AS sumcase_nispotti,
        SUM(narcotic_case_ruju) AS sumnarcotic_case_ruju,
        SUM(narcotic_case_nispotti) AS sumnarcotic_case_nispotti,
        SUM(unnatural_death_case) AS sumunnatural_death_case,
        SUM(unnatural_death_gd) AS sumunnatural_death_gd,
        SUM(bit_police) AS sumbit_police,
        SUM(comunity_police) AS sumcomunity_police,
        SUM(student_comunity_police) AS sumstudent_comunity_police,
        SUM(cims) AS sumcims,
        districtID,
        thanaID
        ')->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

               $reportconfirm = District::withCount([
                   'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
                   },

                   'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('status', 'inactive')->whereNotNull('nispotti_date')->whereBetween('nispotti_date', [$agomonthday, $currentday]);
                   },

                   'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->whereBetween('case_date', [$agomonthday, $currentday]);
                   },

                   'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->whereBetween('sdate', [$agomonthday, $currentday]);
                   },

                   'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('wdate', [$agomonthday, $currentday])
                           ->where('status', 'inactive');
                   },

                   'warrant AS warrantcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('date', [$agomonthday, $currentday])
                           ->where('status', 'inactive');
                   },
               ])->where('division_id', 1)->groupBy('id')->get();

               $sum = 0;
               foreach ($reportconfirm as $repcon) {
                   $sum += $repcon->qrrcount + $repcon->casenispotti + $repcon->totalcase + $repcon->narcoticcount + $repcon->womancount + $repcon->warrantcount;
               }

               $data['reportconfirmation'] = $sum;
           } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
               $data['qrrase'] = Thana::withCount([
                   'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
                   },

                   'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('districtID', auth()->user()->districtID)->where('status', 'active')->whereNotNull('nispotti_date')->whereBetween('nispotti_date', [$agomonthday, $currentday]);
                   },

                   'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('case_date', [$agomonthday, $currentday]);
                   },

                   'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('sdate', [$agomonthday, $currentday]);
                   },

                   'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('wdate', [$agomonthday, $currentday])
                       ->where('districtID', auth()->user()->districtID)
                           ->where('status', 'active');
                   },
               ])

                   ->withSum(['warrant AS udcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereNotNull('unnatural_death_case')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('date', [$agomonthday, $currentday]);
                   }],
                       'unnatural_death_case'
                   )->where('district_id', auth()->user()->districtID)->groupBy('id')->get();

               $data['warrantarrast'] = Warrant::selectRaw('
         (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_nispotti,
         (SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_recive,
         SUM(gr_tamil) AS total_gr_tamil,
         SUM(cr_tamil) AS total_cr_tamil,
         SUM(saja_gr_tamil) AS total_saja_gr_tamil,
         SUM(saja_cr_tamil) AS total_saja_cr_tamil,
         SUM(recall_other) AS total_recall,
          SUM(ucase_arrast) AS sumucase_arrast,
          
         districtID,
         thanaID
         ')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('date', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

               $data['datawarrantother'] = Warrant::with(['district', 'thana'])->selectRaw('
         SUM(ucase_arrast) AS sumucase_arrast,
         SUM(ruju_case) AS sumruju_case,
         SUM(case_nispotti) AS sumcase_nispotti,
         SUM(narcotic_case_ruju) AS sumnarcotic_case_ruju,
         SUM(narcotic_case_nispotti) AS sumnarcotic_case_nispotti,
         SUM(unnatural_death_case) AS sumunnatural_death_case,
         SUM(unnatural_death_gd) AS sumunnatural_death_gd,
         SUM(bit_police) AS sumbit_police,
         SUM(comunity_police) AS sumcomunity_police,
         SUM(student_comunity_police) AS sumstudent_comunity_police,
         SUM(cims) AS sumcims,
         districtID,
         thanaID
         ')->where('status', 'active')->where('districtID', auth()->user()->districtID)->whereBetween('date', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

               $reportconfirm = Thana::withCount([
                   'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->where('districtID', auth()->user()->districtID)->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
                   },

                   'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('districtID', auth()->user()->districtID)->where('status', 'inactive')->whereNotNull('nispotti_date')->whereBetween('nispotti_date', [$agomonthday, $currentday]);
                   },

                   'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->where('districtID', auth()->user()->districtID)->whereBetween('case_date', [$agomonthday, $currentday]);
                   },

                   'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->where('districtID', auth()->user()->districtID)->whereBetween('sdate', [$agomonthday, $currentday]);
                   },

                   'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('wdate', [$agomonthday, $currentday])
                       ->where('districtID', auth()->user()->districtID)
                           ->where('status', 'inactive');
                   },

                   'warrant AS warrantcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('date', [$agomonthday, $currentday])
                       ->where('districtID', auth()->user()->districtID)
                           ->where('status', 'inactive');
                   },
               ])->where('district_id', auth()->user()->districtID)->groupBy('id')->get();

               $sum = 0;
               foreach ($reportconfirm as $repcon) {
                   $sum += $repcon->qrrcount + $repcon->casenispotti + $repcon->totalcase + $repcon->narcoticcount + $repcon->womancount + $repcon->warrantcount;
               }

               $data['reportconfirmation'] = $sum;
           } else {
               $data['qrrase'] = Thana::withCount([
                   'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
                   },

                   'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('thanaID', auth()->user()->thanaID)->where('status', 'active')->whereNotNull('nispotti_date')->whereBetween('nispotti_date', [$agomonthday, $currentday]);
                   },

                   'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('case_date', [$agomonthday, $currentday]);
                   },

                   'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('sdate', [$agomonthday, $currentday]);
                   },

                   'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('wdate', [$agomonthday, $currentday])
                       ->where('thanaID', auth()->user()->thanaID)
                           ->where('status', 'active');
                   },
               ])

                   ->withSum(['warrant AS udcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereNotNull('unnatural_death_case')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('date', [$agomonthday, $currentday]);
                   }],
                       'unnatural_death_case'
                   )->where('id', auth()->user()->thanaID)->groupBy('id')->get();

               $data['warrantarrast'] = Warrant::selectRaw('
         (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_nispotti,
         (SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_recive,
         SUM(gr_tamil) AS total_gr_tamil,
         SUM(cr_tamil) AS total_cr_tamil,
         SUM(saja_gr_tamil) AS total_saja_gr_tamil,
         SUM(saja_cr_tamil) AS total_saja_cr_tamil,
         SUM(recall_other) AS total_recall,
          SUM(ucase_arrast) AS sumucase_arrast,
          
         districtID,
         thanaID
         ')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('date', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

               $data['datawarrantother'] = Warrant::with(['district', 'thana'])->selectRaw('
         SUM(ucase_arrast) AS sumucase_arrast,
         SUM(ruju_case) AS sumruju_case,
         SUM(case_nispotti) AS sumcase_nispotti,
         SUM(narcotic_case_ruju) AS sumnarcotic_case_ruju,
         SUM(narcotic_case_nispotti) AS sumnarcotic_case_nispotti,
         SUM(unnatural_death_case) AS sumunnatural_death_case,
         SUM(unnatural_death_gd) AS sumunnatural_death_gd,
         SUM(bit_police) AS sumbit_police,
         SUM(comunity_police) AS sumcomunity_police,
         SUM(student_comunity_police) AS sumstudent_comunity_police,
         SUM(cims) AS sumcims,
         districtID,
         thanaID
         ')->where('status', 'active')->where('thanaID', auth()->user()->thanaID)->whereBetween('date', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

               $reportconfirm = Thana::withCount([
                   'qrr AS qrrcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->where('thanaID', auth()->user()->thanaID)->whereBetween('date_time_of_police_news', [$agomonthday, $currentday]);
                   },

                   'casedb AS casenispotti' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('nispotti_or_multobi', 'নিস্পত্তি')->where('thanaID', auth()->user()->thanaID)->where('status', 'inactive')->whereNotNull('nispotti_date')->whereBetween('nispotti_date', [$agomonthday, $currentday]);
                   },

                   'casedb AS totalcase' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->where('thanaID', auth()->user()->thanaID)->whereBetween('case_date', [$agomonthday, $currentday]);
                   },

                   'narcotic AS narcoticcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->where('status', 'inactive')->where('thanaID', auth()->user()->thanaID)->whereBetween('sdate', [$agomonthday, $currentday]);
                   },

                   'woman AS womancount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('wdate', [$agomonthday, $currentday])
                       ->where('thanaID', auth()->user()->thanaID)
                           ->where('status', 'inactive');
                   },

                   'warrant AS warrantcount' => function ($query) use ($currentday, $agomonthday) {
                       return $query->whereBetween('date', [$agomonthday, $currentday])
                       ->where('thanaID', auth()->user()->thanaID)
                           ->where('status', 'inactive');
                   },
               ])->where('id', auth()->user()->thanaID)->groupBy('id')->get();

               $sum = 0;
               foreach ($reportconfirm as $repcon) {
                   $sum += $repcon->qrrcount + $repcon->casenispotti + $repcon->totalcase + $repcon->narcoticcount + $repcon->womancount + $repcon->warrantcount;
               }

               $data['reportconfirmation'] = $sum;
           }

           //$data = [];

           //dd($reportconfirm, $sum);

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
