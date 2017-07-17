<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClsectionTeacher;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Logic\ClSectionTeacherLogicController;

class ClSectionTeacherController extends Controller {

    private $clsectionteachers_logic;

    public function __construct() {

        $this->clsectionteachers_logic = new ClSectionTeacherLogicController();
    }

    public function getClSectionTeachers(Request $request) {


        $section_id = $request->get('section_id');


        $results_details = $this->clsectionteachers_logic->fetchclSectionDetails($section_id);


        $this->clsectionteachers_logic->displayResults($results_details);
    }

}
