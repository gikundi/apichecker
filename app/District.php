<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
     protected $table = "cl_district";
     protected $fillable = ['name',  'mdr_number', 'phone', 'links_self', 'links_school', 'links_teacher',
        'links_students', 'links_sections','links_sections', 'statuts_state','status_instant_login','status_error','active','status_last_sync'];
    
}
