<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\CaseType;
use App\Models\Casedb;
use App\Models\Circle;
use App\Models\Thana;
use Illuminate\Support\Carbon;

class CaseController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $dvalue = 'kglf';
            $dkey = '!=';
            $tvalue = 'kkdk';
            $tkey = '!=';
            $cvalue = 'dkikEK';
            $ckey = '!=';
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = 'kkdk';
            $tkey = '!=';
            $cvalue = 'dkikEK';
            $ckey = '!=';
        } else {
            $dvalue = auth()->user()->districtID;
            $dkey = '=';
            $tvalue = auth()->user()->thanaID;
            $tkey = '=';
            $cvalue = auth()->user()->circleID;
            $ckey = '=';
        }

        $data['cases'] = Casedb::with(['district', 'thana', 'circle', 'casetype', 'casesubtype'])->where('districtID', $dkey, $dvalue)->where('thanaID', $tkey, $tvalue)->orderBy('id', 'desc')->paginate(20);

        return view('admin/case/cases', $data);
    }


    public function addShow(Request $request)
    {
        $data['request'] = $request;
        if (auth()->user()->hasRole('Super Admin')) {
            $data['districts'] = District::where('division_id', 1)->get();
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);
        }

        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();

        return view('admin/case/case-add', $data);
    }

    private function reptpenum($sub)
    {
        return str_replace(['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], $sub);
    }

    public function create(Request $request)
    {
        $cdms_pg_id_result_final = '';

        if ($request->filled('cdms_pg_id')) {
            $cdms_pg_id = $request->input('cdms_pg_id');
            $cdms_pg_id_result = preg_replace("/[^a-zA-Z0-9]+/", "", $cdms_pg_id);
            $cdms_pg_id_result_final = strtoupper($cdms_pg_id_result);
        }

        $case_date = '';

        if ($request->filled('case_date')) {
            $case_date = Carbon::createFromFormat('d/m/Y', $request->input('case_date'))->format('Y-m-d');
        }

        $incident_date_time = '';

        if ($request->filled('incident_date_time')) {
            $incident_date_time = Carbon::createFromFormat('d/m/Y', $request->input('incident_date_time'))->format('Y-m-d');
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $thana = Thana::find($request->input('thanaID'));
            $circleid = $thana->circle_id;
        } else {
            $circleid = $request->input('circleID');
        }

        $request->merge([
            'cdms_pg_id' => $cdms_pg_id_result_final,
            'case_date' => $case_date,
            'incident_date_time' => $incident_date_time,
            'gr_no' => $this->reptpenum($request->input('gr_no')),
            'case_no' => $this->reptpenum($request->input('case_no')),
            'dhara' => $this->reptpenum($request->input('dhara')),
            'azahar_namio_victims' => $this->reptpenum($request->input('azahar_namio_victims')),
            'nispotti_or_multobi' => 'মুলতবি',
            'divisionID' => 1,
            'user_id' => auth()->user()->id,
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'circleID' => $circleid,
            'case_type' => $request->input('caseTypeID'),
            'casesub_type' => $request->input('casesubID'),
        ]);

        //dd($request->all());

        if (Casedb::create($request->all())) {
            return redirect('admin/case/add')->with('success_msg', 'Data added successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong. Please try again');
        }

        //dd($request->all());
    }

    public function editShow(Request $request, Casedb $casedb)
    {
        $data['case'] = $casedb;


        $data['request'] = $request;
        if (auth()->user()->hasRole('Super Admin')) {
            $data['districts'] = District::where('division_id', 1)->get();
        } elseif (auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) {
            $data['circledbs'] = Circle::where('district_id', auth()->user()->districtID)->get();
        } else {
            $data['thanades'] = Thana::find(auth()->user()->thanaID);
        }

        $data['caseparenttypes'] = CaseType::where('parent_id', 0)->get();

        return view('admin/case/case-edit', $data);
    }

    public function update(Request $request, Casedb $casedb)
    {
        $cdms_pg_id_result_final = '';

        if ($request->filled('cdms_pg_id')) {
            $cdms_pg_id = $request->input('cdms_pg_id');
            $cdms_pg_id_result = preg_replace("/[^a-zA-Z0-9]+/", "", $cdms_pg_id);
            $cdms_pg_id_result_final = strtoupper($cdms_pg_id_result);
        }

        $case_date = '';

        if ($request->filled('case_date')) {
            $case_date = Carbon::createFromFormat('d/m/Y', $request->input('case_date'))->format('Y-m-d');
        }

        $incident_date_time = '';

        if ($request->filled('incident_date_time')) {
            $incident_date_time = Carbon::createFromFormat('d/m/Y', $request->input('incident_date_time'))->format('Y-m-d');
        }

        $nispotti_date = '';

        if ($request->filled('nispotti_date')) {
            $nispotti_date = Carbon::createFromFormat('d/m/Y', $request->input('nispotti_date'))->format('Y-m-d');
        }

        $nispottisecond = '';

        if ($request->filled('nispotti_date') && $request->filled('case_date')) {
            $to = Carbon::createFromFormat('Y-m-d', $nispotti_date);
            $from = Carbon::createFromFormat('Y-m-d', $case_date);

            $nispottisecond = $to->diffInSeconds($from);
        }

        if (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) {
            $thana = Thana::find($request->input('thanaID'));
            $circleid = $thana->circle_id;
        } else {
            $circleid = $request->input('circleID');
        }

        $request->merge([
            'cdms_pg_id' => $cdms_pg_id_result_final,
            'case_date' => $case_date,
            'incident_date_time' => $incident_date_time,
            'gr_no' => $this->reptpenum($request->input('gr_no')),
            'case_no' => $this->reptpenum($request->input('case_no')),
            'dhara' => $this->reptpenum($request->input('dhara')),
            'azahar_namio_victims' => $this->reptpenum($request->input('azahar_namio_victims')),
            'nispotti_or_multobi' => 'মুলতবি',
            'divisionID' => 1,
            'user_id' => auth()->user()->id,
            'districtID' => ((auth()->user()->hasAnyRole(['SP', 'SP-Operator 1', 'SP-Operator 2'])) || (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3']))) ? auth()->user()->districtID : $request->input('districtID'),
            'thanaID' => (auth()->user()->hasAnyRole(['OC', 'OC-Operator 1', 'OC-Operator 2', 'OC-Operator 3'])) ? auth()->user()->thanaID : $request->input('thanaID'),
            'circleID' => $circleid,
            'case_type' => $request->input('caseTypeID'),
            'casesub_type' => $request->input('casesubID'),
            'nispotti_date' => $nispotti_date,
            'nispottisecond' => $nispottisecond,
            'cs_or_fr_no' => $this->reptpenum($request->input('cs_or_fr_no')),
            'police_report_victim' => $this->reptpenum($request->input('police_report_victim')),
            'number_of_accused' => $this->reptpenum($request->input('number_of_accused')),
            'jamin_prapto' => $this->reptpenum($request->input('jamin_prapto')),
            'polatok' => $this->reptpenum($request->input('polatok')),
            'azahar_vukto_invistigate' => $this->reptpenum($request->input('azahar_vukto_invistigate')),
            'ovohoti' => $this->reptpenum($request->input('ovohoti')),
            'sixtyone_recive' => $this->reptpenum($request->input('sixtyone_recive')),
            'sixtyfour_recive' => $this->reptpenum($request->input('sixtyfour_recive'))
        ]);

        $request->request->remove('_token');
        $request->request->remove('submit');

        if ($casedb->update($request->all())) {
            return redirect('admin/case')->with('success_msg', 'Data updated successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong. Please try again');
        }


        //dd($request->all());
    }

    public function caseView(Request $request, Casedb $casedb)
    {
        $data['request'] = $request;
        $data['case'] = $casedb;

        return view('admin/case/case-view', $data);
    }

    public function casePrint(Request $request, Casedb $casedb)
    {
        $data['request'] = $request;
        $data['case'] = $casedb;

        return view('admin/case/case-print', $data);
    }

    public function delete(Casedb $casedb)
    {
        if ($casedb->delete()) {
            return redirect('admin/case')->with('success_msg', 'Data deleted successfully');
        } else {
            return redirect()->back()->with('error_msg', 'Something wrong. Please try again');
        }
    }
}
