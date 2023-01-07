<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public function thana()
    {
        return $this->hasMany(Thana::class, 'district_id');
    }

    public function qrr()
    {
        return $this->hasMany(Qrr::class, 'districtID');
    }

    public function casedb()
    {
        return $this->hasMany(Casedb::class, 'districtID');
    }

    public function narcotic()
    {
        return $this->hasMany(Narcotic::class, 'districtID');
    }

    public function woman()
    {
        return $this->hasMany(Woman::class, 'districtID');
    }

    public function warrant()
    {
        return $this->hasMany(Warrant::class, 'districtID');
    }
}
