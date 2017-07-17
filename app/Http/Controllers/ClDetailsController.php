<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Logic\ClDetailsLogicController;


class ClDetailsController extends Controller {

    private $cldetails_logic;

    public function __construct() {

        $this->cldetails_logic = new ClDetailsLogicController();
    }

    public function getClDetails(Request $request) {

        $district = $request->get('district');

        $school = $request->get('school');

        $details_results = $this->cldetails_logic->fetchclDetails($district, $school);

        $this->cldetails_logic->displayResults($details_results);
    }

}
