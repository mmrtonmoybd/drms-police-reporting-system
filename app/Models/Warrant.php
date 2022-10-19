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
'cr_tamil', 'cr_tamil', 'saja_cr_tamil', 'saja_gr_tamil', 'recall_other', 'user_id'
];

    public function district(){
        return $this->hasOne('App\Models\District', 'id', 'districtID');
    }

    public function thana(){
        return $this->hasOne('App\Models\Thana', 'id', 'thanaID');
    }
}
