<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
   
    protected $table = "cl_teacher";
  
    protected $fillable = ['school','district','email'];
    
}

