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

Route::get('/logout', [
	'uses'	=> 'LoginController@logout',
	'as'	=> 'logout',
]);


Route::group(['middleware' => 'visitors'], function(){

	Route::get('/login', [
		'uses'	=> 'LoginController@getLogin',
		'as'	=> 'login',
	]);
	Route::get('/', [
		'uses'	=> 'LoginController@getLogin',
		'as'	=> 'login',
	]);
	Route::post('/login', [
		'uses'	=> 'LoginController@postLogin',
		'as'	=> 'login',
	]);

	Route::get('/register', [
		'uses' 	=> 'RegistrationController@getRegister',
		'as'	=> 'register',
	]);

	Route::post('/register', [
		'uses' 	=> 'RegistrationController@postRegister',
		'as'	=> 'register',
	]);

	Route::get('/forgot/password', function(){
		return view('authentication.forget-password');
	});

	Route::post('/forgot/password', [
		'uses'	=> 'ForgotPasswordController@postForgotPassword',
		'as'	=> 'forgot.password',
	]);

	Route::get('/reset/{email}/{resetCode}', [
		'uses'	=> 'ForgotPasswordController@resetPassword',
		'as'	=> 'reset.password',
	]);

	Route::post('/reset/{email}/{resetCode}', [
		'uses'	=> 'ForgotPasswordController@postResetPassword',
		'as'	=> 'reset.password',
	]);
});
	Route::group(['middleware' => 'legal.user'], function(){

	Route::post('add/user', [
		'uses'	=> 'AdminController@addUser',
		'as'	=> 'add.user',
	]);



	Route::get('/Dashboard','HomeController@Dashboard');
	Route::get('/SendExpiry','HomeController@SendExpiry');
	Route::get('/SendBalance','HomeController@SendBalance');
	Route::get('/Users','UserController@Users');
	Route::post('/User/Login','UserController@Login');
	Route::get('/User/Logout','UserController@Logout');
	Route::post('/User/CreateUser','UserController@CreateUser');
	Route::post('/User/SaveUser','UserController@SaveUser');
	Route::get('/User/DeleteUser','UserController@DeleteUser');
	Route::get('/User/EditUser','UserController@EditUser');
	Route::post('/User/UpdateUser','UserController@UpdateUser');
	
	//Students
	Route::get('/Students','StudentController@Students');
	Route::get('/StudentRegistration','StudentController@StudentRegistration');
	Route::post('/SaveStudent','StudentController@SaveStudent');
	Route::post('/UpdateStudent','StudentController@UpdateStudent');
	Route::get('/DeleteStudent','StudentController@DeleteStudent');
	Route::get('/StudentUpgrade','StudentController@StudentUpgradeForm');
	Route::post('/StudentUpgradeSave','StudentController@StudentUpgrade');
	
	//Staffs
	Route::get('/Staffs','StaffController@Staffs');
	Route::get('/StaffRegistration','StaffController@StaffRegistration');
	Route::post('/SaveStaff','StaffController@SaveStaff');
	Route::post('/UpdateStaff','StaffController@UpdateStaff');
	Route::get('/DeleteStaff','StaffController@DeleteStaff');
	//Places
	Route::get('/Places','LocationController@Locations');
	Route::post('/SaveLocation','LocationController@SaveLocation');
	Route::post('/UpdateLocation','LocationController@UpdateLocation');
	Route::get('/DeleteLocation','LocationController@DeleteLocation');
	//Packages
	Route::get('/Packages','PackageController@Packages');
	Route::post('/SavePackage','PackageController@SavePackage');
	Route::post('/UpdatePackage','PackageController@UpdatePackage');
	Route::get('/DeletePackage','PackageController@DeletePackage');
	Route::get('/GetPackageDetail','PackageController@GetPackageDetail');
	//Enquiry
	Route::get('/Enquiries','EnquiryController@Enquiries');
	Route::get('/NewEnquiry','EnquiryController@NewEnquiry');
	Route::post('/SaveEnquiry','EnquiryController@SaveEnquiry');
	Route::get('/DeleteEnquiry','EnquiryController@DeleteEnquiry');
	//Attendance
	Route::get("/UploadExcel","AttendanceController@UploadExcel");
	Route::get("/StudnetAttendance","AttendanceController@StudentAttendance");
	Route::get("/StudentAttendanceSheet","AttendanceController@StudentAttendanceSheet");
	Route::post("/StudentAttendanceSave","AttendanceController@StudentAttendanceSave");
	Route::get("/StaffAttendance","AttendanceController@StaffAttendance");
	Route::get("/StaffAttendanceSheet","AttendanceController@StaffAttendanceSheet");
	Route::post("/StaffAttendanceSave","AttendanceController@StaffAttendanceSave");
	//Report
	Route::get("/StudentAttendanceReport", "AttendanceController@StudentAttendanceReport");
	Route::get("/StaffAttendanceReport", "AttendanceController@StaffAttendanceReport");
	Route::get("/StudentPaymentHistory", "HomeController@StudentPaymentHistory");
	//Leave Application
	Route::get("/StudentLeave","LeaveController@StudentLeave");
	Route::get("/NewStudentLeave","LeaveController@NewStudentLeave");
	Route::post("/SaveStudentLeave","LeaveController@SaveStudentLeave");
	Route::get("/DeleteStudentLeave","LeaveController@DeleteStudentLeave");
	Route::get("/StaffLeave","LeaveController@StaffLeave");
	Route::get("/NewStaffLeave","LeaveController@NewStaffLeave");
	Route::post("/SaveStaffLeave","LeaveController@SaveStaffLeave");
	Route::get("/DeleteStaffLeave","LeaveController@DeleteStaffLeave");
	//JSON Data
	Route::get("/GetStudentsByPlaceJSON",'HomeController@GetStudentsByPlaceJSON');
	Route::get("/GetStaffByPlaceJSON",'HomeController@GetStaffByPlaceJSON');
	//Salary
	Route::get("/GetStaffSalary","HomeController@GetStaffSalary");
	Route::get("/GetStudentReceipt","HomeController@GetStudentReceipt");
	Route::get("/StaffSalaryHistory","HomeController@StaffSalaryHistory");
	Route::get("/PersonalTrainerHistory","HomeController@PersonalTrainerHistory");\
	//Receipt
	Route::get("/EditStudentReceipt","HomeController@EditStudentReceipt");
	//Contacts
	Route::get('/Contacts','ContactController@Contacts');
	Route::post('/SaveContact','ContactController@SaveContact');
	Route::post('/UpdateContact','ContactController@UpdateContact');
	Route::get('/DeleteContact','ContactController@DeleteContact');
	Route::post('/SendMessageToContact','ContactController@SendMessageToContact');
});