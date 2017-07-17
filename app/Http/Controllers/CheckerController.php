<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use DB;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Logic\CheckerLogicController;

class CheckerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $checker_logic;

    public function __construct() {

        $this->checker_logic = new CheckerLogicController();
    }

    public function verifyDetails(Request $request) {
        

        // Get the posted parametres

        $email = $request->get('email');


        $identifier = $request->get('identifier');


        $district = $request->get('district');


        $school = $request->get('school');


        // Pass the parametres for verification

        $param_results = $this->checker_logic->acceptParametres($email, $identifier, $district, $school);


        // Function to display the results after Verification

        $this->checker_logic->displayVerificationResults($param_results, $identifier);
    }
   
    //TJ added Jan 12 2017
    public function verifyStudent(Request $request) {

        // Get the posted parametres

        $email = $request->get('email');


        $student_number = $request->get('student_id');


        $age_bracket = $request->get('age_bracket');


        $school = $request->get('school');


        // Pass the parametres for verification

        $param_results = $this->checker_logic->acceptStudentParameters($email, $student_number, 
                        $age_bracket, $school);


        // Function to display the results after Verification

        $this->checker_logic->displayStudentVerificationResults($param_results);
    }
   
   
    

}