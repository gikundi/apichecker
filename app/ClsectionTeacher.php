<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClsectionTeacher extends Model {

    protected $table = "cl_section_teachers";
    protected $fillable = ['sction_id', 'section_teacher', 'is_main_teacher', 'active'];

}
