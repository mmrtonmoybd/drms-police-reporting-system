<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Woman extends Model
{
    use HasFactory;

    protected $fillable = [
         'reference_no', 'divisionID', 'districtID', 'thanaID', 'village_word', 'wdate', 'badi_name', 'badi_phone', 'badi_age', 'badi_address', 'vbadi_name', 'vbadi_address', 'complaint_reson', 'investigator_name', 'investigator_title', 'mobile_no', 'gd_no', 'gd_date', 'mamla_no', 'dhara', 'mamla_date', 'complaint_no', 'problem_fix', 'action_taken', 'nreport', 'comment', 'user_id', 'event_type', 'begening_of_event', 'short_dettails', 'satisfy_rate'
    ];

    protected $table = 'womens';

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'districtID');
    }

    public function thana()
    {
        return $this->hasOne('App\Models\Thana', 'id', 'thanaID');
    }
}
