<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casedb extends Model
{
    use HasFactory;


    public $timestamps = true;

    protected $guarded = ['id'];

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'districtID');
    }

    public function thana()
    {
        return $this->hasOne('App\Models\Thana', 'id', 'thanaID');
    }

    public function circle()
    {
        return $this->hasOne('App\Models\Circle', 'id', 'circleID');
    }

    public function casetype()
    {
        return $this->hasOne('App\Models\CaseType', 'id', 'case_type');
    }

    public function casesubtype()
    {
        return $this->hasOne('App\Models\CaseType', 'id', 'casesub_type');
    }
}
