<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $appends = ['custom_checkin', 'custom_checkout'];
    public function room(){
        return $this->hasOne('App\Models\Room', 'id', 'room_id');
    }

    public function banglo(){
        return $this->hasOne('App\Models\Banglo', 'id', 'banglo_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    //this fucntion for thumbnail link
    public function getCustomCheckinAttribute(){
        $old_date = $this->check_in;
        $date = date('d/m/Y', strtotime($old_date));
        return $date;

    }

    //this fucntion for thumbnail link
    public function getCustomCheckoutAttribute(){
        $old_date = $this->check_out;
        $date = date('d/m/Y', strtotime($old_date));
        return $date;

    }
}
