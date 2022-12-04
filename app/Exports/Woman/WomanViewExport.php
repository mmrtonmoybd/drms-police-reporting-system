<?php

namespace App\Exports\Woman;

use App\Models\Woman;
use Maatwebsite\Excel\Concerns\FromCollection;

class WomanViewExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Woman::all();
    }
}
