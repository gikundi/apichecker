<?php

namespace App\Http\Controllers\Logic;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Clsection;
use App\Http\Controllers\Controller;

class ClSectionDetailsLogicController extends Controller {

    public function fetchclSectionDetails($district, $school) {

        $result_details = $this->fetchclDetails($district, $school);

        return $result_details;
    }

    public function fetchclDetails($district, $school) {

//
        if ((!($district)) && (!$school)) {


            $result_details = Clsection::all();

            return $result_details;
        }


        if (!($school )) {


            $result_details = Clsection::where('district', '=', $district)->get();

            return $result_details;
        }

        if (!($district)) {


            $result_details = Clsection::where('school', '=', $school)->get();

            return $result_details;
        } else {
            $result_details = Clsection::where('district', '=', $district)
                    ->where('school', '=', $school)
                    ->get();

            return $result_details;
        }
    }

    public function displayResults($results_details) {


        $response ['code'] = 200;

        $response ['status'] = 'OK';

        $response['data'] = $results_details;

        $arr = array($response);

        echo json_encode($arr);
    }

}
