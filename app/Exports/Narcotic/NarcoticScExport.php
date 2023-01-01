<?php

namespace App\Exports\Narcotic;

use App\Models\Narcotic;
use Maatwebsite\Excel\Concerns\FromCollection;

class NarcoticScExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Narcotic::all();
    }
}
