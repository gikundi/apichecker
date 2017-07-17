<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClsectionStudent extends Model {

    protected $table = "cl_section_students";
    protected $fillable = ['section_id', 'section_studeny', 'active'];

}
