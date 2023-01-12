<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    use HasFactory;

    public function qrr()
    {
        return $this->hasMany(Qrr::class, 'thanaID');
    }

    public function casedb()
    {
        return $this->hasMany(Casedb::class, 'thanaID');
    }

    public function narcotic()
    {
        return $this->hasMany(Narcotic::class, 'thanaID');
    }

    public function woman()
    {
        return $this->hasMany(Woman::class, 'thanaID');
    }

    public function warrant()
    {
        return $this->hasMany(Warrant::class, 'thanaID');
    }
}
