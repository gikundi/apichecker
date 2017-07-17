<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logic\ClSectionStudentLogicController;

class ClSectionStudentController extends Controller {

    private $clsectionstudents_logic;

    public function __construct() {

        $this->clsectionstudents_logic = new ClSectionStudentLogicController();
    }

    
    public function getClSectionStudents(Request $request) {


        $section_id = $request->get('section_id');


        $results_details = $this->clsectionstudents_logic->fetchclSectionDetails($section_id);


        $this->clsectionstudents_logic->displayResults($results_details);
    }

}
