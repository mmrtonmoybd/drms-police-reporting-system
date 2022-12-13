<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warrant extends Model
{
    use HasFactory;

    protected $fillable = ['divisionID', 'districtID', 'thanaID',
'date', 'gr_recive', 'cr_recive',
'saja_gr_recive', 'saja_cr_recive', 'gr_tamil',
'cr_tamil', 'cr_tamil', 'saja_cr_tamil', 'saja_gr_tamil', 'recall_other', 'user_id', 'ucase_arrast', 'ruju_case', 'case_nispotti', 'narcotic_case_ruju', 'unnatural_death_case', 'unnatural_death_gd', 'bit_police', 'comunity_police', 'student_comunity_police', 'cims', 'narcotic_case_nispotti'
];

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'districtID');
    }

    public function thana()
    {
        return $this->hasOne('App\Models\Thana', 'id', 'thanaID');
    }
}
