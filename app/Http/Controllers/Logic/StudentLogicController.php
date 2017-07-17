<?php

namespace App\Http\Controllers\Logic;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentLogicController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayStudentResults($district, $school, $age) {

        
        if ($district == 1 && $school == 1) {

            $this->correctResults($district, $school, $age);
        }

        
        if ($district == 0 && $school == 1) {


            $this->wrongDistrictResults($district, $school, $age);
        }

        if ($district == 1 && $school == 0) {


            $this->wrongSchoolResults($district, $school, $age);
        }


        if ($district == 0 && $school == 0) {

            $this->wrongSchoolDistrictResults($district, $school,$age);
        }
    }

    //TJ added Jan 12 2017
   public function displayStudentResults2($student_number, $email, $school, $age_bracket) {

        
        if ($student_number && $school && $age_bracket && $email) 
        {
            $this->correctResults2($student_number, $email, $school, $age_bracket);
        }
        else
        {
             $this->studentVerificationFail($student_number, $email, $school, $age_bracket);
        }    
    }

    public function correctResults($district, $school, $age) {

        $response ['code'] = 200;
        $response ['status'] = 'OK';
        $response['message'] = 'Details Verified';

        $response['district'] = $district;
        $response['school'] = $school;
        $response['of age'] = $age;

        $arr = array($response);

        echo json_encode($arr);
    }


    public function wrongDistrictResults($district, $school, $age) {


        $response ['code'] = 402;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Wrong District';

        $response['district'] = $district;
        $response['school'] = $school;
        $response['of age'] = $age;

        $arr = array($response);

        echo json_encode($arr);
    }

    public function wrongSchoolResults($district, $school, $age) {
        
        $response ['code'] = 403;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Wrong School';

        $response['district'] = $district;
        $response['school'] = $school;
        $response['of age'] = $age;

        $arr = array($response);

        echo json_encode($arr);
        
    }

    public function wrongSchoolDistrictResults($district, $school, $age) {
        
        $response ['code'] = 404;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Wrong District and School';

        $response['district'] = $district;
        $response['school'] = $school;
        $response['of age'] = $age;

        $arr = array($response);

        echo json_encode($arr);
        
    }

    //Below added TJ Jan 12 2017
    public function correctResults2($student_number, $email, $school, $age_bracket) {

        $response ['code'] = 200;
        $response ['status'] = 'OK';
        $response['message'] = 'Details Verified';

        $response['student_id'] = $student_number;
        $response['email'] = $email;
        $response['school'] = $school;
        $response['age_bracket'] = $age_bracket;

        $arr = array($response);

        echo json_encode($arr);
    }

    
    public function studentVerificationFail($student_number, $email, $school, $age_bracket) {

        $response ['code'] = 400;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Verification Failed';

        $response['student_id'] = $student_number;
        $response['email'] = $email;
        $response['school'] = $school;
        $response['age_bracket'] = $age_bracket;

        $arr = array($response);

        echo json_encode($arr);
    }
    
    
}