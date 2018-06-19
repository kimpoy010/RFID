<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
	'uses' => 'PagesController@getAddNewStudent',
	'as' => 'new.student',
]);

Route::post('/save-student', [
	'uses' => 'UserController@postNewStudent',
	'as' => 'save.student',
]);

Route::get('/sections', [
	'uses' => 'PagesController@getSections',
	'as' => 'pages.sections',
]);

Route::get('/students-list', [
	'uses' => 'PagesController@getStudentsList',
	'as' => 'students.list',
]);

Route::get('/add-new-employee', [
	'uses' => 'EmployeeController@addNewEmployee',
	'as' => 'new.employee',
]);

Route::get('/employees-list', [
	'uses' => 'EmployeeController@getEmployeesList',
	'as' => 'employees.list',
]);

Route::post('/new-section', [
	'uses' => 'PagesController@postNewSection',
	'as' => 'new.section',
]);

Route::get('delete-section/{id}',[
	'uses'=>'PagesController@deleteSection',
	'as'=>'delete.section'
]);

Route::get('get-sections/{id}', [
	'uses' => 'LevelsController@getSections',
	'as' => 'get.section'
]);

Route::get('/view-student/{id}', [
	'uses' => 'PagesController@getViewStudent',
	'as' => 'view.student',
]);

Route::get('/edit-student/{id}', [
	'uses' => 'PagesController@getEditStudent',
	'as' => 'edit.student',
]);

Route::post('/update-student/{id}', [
	'uses' => 'PagesController@updateStudentInfo',
	'as' => 'update.student',
]);

Route::post('/save-new-employee', [
	'uses' => 'EmployeeController@postNewEmployee',
	'as' => 'save.employee',
]);