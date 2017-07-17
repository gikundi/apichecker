<?php

namespace App\Http\Controllers\Logic;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClsectionTeacher;
use App\Http\Controllers\Controller;

class ClSectionTeacherLogicController extends Controller {

    public function fetchclSectionDetails($section_id) {

        $result_details = $this->fetchclDetails($section_id);

        return $result_details;
    }

    public function fetchclDetails($section_id) {


        if (!($section_id )) {


            $result_details = ClsectionTeacher::all();

            return $result_details;
        } else {
            $result_details = ClsectionTeacher::where('section_id', '=', $section_id)
                    ->get();

            return $result_details;
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
