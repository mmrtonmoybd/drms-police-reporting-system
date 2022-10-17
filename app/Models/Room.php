<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    public function room_category(){
        return $this->hasOne('App\Models\RoomCategory', 'id', 'category');
    }

    public function banglo(){
        return $this->hasOne('App\Models\Banglo', 'id', 'banglo_id');
    }
}
