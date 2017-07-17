<?php

namespace App\Http\Controllers\Logic;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TeacherLogicController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayTeacherResults($district, $school) {


        if ($district == 1 && $school == 1) {

            $this->correctResults($district, $school);
        }


        if ($district == 0 && $school == 1) {

            $this->wrongDistrictResults($district, $school);
        }

        if ($district == 1 && $school == 0) {

            $this->wrongSchoolResults($district, $school);
        }


        if ($district == 0 && $school == 0) {

            $this->wrongSchoolDistrictResults($district, $school);
        }
    }

    public function correctResults($district, $school) {

        $response ['code'] = 200;
        $response ['status'] = 'OK';
        $response['message'] = 'Details Verified';

        $response['district'] = $district;
        $response['school'] = $school;


        $arr = array($response);

        echo json_encode($arr);
    }

    public function wrongDistrictResults($district, $school) {


        $response ['code'] = 402;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Wrong District';

        $response['district'] = $district;
        $response['school'] = $school;


        $arr = array($response);

        echo json_encode($arr);
    }

    public function wrongSchoolResults($district, $school) {

        $response ['code'] = 403;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Wrong School';

        $response['district'] = $district;
        $response['school'] = $school;


        $arr = array($response);

        echo json_encode($arr);
    }

    public function wrongSchoolDistrictResults($district, $school) {

        $response ['code'] = 404;
        $response ['status'] = 'ERROR';
        $response['message'] = 'Wrong School and District';

        $response['district'] = $district;
        $response['school'] = $school;


        $arr = array($response);

        echo json_encode($arr);
    }

  

}
