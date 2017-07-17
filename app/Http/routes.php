<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::group(['prefix' => 'api/v1'], function() {

    
    Route::post('verify_user_details', 'CheckerController@verifyDetails');
    
    Route::post('verify_student', 'CheckerController@verifyStudent');

    Route::get('get_cl_details', 'ClDetailsController@getClDetails');

    Route::get('get_cl_section_details', 'ClSectionDetailsController@getClSectionDetails');

    Route::get('get_cl_section_teachers', 'ClSectionTeacherController@getClSectionTeachers');

    Route::get('get_cl_section_students', 'ClSectionStudentController@getClSectionStudents');
    
});