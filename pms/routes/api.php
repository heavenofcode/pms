<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
 
Route::middleware('auth:api')->group(function () {
    Route::get('user', 'PassportController@details');
    Route::resource('companies', 'CompanyController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('projects', 'ProjectController');
    Route::get('projects/detail/{employeeId}', 'ProjectController@detail');
    Route::resource('subprojects', 'SubProjectController');
    Route::get('subprojects/project/{projectId}', 'SubProjectController@detail');
    Route::delete('subprojects/delete/{projectId}', 'SubProjectController@deleteByProject');
});