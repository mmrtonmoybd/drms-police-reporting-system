<?php

namespace App\Http\Controllers;

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
        $currentday = Carbon::now()->format('Y-m-d').' 23:59:59';

        $agomonthday = Carbon::now()->subMonth()->format('Y-m-d').' 00:00:00';

        echo $agomonthday;

        // echo $this->lasttmon(0, 'enddate');

        //return (new QrrsviewExport())->forId(12)->download('invoices.xlsx');
    }
}
