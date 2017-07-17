<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model {

    protected $table = "cl_school";
    protected $fillable = ['name', 'district', 'location', 'state_id', 'school_number', 'sis_id', 'nces_id', 'low_grade', 'high_grade', 'principal_name',
        'principal_email', 'location_address', 'location_city', 'location_state', 'location_zip', 'mdr_number', 'phone', 'links_self', 'links_district', 'links_teacher',
        'links_students', 'links_sections', 'active'];
    
}
