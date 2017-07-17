<?php

namespace App\Http\Controllers\Logic;

use DB;
use App\User;
use App\School;
use App\Teacher;
use App\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Logic\StudentLogicController;
use App\Http\Controllers\Logic\TeacherLogicController;


class CheckerLogicController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {

        $this->student_logic = new StudentLogicController();
        $this->teacher_logic = new TeacherLogicController();
    }

    public function acceptParametres($email, $identifier, $district, $school) {

        //Default isofage student field value

        $ofage = 0;

        // Function to  Check Whether the Email passed velongs to that identifier 


        $user_id = $this->verifyEmail($identifier, $email);


        // function to Check Whether the District is Valid 

        $valid_district = $this->districtChecker($user_id, $identifier, $district);


        // function to Check Whether the School is Valid 

        $valid_school = $this->schoolChecker($user_id, $identifier, $school);


        // check if student is of age

        if ($identifier == 1) {

            $ofage = $this->ageChecker($user_id, $identifier);
        }


        // return results after verification

        return($valid_district . "," . $valid_school . "," . $ofage);
    }
    
    //TJ added Jan 12 2017
    public function acceptStudentParameters($email, $student_number, $age_bracket, $school) {


        $identifier = 1;            //1 -> student

        $user_id = $this->getStudentId($student_number);
        if ($user_id)
        {
            $valid_student_number = true;
            $valid_school = $this->schoolChecker($user_id, $identifier, $school);
            $valid_age_bracket = $this->checkAgeBracket($user_id, $age_bracket);
            $valid_email = $this->checkStudentEmail($user_id, $email);
        }
        else
        {
            $valid_student_number = false;
            $user_id = $this->verifyEmail($identifier, $email);
            if ($user_id)
            {
                $valid_email = true;
                $valid_school = $this->schoolChecker($user_id, $identifier, $school);
                $valid_age_bracket = $this->checkAgeBracket($user_id, $age_bracket);
            }
            else
            {
                $valid_email = false;
                $valid_school = false;
                $valid_age_bracket = false;
            }
        }           
            
        return($valid_student_number . "," . $valid_email . "," . $valid_school . "," . $valid_age_bracket);
    }

    public function verifyEmail($identifier, $email) {


        // Check whether email is correct 

        $verify_email = $this->isEmailCorrect($identifier, $email);


        // If the Email Entered does not match its first role 


        if (!($verify_email)) {

        // Check wether email matches second role 

            $verify_email2 = $this->isMatchSecondRole($identifier, $email);

            //if the Email does match any role

            if (!( $verify_email2)) {


                $this->wrongEmail();
            } else {

// If email matches wrong role

                $this->IncorrectRole();
            }
        } else {


//If Email is correct retrieve User Id
            $user_id = $this->retrieveUserId($identifier, $email);

            return $user_id;
        }
    }

    public function wrongEmail() {

        $response ['code'] = 401;

        $response ['status'] = 'ERROR';
        $response['message'] = 'Email not found ';


        $arr = array($response);

        echo json_encode($arr);

        die();
    }

    public function IncorrectRole() {


        $response ['code'] = 405;
        $response ['status'] = 'ERROR';
        $response['message'] = 'incorrect role ';

        $arr = array($response);

        echo json_encode($arr);

        die();
    }

    public function isEmailCorrect($identifier, $email) {


        $identifier_table = 'cl_student';


        if ($identifier == '2') {

            $identifier_table = 'cl_teacher';
        }


        $use_table = $identifier_table;

        $verify_email = DB::table($use_table)->where('email', '=', $email)->get();

        return $verify_email;
    }

    public function isMatchSecondRole($identifier, $email) {


        $identifier_table2 = 'cl_student';


        if (!($identifier == '2')) {

            $identifier_table2 = 'cl_teacher';
        }


        $use_table = $identifier_table2;


        $verify_email2 = DB::table($use_table)->where('email', '=', $email)->get();

        return $verify_email2;
    }

    public function retrieveUserId($identifier, $email) {


        $identifier_table = 'cl_student';


        if ($identifier == '2') {

            $identifier_table = 'cl_teacher';
        }


        $use_table = $identifier_table;


        $user_id = DB::table($use_table)->where('email', '=', $email)->get();


        return $user_id[0]->id;
    }

    public function districtChecker($user_id, $identifier, $district) {

        $identifier_table = 'cl_student';

        if ($identifier == '2') {

            $identifier_table = 'cl_teacher';
        }


        $use_table = $identifier_table;


        $district_verification = DB::table($use_table)->where('district', '=', $district)
                        ->where('id', '=', $user_id)->get();


        if (!($district_verification )) {

            return 0;
        } else {

            return 1;
        }
    }

    public function schoolChecker($user_id, $identifier, $school) {


        $identifier_table = 'cl_student';

        if ($identifier == '2') {

            $identifier_table = 'cl_teacher';
        }


        $use_table = $identifier_table;

        $school_verification = DB::table($use_table)->where('school', '=', $school)
                        ->where('id', '=', $user_id)->get();


        if (!($school_verification)) {

            return 0;
        } else {

            return 1;
        }
    }

    //TJ added jan 12 2017
    public function getStudentId( $student_number) {

        $student_data = Student::where('student_number', '=', $student_number)->get();
        
        if ($student_data)
        {
            return $student_data[0]['id'];
        }
        return 0;
    }
    
        //TJ added jan 12 2017
    public function checkAgeBracket($user_id, $age_bracket) {

        $student_data = Student::where('id', '=', $user_id)->get();
        
        if ($age_bracket == $student_data[0]['age_bracket'])
        {
            return true;
        }
        
        return false;
    }


    public function ageChecker($user_id) {

        $age_checker = Student::where('id', '=', $user_id)->get();


        $ofage = $age_checker[0]['of_age'];


        return $ofage;
    }

    public function displayVerificationResults($param_results, $identifier) {


        $verification_results = (explode(",", $param_results));

        $district = $verification_results[0];
        $school = $verification_results[1];
        $age = $verification_results[2];


        if (!($identifier == 2)) {


            $this->student_logic->displayStudentResults($district, $school, $age);
        } else {



            $this->teacher_logic->displayTeacherResults($district, $school);
        }
    }
    
    //TJ added Jan 12 2017
   public function displayStudentVerificationResults($param_results) {


        $verification_results = (explode(",", $param_results));
        $student_number = $verification_results[0];
        $email = $verification_results[1];
        $school = $verification_results[2];
        $age_bracket = $verification_results[3];


        $this->student_logic->displayStudentResults2($student_number, $email, $school, $age_bracket);
    }

}