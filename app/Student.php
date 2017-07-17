<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "cl_student";
    
    
     protected $fillable = ['district','school','email','of_age'];
    
}
