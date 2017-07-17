<?php

namespace App\Http\Controllers\Logic;

use App\District;
use App\School;
use App\Http\Controllers\Controller;

class ClDetailsLogicController extends Controller {
    

    public function fetchclDetails($district, $school) {

        $district_details = $this->fetchclDistrict($district);

        $school_details = $this->fetchclSchool($district, $school);

        $result = array('district' => $district_details, 'school' => $school_details);

        return $result;
    }

    public function fetchclDistrict() {


        $districtDetails = District::all();



        return $districtDetails;
    }

    public function fetchclSchool($district, $school) {

//
        if ((!($district)) && (!$school)) {


            $schoolDetails = School::all();

            return $schoolDetails;
        }

        if (!($school )) {



            $schoolDetails = School::where('district', '=', $district)->get();

            return $schoolDetails;
        }

        if (!($district)) {


            $schoolDetails = School::where('id', '=', $school)->get();

            return $schoolDetails;
        } else {
            $schoolDetails = School::where('district', '=', $district)
                    ->where('id', '=', $school)
                    ->get();

            return $schoolDetails;
        }
    }

    public function displayResults($details_results) {


        $response ['code'] = 200;

        $response ['status'] = 'OK';

        $response['data'] = $details_results;

        $arr = array($response);

        echo json_encode($arr);
    }

}
