<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Thana;

class AreaController extends Controller
{
    //this method for get divisions
    public function getDivisions()
    {
        $data = Division::get();
        return response()->json($data);
    }

    //this method for get distrcits
    public function getDistricts(Request $request, $division_id=null)
    {
        $data = array();
        if ($division_id) {
            $data = District::where('division_id', $division_id)->get();
        } else {
            $data = District::get();
        }
        return response()->json($data);
    }

    //get upazillas
    public function getUpazilas(Request $request, $district_id=null)
    {
        $data = array();
        if ($district_id) {
            $data = Upazila::where('district_id', $district_id)->get();
        } else {
            $data = Upazila::get();
        }
        return response()->json($data);
    }


    //get upazillas
    public function getThanas(Request $request, $district_id=null)
    {
        $data = array();
        if ($district_id) {
            $data = Thana::where('district_id', $district_id)->get();
        } else {
            $data = Thana::get();
        }
        return response()->json($data);
    }
}
