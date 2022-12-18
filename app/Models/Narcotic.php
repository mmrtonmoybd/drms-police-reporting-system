<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narcotic extends Model
{
    use HasFactory;

    protected $fillable = ['serial', 'trakingID', 'folder_no', 'divisionID', 'districtID', 'thanaID', 'village_word', 'sdate', 'case_no', 'nopc', 'name_of_investigator_org', 'name_of_investigator', 'bp_no', 'mobile_no', 'gaza', 'gaza_tree', 'yaba', 'heroine', 'fansdel', 'cholai_alcohol', 'bidesh_alcohol', 'lsd', 'ice', 'otherd', 'number_of_accused', 'accused', 'image_video', 'jobdo_list', 'narocotic_test_report', 'investigate_result', 'tdate', 'comment', 'user_id', 'status'];

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'districtID');
    }

    public function thana()
    {
        return $this->hasOne('App\Models\Thana', 'id', 'thanaID');
    }
}
