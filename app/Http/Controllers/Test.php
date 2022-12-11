<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\QrrsviewExport;
use Illuminate\Support\Carbon;

class Test extends Controller
{
    public function lasttmon($monthyear, string $type)
    {
        $carbon = Carbon::parse($monthyear);

        if ($type == 'start') {
            return $carbon->startOfMonth()->format('Y/m/d');
        } elseif ($type == 'end') {
            return $carbon->endOfMonth()->format('Y/m/d');
        }
    }

    public function removeArr(...$arg)
    {
        $arr = request()->all();
        $hh = \Illuminate\Support\Arr::except($arr, ['districtID', 'thanaID']);
        return $hh;
    }


    public function index()
    {
        $arr = ['districtID' => 34, 'thanaID' => 1, 'circleID' => 12];
        $hh = \Illuminate\Support\Arr::except($arr, ['districtID', 'thanaID']);

        dd($hh);


        // echo $this->lasttmon(0, 'enddate');

        //return (new QrrsviewExport())->forId(12)->download('invoices.xlsx');
    }
}
