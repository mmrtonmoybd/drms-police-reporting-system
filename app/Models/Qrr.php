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

    protected static function booted()
    {
        static::created(function ($row) {
            
            if (auth()->user()->can('qrr.review')) {

                $status = 'active';
            } else {
                $status = 'inactive';
            }

            $row->forceFill(['status' => $status])->save();
        });
    }
}
