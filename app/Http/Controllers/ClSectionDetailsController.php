<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Logic\ClSectionDetailsLogicController;


use App\Http\Controllers\Controller;


class ClSectionDetailsController extends Controller {
    
    
    private $clsectiondetails_logic;

    public function __construct() {

        $this->clsectiondetails_logic = new ClSectionDetailsLogicController();
    }
    
    public function getClSectionDetails(Request $request) {

        $district = $request->get('district');

        $school = $request->get('school');

        $results_details = $this->clsectiondetails_logic->fetchclSectionDetails($district, $school);

        $this->clsectiondetails_logic->displayResults($results_details);
    }

    
    
}
