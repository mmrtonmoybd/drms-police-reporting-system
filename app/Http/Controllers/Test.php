<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Exports\QrrsviewExport;

class Test extends Controller
{
    public function index()
    {
        //echo Hash::make('123456');

        return (new QrrsviewExport)->forId(12)->download('invoices.xlsx');
    }
}
