<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clsection extends Model {

    
    protected $table = "cl_section";
    protected $fillable = ['id', 'district', 'teacher', 'school', 'last_modified', 'name', 'course_name', 'period','subject','course_description','course_number',
        'section_number', 'sis_id', 'grade', 'term_name', 'term_start_date', 'term_end_date','links_self', 'links_district', 'links_teachers',
        'links_students','links_school', 'active'];
    

}
