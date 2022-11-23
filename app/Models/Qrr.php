<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrr extends Model
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
}
