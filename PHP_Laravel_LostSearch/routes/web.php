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
*���O�C�����
***************************************************************************/
//�g�b�v�y�[�W
Route::resource('login', 'LoginController');
//���O�C���{�^��������
Route::post('login', 'LoginController@login'); 

/***************************************************************************
*�Ј��}�X�^
***************************************************************************/
Route::get('employee', 'EmployeeController@getindex');
/*�y�ꗗ�Ɖ�z*/
Route::get('employee_list', 'EmployeeController@index_list');
/*�y�o�^�z*/
//�V�K�o�^��ʃA�N�Z�X��
Route::get('emp_ins', 'EmployeeController@emp_ins');
//�o�^�{�^��������
Route::post('emp_regist', 'EmployeeController@emp_regist');
/*�y�C���z*/
//�C����ʃA�N�Z�X��
Route::get('emp_upd', 'EmployeeController@emp_upd');
//�X�V�{�^��������
Route::post('update_emp', 'EmployeeController@update_emp'); 
/*�y�Ɖ�z*/
Route::get('emp_ref_del', 'EmployeeController@emp_ref_del');
/*�y�폜�z*/
Route::post('delete_emp', 'EmployeeController@delete_emp'); 

/***************************************************************************
*�x�X�}�X�^
***************************************************************************/
Route::resource('branch', 'BranchController');
/*�y�ꗗ�Ɖ�z*/
Route::get('branch_list', 'BranchController@branch_list');
/*�y�ڍׁz*/
Route::get('branch', 'BranchController@branch_detail');
/*�y�o�^�z*/
Route::post('branch_regist', 'BranchController@branch_regist'); 
/*�y�C���z*/
Route::post('update_branch', 'BranchController@update_branch'); 
/*�y�폜�z*/
Route::post('delete_branch', 'BranchController@delete_branch'); 

/***************************************************************************
*�����}�X�^
***************************************************************************/
Route::resource('department', 'DepartmentController');
/*�y�ꗗ�Ɖ�z*/
Route::get('department_list', 'DepartmentController@department_list');
/*�y�ڍׁz*/
Route::get('department', 'DepartmentController@department_detail');
/*�y�o�^�z*/
Route::post('department_regist', 'DepartmentController@department_regist'); 
/*�y�C���z*/
Route::post('update_dep', 'DepartmentController@update_dep'); 
/*�y�폜�z*/
Route::post('delete_dep', 'DepartmentController@delete_dep'); 

/***************************************************************************
*�⎸���}�X�^
***************************************************************************/
Route::resource('lost_type', 'Lost_typeController');
/*�y�ꗗ�Ɖ�z*/
Route::get('losttype_list', 'LosttypeController@losttype_list');
/*�y�ڍׁz*/
Route::get('losttype', 'LosttypeController@losttype_detail');
/*�y�o�^�z*/
Route::post('type_regist', 'LosttypeController@type_regist'); 
/*�y�C���z*/
Route::post('update_losttype', 'LosttypeController@update_losttype'); 
/*�y�폜�z*/
Route::post('delete_losttype', 'LosttypeController@delete_losttype'); 

/***************************************************************************
*�⎸������
***************************************************************************/
/*�y�ꗗ�Ɖ�z*/
Route::get('lost_input_list', 'LostdataController@lost_input_list');
/*�y�V�K�o�^��ʁz*/
Route::get('lost_input_ins', 'LostdataController@lost_ins_index');
/*�y�V�K�o�^_�o�^�{�^���������z*/
Route::post('lost_input_regist', 'LostdataController@lost_input_regist'); 
/*�y�⎸�����͈ꗗ_��/��{�^���������z*/
Route::get('lost_input_ref', 'LostdataController@lost_input');
/*�y�⎸�����͈ꗗ_�C���{�^���������z*/
Route::get('lost_input', 'LostdataController@lost_input');
/*�y�⎸������_�C�����[�h_�C���{�^���������z*/
Route::post('lost_input_update', 'LostdataController@lost_input_update');
/*�y�폜�z*/
Route::post('lost_input_del', 'LostdataController@lost_input_del'); 

/***************************************************************************
*�⎸���Ɖ�
***************************************************************************/
/*�y�Ɖ�z*/
Route::get('lost_ref', 'LostdataController@lost_ref');
/*�y�����{�^���������z*/
Route::post('lost_search', 'LostdataController@lost_search'); 
/*�y�������ʁz*/
Route::get('lost_ref_search_result', 'LostdataController@lost_ref_search_result');



