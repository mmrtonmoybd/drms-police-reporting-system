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
        $data['wars'] = $query->orderBy('id', 'desc')->paginate(20);
        $data['request'] =  $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['request'] = $request;
        $thana = Thana::get();
        $data['ttn'] = $thana;

        $data['disc'] = District::where('division_id', 1)->get();
        $mm = $data['disc'];

        return view('admin/warrant/warrant', $data);
    }

     private function reptpenum($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
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
            'districtID' => 'required',
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
                'recall_other' => $this->reptpenum($request->input('recall_other'))
        ]);

        if (Warrant::create($request->all())) {
            $request->session()->flash('success_msg', 'Data created successfully');
            return redirect('admin/warrant');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
            return redirect('admin/warrant/add');
        }

        return view('admin/warrant/warrant-add');
    }

    public function editShow(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/warrant');
        }

        $data['war'] = Warrant::where('id', $id)->first();

        if (!$data) {
            return redirect('admin/warrant');
        }
        $data['request'] = $request;
        $data['districts'] = District::where('division_id', 1)->get();
        $data['thanas'] = $data['war']->districtID ? Thana::where('district_id', $data['war']->districtID)->get() : [] ;
        return view('admin/warrant/warrant-edit', $data);
    }

    public function editUpdate(Request $request, $id)
    {
        $request->validate([
            'districtID' => 'required',
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
                'recall_other' => $this->reptpenum($request->input('recall_other'))
        ]);

        if (Warrant::where('id', $id)->update($request->all())) {
            $request->session()->flash('success_msg', 'Data updated successfully');
            return redirect('admin/warrant');
        } else {
            $request->session()->flash('error_msg', 'Something wrong. Please try again');
        }


        return view('admin/warrant/warrant-edit', $data);
    }

    public function delete(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
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
        if (!$id or !is_numeric($id)) {
            return redirect('admin/warrant');
        }

        $data['war'] = Warrant::where('id', $id)->with(['district', 'thana'])->first();

        if (!$data) {
            return redirect('admin/warrant');
        }
        $data['request'] = $request;
        return view('admin/warrant/warrant-view', $data);
    }

    public function PrintView(Request $request, $id)
    {
        if (!$id or !is_numeric($id)) {
            return redirect('admin/warrant');
        }

        $data['war'] = Warrant::where('id', $id)->with(['district', 'thana'])->first();

        if (!$data) {
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
        $data['districts'] = District::where('division_id', 1)->get();

        $borgona = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 34)->get();
        $barisal = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 35)->get();
        $bhola = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 36)->get();
        $jalokhati = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 37)->get();
        $patuakhali = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 38)->get();
        $pirojpur = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 39)->get();

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
                ->where('districtID', 34)->get();
        $barisaln = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 35)->get();
        $bholan = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 36)->get();
        $jalokhatin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 37)->get();
        $patuakhalin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 38)->get();
        $pirojpurn = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 39)->get();

        $borgonan = (!empty($borgonan[0]['total_sum'])) ? $borgonan[0]['total_sum'] : 0;
        $barisaln = (!empty($barisaln[0]['total_sum'])) ? $barisaln[0]['total_sum'] : 0;
        $bholan = (!empty($bholan[0]['total_sum'])) ? $bholan[0]['total_sum'] : 0;
        $jalokhatin = (!empty($jalokhatin[0]['total_sum'])) ? $jalokhatin[0]['total_sum'] : 0;
        $patuakhalin = (!empty($patuakhalin[0]['total_sum'])) ? $patuakhalin[0]['total_sum'] : 0;
        $pirojpurn = (!empty($pirojpurn[0]['total_sum'])) ? $pirojpurn[0]['total_sum'] : 0;

        $request->session()->flash('borgonan', $borgonan);
        $request->session()->flash('barisaln', $barisaln);
        $request->session()->flash('bholan', $bholan);
        $request->session()->flash('jalokhatin', $jalokhatin);
        $request->session()->flash('patuakhalin', $patuakhalin);
        $request->session()->flash('pirojpurn', $pirojpurn);

        $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->get();
        $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->get();


        //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other


        $bari = Warrant::query();
        $data['wars'] = Warrant::selectRaw("
        (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_nispotti,
        (SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_recive,
        SUM(gr_tamil) AS total_gr_tamil,
        SUM(cr_tamil) AS total_cr_tamil,
        SUM(saja_gr_tamil) AS total_saja_gr_tamil,
        SUM(saja_cr_tamil) AS total_saja_cr_tamil,
        SUM(recall_other) AS total_recall,
        districtID
        ")->orderBy('districtID', 'ASC')->groupBy('districtID')->get();

        $borgonap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
               ->where('districtID', 34)->get();
        $barisalp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 35)->get();
        $bholap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 36)->get();
        $jalokhatip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 37)->get();
        $patuakhalip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 38)->get();
        $pirojpurp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 39)->get();

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


        return view('admin/warrant/warrantsc', $data);
    }

    public function dashsp(Request $request)
    {
        $to = Carbon::parse($request->input('to'))->toDateTimeString();
        $from = Carbon::parse($request->input('form'))->toDateTimeString();

        if (!empty($request->input('districtID'))) {
            $dkey = '=';
            $dvalue = $request->input('districtID');
        } else {
            $dkey = '!=';
            $dvalue = 'ss';
        }

        if (!empty($request->input('form'))) {
            $fkey = '=';
            $fvalue = $request->input('form');
        } else {
            $fkey = '=';
            $fvalue = '1971-01-01 11:45:00';
        }

        if (!empty($request->input('to'))) {
            $tokey = '=';
            $tovalue = $request->input('to');
        } else {
            $tokey = '=';
            $tovalue = Carbon::now()->toDateTimeString();
            ;
        }

        $data['districts'] = District::where('division_id', 1)->get();

        $borgona = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 34)->whereBetween('date', [$fvalue, $tovalue])->get();
        $barisal = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 35)->whereBetween('date', [$fvalue, $tovalue])->get();
        $bhola = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 36)->whereBetween('date', [$fvalue, $tovalue])->get();
        $jalokhati = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 37)->whereBetween('date', [$fvalue, $tovalue])->get();
        $patuakhali = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 38)->whereBetween('date', [$fvalue, $tovalue])->get();
        $pirojpur = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', 39)->whereBetween('date', [$fvalue, $tovalue])->get();

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
                ->where('districtID', 34)->whereBetween('date', [$fvalue, $tovalue])->get();
        $barisaln = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 35)->whereBetween('date', [$fvalue, $tovalue])->get();
        $bholan = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 36)->whereBetween('date', [$fvalue, $tovalue])->get();
        $jalokhatin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 37)->whereBetween('date', [$fvalue, $tovalue])->get();
        $patuakhalin = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 38)->whereBetween('date', [$fvalue, $tovalue])->get();
        $pirojpurn = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', 39)->whereBetween('date', [$fvalue, $tovalue])->get();

        $borgonan = (!empty($borgonan[0]['total_sum'])) ? $borgonan[0]['total_sum'] : 0;
        $barisaln = (!empty($barisaln[0]['total_sum'])) ? $barisaln[0]['total_sum'] : 0;
        $bholan = (!empty($bholan[0]['total_sum'])) ? $bholan[0]['total_sum'] : 0;
        $jalokhatin = (!empty($jalokhatin[0]['total_sum'])) ? $jalokhatin[0]['total_sum'] : 0;
        $patuakhalin = (!empty($patuakhalin[0]['total_sum'])) ? $patuakhalin[0]['total_sum'] : 0;
        $pirojpurn = (!empty($pirojpurn[0]['total_sum'])) ? $pirojpurn[0]['total_sum'] : 0;

        $request->session()->flash('borgonan', $borgonan);
        $request->session()->flash('barisaln', $barisaln);
        $request->session()->flash('bholan', $bholan);
        $request->session()->flash('jalokhatin', $jalokhatin);
        $request->session()->flash('patuakhalin', $patuakhalin);
        $request->session()->flash('pirojpurn', $pirojpurn);

        $data['trecive'] = Warrant::selectRaw('(SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_sum')
                ->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->get();
        $data['tnis'] = Warrant::selectRaw('(SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_sum')
                ->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->get();


        //$war->gr_tamil + $war->cr_tamil + $war->saja_gr_tamil + $war->saja_cr_tamil + $war->recall_other


        $bari = Warrant::query();
        $data['wars'] = Warrant::selectRaw("
        (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other)) AS total_nispotti,
        (SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) AS total_recive,
        SUM(gr_tamil) AS total_gr_tamil,
        SUM(cr_tamil) AS total_cr_tamil,
        SUM(saja_gr_tamil) AS total_saja_gr_tamil,
        SUM(saja_cr_tamil) AS total_saja_cr_tamil,
        SUM(recall_other) AS total_recall,
        districtID
        ")->where('districtID', $dkey, $dvalue)->whereBetween('date', [$fvalue, $tovalue])->groupBy('districtID')->get();

        //dd($mm);
        $data['dis'] = District::find($dvalue);

        $borgonap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 34)->get();
        $barisalp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 35)->get();
        $bholap = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 36)->get();
        $jalokhatip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 37)->get();
        $patuakhalip = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 38)->get();
        $pirojpurp = Warrant::selectRaw('((SUM(gr_recive) + SUM(cr_recive) + SUM(saja_gr_recive) + SUM(saja_cr_recive)) - (SUM(gr_tamil) + SUM(cr_tamil) + SUM(saja_gr_tamil) + SUM(saja_cr_tamil) + SUM(recall_other))) AS total_sum')
                ->where('districtID', 39)->get();

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


        return view('admin/warrant/warrantsr', $data);
    }
}
