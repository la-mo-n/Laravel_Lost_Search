<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    /*return view('welcome');
    return view('M_Citizen');
});


*/






//Route::post('regist', 'SyainController@regist'); 
//Route::post('search', 'DevSubjectController@search'); 
//Route::post('search2', 'DevSubjectController@search2'); 
//Route::resource('employee', 'EmployeeController');
//Route::post('employee', 'EmployeeController@getindex');





/***************************************************************************
*ƒƒOƒCƒ“‰æ–Ê
***************************************************************************/
//ƒgƒbƒvƒy[ƒW
Route::resource('login', 'LoginController');
//ƒƒOƒCƒ“ƒ{ƒ^ƒ“‰Ÿ‰ºŽž
Route::post('login', 'LoginController@login'); 

/***************************************************************************
*ŽÐˆõƒ}ƒXƒ^
***************************************************************************/
Route::get('employee', 'EmployeeController@getindex');
/*yˆê——Æ‰ïz*/
Route::get('employee_list', 'EmployeeController@index_list');
/*y“o˜^z*/
//V‹K“o˜^‰æ–ÊƒAƒNƒZƒXŽž
Route::get('emp_ins', 'EmployeeController@emp_ins');
//“o˜^ƒ{ƒ^ƒ“‰Ÿ‰ºŽž
Route::post('emp_regist', 'EmployeeController@emp_regist');
/*yC³z*/
//C³‰æ–ÊƒAƒNƒZƒXŽž
Route::get('emp_upd', 'EmployeeController@emp_upd');
//XVƒ{ƒ^ƒ“‰Ÿ‰ºŽž
Route::post('update_emp', 'EmployeeController@update_emp'); 
/*yÆ‰ïz*/
Route::get('emp_ref_del', 'EmployeeController@emp_ref_del');
/*yíœz*/
Route::post('delete_emp', 'EmployeeController@delete_emp'); 

/***************************************************************************
*Žx“Xƒ}ƒXƒ^
***************************************************************************/
Route::resource('branch', 'BranchController');
/*yˆê——Æ‰ïz*/
Route::get('branch_list', 'BranchController@branch_list');
/*yÚ×z*/
Route::get('branch', 'BranchController@branch_detail');
/*y“o˜^z*/
Route::post('branch_regist', 'BranchController@branch_regist'); 
/*yC³z*/
Route::post('update_branch', 'BranchController@update_branch'); 
/*yíœz*/
Route::post('delete_branch', 'BranchController@delete_branch'); 

/***************************************************************************
*•”ƒ}ƒXƒ^
***************************************************************************/
Route::resource('department', 'DepartmentController');
/*yˆê——Æ‰ïz*/
Route::get('department_list', 'DepartmentController@department_list');
/*yÚ×z*/
Route::get('department', 'DepartmentController@department_detail');
/*y“o˜^z*/
Route::post('department_regist', 'DepartmentController@department_regist'); 
/*yC³z*/
Route::post('update_dep', 'DepartmentController@update_dep'); 
/*yíœz*/
Route::post('delete_dep', 'DepartmentController@delete_dep'); 

/***************************************************************************
*ˆâŽ¸•¨ƒ}ƒXƒ^
***************************************************************************/
Route::resource('lost_type', 'Lost_typeController');
/*yˆê——Æ‰ïz*/
Route::get('losttype_list', 'LosttypeController@losttype_list');
/*yÚ×z*/
Route::get('losttype', 'LosttypeController@losttype_detail');
/*y“o˜^z*/
Route::post('type_regist', 'LosttypeController@type_regist'); 
/*yC³z*/
Route::post('update_losttype', 'LosttypeController@update_losttype'); 
/*yíœz*/
Route::post('delete_losttype', 'LosttypeController@delete_losttype'); 

/***************************************************************************
*ˆâŽ¸•¨“ü—Í
***************************************************************************/
/*yˆê——Æ‰ïz*/
Route::get('lost_input_list', 'LostdataController@lost_input_list');
/*yV‹K“o˜^‰æ–Êz*/
Route::get('lost_input_ins', 'LostdataController@lost_ins_index');
/*yV‹K“o˜^_“o˜^ƒ{ƒ^ƒ“‰Ÿ‰ºŽžz*/
Route::post('lost_input_regist', 'LostdataController@lost_input_regist'); 
/*yˆâŽ¸•¨“ü—Íˆê——_Æ/íƒ{ƒ^ƒ“‰Ÿ‰ºŽžz*/
Route::get('lost_input_ref', 'LostdataController@lost_input');
/*yˆâŽ¸•¨“ü—Íˆê——_C³ƒ{ƒ^ƒ“‰Ÿ‰ºŽžz*/
Route::get('lost_input', 'LostdataController@lost_input');
/*yˆâŽ¸•¨“ü—Í_C³ƒ‚[ƒh_C³ƒ{ƒ^ƒ“‰Ÿ‰ºŽžz*/
Route::post('lost_input_update', 'LostdataController@lost_input_update');
/*yíœz*/
Route::post('lost_input_del', 'LostdataController@lost_input_del'); 

/***************************************************************************
*ˆâŽ¸•¨Æ‰ï
***************************************************************************/
/*yÆ‰ïz*/
Route::get('lost_ref', 'LostdataController@lost_ref');
/*yŒŸõƒ{ƒ^ƒ“‰Ÿ‰ºŽžz*/
Route::post('lost_search', 'LostdataController@lost_search'); 
/*yŒŸõŒ‹‰Êz*/
Route::get('lost_ref_search_result', 'LostdataController@lost_ref_search_result');



