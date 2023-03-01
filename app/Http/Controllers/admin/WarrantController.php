<?php

namespace App\Http\Controllers\admin;

use App\DataTables\Warrant\WarrantDataTable;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Thana;
use App\Models\Warrant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WarrantController extends Controller
{
    public function index(Request $request)
    {
        /*
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        $query = Warrant::query();
        $query->with(['district', 'thana']);
        $data['wars'] = $query->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->where('status', 'active')->orderBy('id', 'desc')->paginate(20);
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/warrant/warrant', $data);

        */

        $datatable = new WarrantDataTable();

        return $datatable->render('admin.warrant.warrant');
    }

    public function reviewList(Request $request)
    {
        $disid = 9552;
        $disexp = '!=';
        $thaid = 8256;
        $thaexp = '!=';

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $disid = auth()->user()->districtID;
            $disexp = '=';
            $thaid = auth()->user()->thanaID;
            $thaexp = '=';
        }

        $query = Warrant::query();
        $query->with(['district', 'thana']);
        $data['wars'] = $query->where('districtID', $disexp, $disid)->where('thanaID', $thaexp, $thaid)->where('status', 'inactive')->orderBy('id', 'desc')->paginate(20);
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/warrant/warrant-review', $data);
    }

    public function reviewShow(Request $request, Warrant $war)
    {
        $data['war'] = $war;

        return view('admin/warrant/warrant-status', $data);
    }

    public function reviewUpdate(Request $request, Warrant $war)
    {
        //$data['qrr'] = $qrr;

        $data = [
            'status' => $request->input('statusg'),
        ];

        //dd($nar, $data);

        if ($war->update($data)) {
            $request->session()->flash('success_msg', 'Data status updated successfully');
            //dd($nar, $data);
            return redirect('admin/warrant/review');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect()->back();
        }
    }

     private function reptpenum($sub)
     {
         return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
     }

    public function addShow(Request $request)
    {
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }

        return view('admin/warrant/warrant-add', $data);
    }

    public function addData(Request $request)
    {
        $request->validate([
            'thanaID' => 'required',
            'date' => 'required',
            'gr_recive' => 'required',
            'cr_recive' => 'required',
            'saja_gr_recive' => 'required',
            'saja_cr_recive' => 'required',
            'gr_tamil' => 'required',
            'cr_tamil' => 'required',
            'saja_gr_tamil' => 'required',
            'saja_cr_tamil' => 'required',
            'recall_other' => 'required',
        ]);
        $date = $request->input('date');

        $request->merge(['date' => Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d')]);

        $uid = auth()->user()->id;
        //dd();

        $request->request->add(['divisionID' => 1, 'user_id' => $uid]);

        $request->merge([
            'gr_recive' => $this->reptpenum($request->input('gr_recive')),
            'cr_recive' => $this->reptpenum($request->input('cr_recive')),
            'saja_gr_recive' => $this->reptpenum($request->input('saja_gr_recive')),
            'saja_cr_recive' => $this->reptpenum($request->input('saja_cr_recive')),
            'gr_tamil' => $this->reptpenum($request->input('gr_tamil')),
            'cr_tamil' => $this->reptpenum($request->input('cr_tamil')),
            'saja_gr_tamil' => $this->reptpenum($request->input('saja_gr_tamil')),
            'saja_cr_tamil' => $this->reptpenum($request->input('saja_cr_tamil')),
            'recall_other' => $this->reptpenum($request->input('recall_other')),
            'ucase_arrast' => $this->reptpenum($request->input('ucase_arrast')),
            'ruju_case' => $this->reptpenum($request->input('ruju_case')),
            'case_nispotti' => $this->reptpenum($request->input('case_nispotti')),
            'narcotic_case_ruju' => $this->reptpenum($request->input('narcotic_case_ruju')),
            'unnatural_death_case' => $this->reptpenum($request->input('unnatural_death_case')),
            'unnatural_death_gd' => $this->reptpenum($request->input('unnatural_death_gd')),
            'bit_police' => $this->reptpenum($request->input('bit_police')),
            'comunity_police' => $this->reptpenum($request->input('comunity_police')),
            'student_comunity_police' => $this->reptpenum($request->input('student_comunity_police')),
            'cims' => $this->reptpenum($request->input('cims')),
            'narcotic_case_nispotti' => $this->reptpenum($request->input('narcotic_case_nispotti')),
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
        ]);

        if (Warrant::create($request->all())) {
            $request->session()->flash('success_msg', 'Data created successfully');

            return redirect('admin/warrant');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect('admin/warrant/add');
        }

        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }

        return view('admin/warrant/warrant-add');
    }

    public function editShow(Request $request, $id)
    {
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/warrant');
        }

        $war = Warrant::where('id', $id)->first();

        $data['war'] = $war;

        if (! $data) {
            return redirect('admin/warrant');
        }

        Gate::authorize('editdeletewarrant', $war);

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhana'] = $octhana;
        }

        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['war']->districtID ? Thana::where('district_id', $data['war']->districtID)->get() : [];

        return view('admin/warrant/warrant-edit', $data);
    }

    public function editUpdate(Request $request, $id)
    {
        $war = Warrant::where('id', $id)->first();
        Gate::authorize('editdeletewarrant', $war);

        $request->validate([
            'thanaID' => 'required',
            'date' => 'required',
            'gr_recive' => 'required',
            'cr_recive' => 'required',
            'saja_gr_recive' => 'required',
            'saja_cr_recive' => 'required',
            'gr_tamil' => 'required',
            'cr_tamil' => 'required',
            'saja_gr_tamil' => 'required',
            'saja_cr_tamil' => 'required',
            'recall_other' => 'required',
        ]);
        $date = $request->input('date');

        $request->merge(['date' => Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d')]);

        $request->request->remove('_token');
        $request->request->remove('submit');

        $request->merge([
            'gr_recive' => $this->reptpenum($request->input('gr_recive')),
            'cr_recive' => $this->reptpenum($request->input('cr_recive')),
            'saja_gr_recive' => $this->reptpenum($request->input('saja_gr_recive')),
            'saja_cr_recive' => $this->reptpenum($request->input('saja_cr_recive')),
            'gr_tamil' => $this->reptpenum($request->input('gr_tamil')),
            'cr_tamil' => $this->reptpenum($request->input('cr_tamil')),
            'saja_gr_tamil' => $this->reptpenum($request->input('saja_gr_tamil')),
            'saja_cr_tamil' => $this->reptpenum($request->input('saja_cr_tamil')),
            'recall_other' => $this->reptpenum($request->input('recall_other')),
            'ucase_arrast' => $this->reptpenum($request->input('ucase_arrast')),
            'ruju_case' => $this->reptpenum($request->input('ruju_case')),
            'case_nispotti' => $this->reptpenum($request->input('case_nispotti')),
            'narcotic_case_ruju' => $this->reptpenum($request->input('narcotic_case_ruju')),
            'unnatural_death_case' => $this->reptpenum($request->input('unnatural_death_case')),
            'unnatural_death_gd' => $this->reptpenum($request->input('unnatural_death_gd')),
            'bit_police' => $this->reptpenum($request->input('bit_police')),
            'comunity_police' => $this->reptpenum($request->input('comunity_police')),
            'student_comunity_police' => $this->reptpenum($request->input('student_comunity_police')),
            'cims' => $this->reptpenum($request->input('cims')),
            'narcotic_case_nispotti' => $this->reptpenum($request->input('narcotic_case_nispotti')),
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
        ]);

        if (Warrant::where('id', $id)->update($request->all())) {
            $request->session()->flash('success_msg', 'Data updated successfully');

            return redirect('admin/warrant');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect()->back();
        }

        return view('admin/warrant/warrant-edit', $data);
    }

    public function delete(Request $request, $id)
    {
        $war = Warrant::where('id', $id)->first();
        Gate::authorize('editdeletewarrant', $war);
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/warrant');
        }

        if (Warrant::where('id', $id)->delete()) {
            $request->session()->flash('success_msg', 'Data deleted successfully');

            return redirect('admin/warrant');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');

            return redirect('admin/warrant');
        }

        return redirect('admin/warrant');
    }

    public function pView(Request $request, $id)
    {
        $war = Warrant::where('id', $id)->first();
        Gate::authorize('editdeletewarrant', $war);
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/warrant');
        }

        $data['war'] = Warrant::where('id', $id)->with(['district', 'thana'])->first();

        if (! $data) {
            return redirect('admin/warrant');
        }
        $data['request'] = $request;

        return view('admin/warrant/warrant-view', $data);
    }

    public function PrintView(Request $request, $id)
    {
        $war = Warrant::where('id', $id)->first();
        Gate::authorize('editdeletewarrant', $war);
        if (! $id or ! is_numeric($id)) {
            return redirect('admin/warrant');
        }

        $data['war'] = Warrant::where('id', $id)->with(['district', 'thana'])->first();

        if (! $data) {
            return redirect('admin/warrant');
        }
        $data['request'] = $request;

        return view('admin/warrant/warrant-print-view', $data);
    }

    public function totalReSum(...$numbers)
    {
        // $war->gr_recive + $war->cr_recive + $war->saja_gr_recive + $war->saja_cr_recive
        $total = 0;
        for ($i = 0; $i < count($numbers); $i++) {
            $total += $numbers[$i];
        }

        return $total;
    }

    public function dashs(Request $request)
    {
        $currentday = Carbon::now()->endOfMonth()->format('Y-m-d').' 23:59:59';

        $request->session()->flash('currentday', $currentday);

        $agomonthday = Carbon::now()->startOfMonth()->format('Y-m-d').' 00:00:00';

        $request->session()->flash('agomonthday', $agomonthday);

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();

            $borgona = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('districtID', 34)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $barisal = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('districtID', 35)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $bhola = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('districtID', 36)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $jalokhati = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('districtID', 37)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $patuakhali = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('districtID', 38)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $pirojpur = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('districtID', 39)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

            $borgona = $borgona[0]['total_sum'];
            $barisal = $barisal[0]['total_sum'];
            $bhola = $bhola[0]['total_sum'];
            $jalokhati = $jalokhati[0]['total_sum'];
            $patuakhali = $patuakhali[0]['total_sum'];
            $pirojpur = $pirojpur[0]['total_sum'];

            $request->session()->flash('borgona', $borgona);
            $request->session()->flash('barisal', $barisal);
            $request->session()->flash('bhola', $bhola);
            $request->session()->flash('jalokhati', $jalokhati);
            $request->session()->flash('patuakhali', $patuakhali);
            $request->session()->flash('pirojpur', $pirojpur);

            $borgonan = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('districtID', 34)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $barisaln = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('districtID', 35)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $bholan = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('districtID', 36)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $jalokhatin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('districtID', 37)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $patuakhalin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('districtID', 38)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $pirojpurn = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('districtID', 39)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

            $borgonan = (! empty($borgonan[0]['total_sum'])) ? $borgonan[0]['total_sum'] : 0;
            $barisaln = (! empty($barisaln[0]['total_sum'])) ? $barisaln[0]['total_sum'] : 0;
            $bholan = (! empty($bholan[0]['total_sum'])) ? $bholan[0]['total_sum'] : 0;
            $jalokhatin = (! empty($jalokhatin[0]['total_sum'])) ? $jalokhatin[0]['total_sum'] : 0;
            $patuakhalin = (! empty($patuakhalin[0]['total_sum'])) ? $patuakhalin[0]['total_sum'] : 0;
            $pirojpurn = (! empty($pirojpurn[0]['total_sum'])) ? $pirojpurn[0]['total_sum'] : 0;

            $request->session()->flash('borgonan', $borgonan);
            $request->session()->flash('barisaln', $barisaln);
            $request->session()->flash('bholan', $bholan);
            $request->session()->flash('jalokhatin', $jalokhatin);
            $request->session()->flash('patuakhalin', $patuakhalin);
            $request->session()->flash('pirojpurn', $pirojpurn);

            $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
            ->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])
                    ->get();
            $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])
                    ->get();
                    
            $totalrevive =   Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
            ->where('status', 'active')->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('status', 'active')->get();
            
             $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];

            $data['pending'] = Warrant::where('status', 'inactive')->whereBetween('date', [$agomonthday, $currentday])
                    ->count();

            //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

            $bari = Warrant::query();
            $data['wars'] = Warrant::selectRaw('
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

            $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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

            $borgonap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
            ->whereBetween('date', [$agomonthday, $currentday])
                   ->where('districtID', 34)->where('status', 'active')->get();
            $barisalp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                    ->where('districtID', 35)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $bholap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                    ->where('districtID', 36)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $jalokhatip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                    ->where('districtID', 37)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $patuakhalip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                    ->where('districtID', 38)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();
            $pirojpurp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                    ->where('districtID', 39)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

            $borgonap = ($borgonap[0]['total_sum'] >= 0) ? $borgonap[0]['total_sum'] : 0;
            $barisalp = ($barisalp[0]['total_sum'] >= 0) ? $barisalp[0]['total_sum'] : 0;
            $bholap = ($bholap[0]['total_sum'] >= 0) ? $bholap[0]['total_sum'] : 0;
            $jalokhatip = ($jalokhatip[0]['total_sum'] >= 0) ? $jalokhatip[0]['total_sum'] : 0;
            $patuakhalip = ($patuakhalip[0]['total_sum'] >= 0) ? $patuakhalip[0]['total_sum'] : 0;
            $pirojpurp = ($pirojpurp[0]['total_sum'] >= 0) ? $pirojpurp[0]['total_sum'] : 0;

            $request->session()->flash('borgonap', $borgonap);
            $request->session()->flash('barisalp', $barisalp);
            $request->session()->flash('bholap', $bholap);
            $request->session()->flash('jalokhatip', $jalokhatip);
            $request->session()->flash('patuakhalip', $patuakhalip);
            $request->session()->flash('pirojpurp', $pirojpurp);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['districts'] = District::where('division_id', 1)->get();

            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            foreach ($spthana as $key => $value) {
                $dd = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

                $dd = $dd[0]['total_sum'];

                $dd2 = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

                $dd2 = (! empty($dd2[0]['total_sum'])) ? $dd2[0]['total_sum'] : 0;

                $dd3 = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
               ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

                $dd3 = ($dd3[0]['total_sum'] >= 0) ? $dd3[0]['total_sum'] : 0;

                $data['spthana'][$key] = [$dd, $value->bn_name, $value->id];
                $data['spthanan'][$key] = [$dd2, $value->bn_name, $value->id];
                $data['spthanap'][$key] = [$dd3, $value->bn_name, $value->id];
            }

            $request->session()->flash('spthana', $data['spthana']);
            $request->session()->flash('spthanan', $data['spthanan']);
            $request->session()->flash('spthanap', $data['spthanap']);

            $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
               ->where('districtID', auth()->user()->districtID)
               ->where('status', 'active')
               ->whereBetween('date', [$agomonthday, $currentday])
                ->get();
            $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                   ->where('districtID', auth()->user()->districtID)
                   ->where('status', 'active')
                   ->whereBetween('date', [$agomonthday, $currentday])
                    ->get();
                    
            $totalrevive =   Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
            ->where('districtID', auth()->user()->districtID)
            ->where('status', 'active')->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('districtID', auth()->user()->districtID)
            ->where('status', 'active')->get();
            
             $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];
            

            $data['pending'] = Warrant::where('status', 'inactive')->where('districtID', auth()->user()->districtID)->whereBetween('date', [$agomonthday, $currentday])
                    ->count();

            //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

            $bari = Warrant::query();
            $data['wars'] = Warrant::selectRaw('
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

            $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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

            //dd($data['spthana']);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhanacol'] = $octhana;

            $dd = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

            $dd = $dd[0]['total_sum'];

            $dd2 = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

            $dd2 = (! empty($dd2[0]['total_sum'])) ? $dd2[0]['total_sum'] : 0;

            $dd3 = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
               ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$agomonthday, $currentday])->get();

            $dd3 = ($dd3[0]['total_sum'] >= 0) ? $dd3[0]['total_sum'] : 0;

            $data['octhana'] = [$dd, $octhana->bn_name, $octhana->id];
            $data['octhanan'] = [$dd2, $octhana->bn_name, $octhana->id];
            $data['octhanap'] = [$dd3, $octhana->bn_name, $octhana->id];

            $request->session()->flash('octhana', $data['octhana']);
            $request->session()->flash('octhanan', $data['octhanan']);
            $request->session()->flash('octhanap', $data['octhanap']);

            $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
              ->where('thanaID', $octhana->id)
              ->where('status', 'active')
              ->whereBetween('date', [$agomonthday, $currentday])
               ->get();
            $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                   ->where('thanaID', $octhana->id)
                   ->where('status', 'active')
                   ->whereBetween('date', [$agomonthday, $currentday])
                    ->get();
                    
            
            $totalrevive =   Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
            ->where('thanaID', $octhana->id)
            ->where('status', 'active')->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('thanaID', $octhana->id)
            ->where('status', 'active')->get();
            
            $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];

            $data['pending'] = Warrant::where('status', 'inactive')->where('thanaID', $octhana->id)->whereBetween('date', [$agomonthday, $currentday])
                    ->count();

            //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

            $bari = Warrant::query();
            $data['wars'] = Warrant::selectRaw('
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
        ')->where('status', 'active')->where('thanaID', $octhana->id)->whereBetween('date', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('thanaID', $octhana->id)->whereBetween('date', [$agomonthday, $currentday])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();
        }

        return view('admin/warrant/warrantsc', $data);
    }

    public function dashsp(Request $request)
    {
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (! empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (! empty($request->input('thanaID'))) {
            $tkey = '=';
            $tvalue = $request->input('thanaID');
        } else {
            $tkey = '!=';
            $tvalue = 'ss';
        }

        if (! empty($request->input('form'))) {
            $fkey = '=';
            $fvalue = $from;

            $date = Carbon::parse($fvalue);
            $fvalue = $date->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $to;

            $date = Carbon::parse($tovalue);
            $tovalue = $date->format('Y-m-d').' 23:59:59';
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
        }

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();

            if (empty($request->input('districtID'))) {
                $borgona = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', 34)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $barisal = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', 35)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $bhola = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', 36)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $jalokhati = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', 37)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $patuakhali = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', 38)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $pirojpur = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', 39)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                $borgona = $borgona[0]['total_sum'];
                $barisal = $barisal[0]['total_sum'];
                $bhola = $bhola[0]['total_sum'];
                $jalokhati = $jalokhati[0]['total_sum'];
                $patuakhali = $patuakhali[0]['total_sum'];
                $pirojpur = $pirojpur[0]['total_sum'];

                $request->session()->flash('borgona', $borgona);
                $request->session()->flash('barisal', $barisal);
                $request->session()->flash('bhola', $bhola);
                $request->session()->flash('jalokhati', $jalokhati);
                $request->session()->flash('patuakhali', $patuakhali);
                $request->session()->flash('pirojpur', $pirojpur);

                $borgonan = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', 34)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $barisaln = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', 35)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $bholan = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', 36)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $jalokhatin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', 37)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $patuakhalin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', 38)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $pirojpurn = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', 39)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                $borgonan = (! empty($borgonan[0]['total_sum'])) ? $borgonan[0]['total_sum'] : 0;
                $barisaln = (! empty($barisaln[0]['total_sum'])) ? $barisaln[0]['total_sum'] : 0;
                $bholan = (! empty($bholan[0]['total_sum'])) ? $bholan[0]['total_sum'] : 0;
                $jalokhatin = (! empty($jalokhatin[0]['total_sum'])) ? $jalokhatin[0]['total_sum'] : 0;
                $patuakhalin = (! empty($patuakhalin[0]['total_sum'])) ? $patuakhalin[0]['total_sum'] : 0;
                $pirojpurn = (! empty($pirojpurn[0]['total_sum'])) ? $pirojpurn[0]['total_sum'] : 0;

                $request->session()->flash('borgonan', $borgonan);
                $request->session()->flash('barisaln', $barisaln);
                $request->session()->flash('bholan', $bholan);
                $request->session()->flash('jalokhatin', $jalokhatin);
                $request->session()->flash('patuakhalin', $patuakhalin);
                $request->session()->flash('pirojpurn', $pirojpurn);

                $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                        
                        
                $totalrevive =   Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                        ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
             $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];

                $data['pending'] = Warrant::where('status', 'inactive')
                      ->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])
                    ->count();

                //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

                $bari = Warrant::query();
                $data['wars'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->groupBy('districtID')->get();

                $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->groupBy('districtID')->get();

                //dd($mm);
                $data['dis'] = District::find($dvalue);

                $borgonap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                        ->where('districtID', 34)->where('status', 'active')->get();
                $barisalp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                        ->where('districtID', 35)->where('status', 'active')->get();
                $bholap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                        ->where('districtID', 36)->where('status', 'active')->get();
                $jalokhatip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                        ->where('districtID', 37)->where('status', 'active')->get();
                $patuakhalip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                        ->where('districtID', 38)->where('status', 'active')->get();
                $pirojpurp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                        ->where('districtID', 39)->where('status', 'active')->get();

                $borgonap = ($borgonap[0]['total_sum'] >= 0) ? $borgonap[0]['total_sum'] : 0;
                $barisalp = ($barisalp[0]['total_sum'] >= 0) ? $barisalp[0]['total_sum'] : 0;
                $bholap = ($bholap[0]['total_sum'] >= 0) ? $bholap[0]['total_sum'] : 0;
                $jalokhatip = ($jalokhatip[0]['total_sum'] >= 0) ? $jalokhatip[0]['total_sum'] : 0;
                $patuakhalip = ($patuakhalip[0]['total_sum'] >= 0) ? $patuakhalip[0]['total_sum'] : 0;
                $pirojpurp = ($pirojpurp[0]['total_sum'] >= 0) ? $pirojpurp[0]['total_sum'] : 0;

                $request->session()->flash('borgonap', $borgonap);
                $request->session()->flash('barisalp', $barisalp);
                $request->session()->flash('bholap', $bholap);
                $request->session()->flash('jalokhatip', $jalokhatip);
                $request->session()->flash('patuakhalip', $patuakhalip);
                $request->session()->flash('pirojpurp', $pirojpurp);

                $data['wars2'] = Warrant::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
            } else {
                $data['districts'] = District::where('division_id', 1)->get();

                $spthana = Thana::where('district_id', $dkey, $dvalue)->get();

                $data['spthanas'] = $spthana;

                foreach ($spthana as $key => $value) {
                    $dd = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                    ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                    $dd = $dd[0]['total_sum'];

                    $dd2 = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                    $dd2 = (! empty($dd2[0]['total_sum'])) ? $dd2[0]['total_sum'] : 0;

                    $dd3 = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
               ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                    $dd3 = ($dd3[0]['total_sum'] >= 0) ? $dd3[0]['total_sum'] : 0;

                    $data['spthana'][$key] = [$dd, $value->bn_name, $value->id];
                    $data['spthanan'][$key] = [$dd2, $value->bn_name, $value->id];
                    $data['spthanap'][$key] = [$dd3, $value->bn_name, $value->id];
                }

                //dd($data['spthana']);

                $request->session()->flash('spthana', $data['spthana']);
                $request->session()->flash('spthanan', $data['spthanan']);
                $request->session()->flash('spthanap', $data['spthanap']);

                $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                   ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                        
                $totalrevive =   Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                   ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                        ->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
             $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];

                $data['pending'] = Warrant::where('status', 'inactive')
                      ->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])
                    ->count();

                //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

                //$tha = Thana::find($tvalue);
                //$data['tha'] = $tha;

                $bari = Warrant::query();
                $data['wars'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

                $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

                $data['wars2'] = Warrant::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
            }
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['districts'] = District::where('division_id', 1)->get();

            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            foreach ($spthana as $key => $value) {
                $dd = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                $dd = $dd[0]['total_sum'];

                $dd2 = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                $dd2 = (! empty($dd2[0]['total_sum'])) ? $dd2[0]['total_sum'] : 0;

                $dd3 = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
               ->where('thanaID', $value->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

                $dd3 = ($dd3[0]['total_sum'] >= 0) ? $dd3[0]['total_sum'] : 0;

                $data['spthana'][$key] = [$dd, $value->bn_name, $value->id];
                $data['spthanan'][$key] = [$dd2, $value->bn_name, $value->id];
                $data['spthanap'][$key] = [$dd3, $value->bn_name, $value->id];
            }

            $request->session()->flash('spthana', $data['spthana']);
            $request->session()->flash('spthanan', $data['spthanan']);
            $request->session()->flash('spthanap', $data['spthanap']);

            $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
               ->where('thanaID', $tkey, $tvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
            $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('thanaID', $tkey, $tvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();
                    
            $totalrevive =  Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
               ->where('thanaID', $tkey, $tvalue)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                    ->where('thanaID', $tkey, $tvalue)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
             $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];

            $data['pending'] = Warrant::where('status', 'inactive')
              ->where('thanaID', $tkey, $tvalue)->whereBetween('date', [$fvalue, $tovalue])
            ->count();

            //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

            $tha = Thana::find($tvalue);
            $data['tha'] = $tha;

            $bari = Warrant::query();
            $data['wars'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)->whereBetween('date', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)->whereBetween('date', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['wars2'] = Warrant::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)->where('status', 'active')->where('thanaID', $tkey, $tvalue)->whereBetween('date', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhanacol'] = $octhana;

            $dd = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

            $dd = $dd[0]['total_sum'];

            $dd2 = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
            ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

            $dd2 = (! empty($dd2[0]['total_sum'])) ? $dd2[0]['total_sum'] : 0;

            $dd3 = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
               ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->get();

            $dd3 = ($dd3[0]['total_sum'] >= 0) ? $dd3[0]['total_sum'] : 0;

            $data['octhana'] = [$dd, $octhana->bn_name, $octhana->id];
            $data['octhanan'] = [$dd2, $octhana->bn_name, $octhana->id];
            $data['octhanap'] = [$dd3, $octhana->bn_name, $octhana->id];

            $request->session()->flash('octhana', $data['octhana']);
            $request->session()->flash('octhanan', $data['octhanan']);
            $request->session()->flash('octhanap', $data['octhanap']);

            $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
              ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])
               ->get();
            $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                   ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])
                    ->get();
                    
            $totalrevive =  Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
              ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
            $totalnis = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                   ->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', ['1971-01-01 11:45:00', $tovalue])->get();
            
             $data['totalpending'] = $totalrevive[0]['total_sum'] - $totalnis[0]['total_sum'];

            $data['pending'] = Warrant::where('status', 'inactive')
                      ->where('thanaID', $octhana->id)->whereBetween('date', [$fvalue, $tovalue])
                    ->count();

            //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other

            $bari = Warrant::query();
            $data['wars'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('thanaID', $octhana->id)->whereBetween('date', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['wars1'] = Warrant::with(['district', 'thana'])->selectRaw('
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
        ')->where('status', 'active')->where('thanaID', $octhana->id)->whereBetween('date', [$fvalue, $tovalue])->orderBy('thanaID', 'ASC')->groupBy('thanaID')->get();

            $data['wars2'] = Warrant::with(['district', 'thana'])->where('thanaID', $octhana->id)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin/warrant/warrantsr', $data);
    }

    public function chartlink(Request $request)
    {
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (! empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (! empty($request->input('thanaID'))) {
            $tkey = '=';
            $tvalue = $request->input('thanaID');
        } else {
            $tkey = '!=';
            $tvalue = 'ss';
        }

        if (! empty($request->input('form'))) {
            $fkey = '=';
            $fvalue = $from;

            $date = Carbon::parse($fvalue);
            $fvalue = $date->format('Y-m-d').' 00:00:00';
        //dd($ggg);
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (! empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $to;

            $date = Carbon::parse($tovalue);
            $tovalue = $date->format('Y-m-d').' 23:59:59';
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
        }

        if (auth()->user()->hasAnyRole(['Super Admin', 'Admin'])) {
            $data['districts'] = District::where('division_id', 1)->get();
            $data['request'] = $request;

            $data['wars2'] = Warrant::with(['district', 'thana'])->where('districtID', $dkey, $dvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['districts'] = District::where('division_id', 1)->get();

            $spthana = Thana::where('district_id', auth()->user()->districtID)->get();

            $data['spthanas'] = $spthana;

            $data['wars2'] = Warrant::with(['district', 'thana'])->where('districtID', auth()->user()->districtID)->where('thanaID', $tkey, $tvalue)->where('status', 'active')->whereBetween('date', [$fvalue, $tovalue])->orderBy('id', 'desc')->paginate(20);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $octhana = Thana::find(auth()->user()->thanaID);
            $data['octhanacol'] = $octhana;

            $data['wars2'] = Warrant::with(['district', 'thana'])->where('thanaID', $octhana->id)->whereBetween('date', [$fvalue, $tovalue])->where('status', 'active')->orderBy('id', 'desc')->paginate(20);
        }

        return view('admin/warrant/warrant-chartlink', $data);
    }
}
