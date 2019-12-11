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
Route::get('/privacy',function(){
	return view("privacy");
});
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
	//Categories
	Route::get('/Categories','CategoryController@Categories');
	Route::post('/SaveCategory','CategoryController@SaveCategory');
	Route::post('/UpdateCategory','CategoryController@UpdateCategory');
	Route::get('/DeleteCategory','CategoryController@DeleteCategory');
	//Sub Categories
	Route::get('/SubCategories','SubCategoryController@SubCategories');
	Route::post('/SaveSubCategory','SubCategoryController@SaveSubCategory');
	Route::post('/UpdateSubCategory','SubCategoryController@UpdateSubCategory');
	Route::get('/DeleteSubCategory','SubCategoryController@DeleteSubCategory');
	//Keywords
	Route::get('/Keywords','KeywordController@Keywords');
	Route::post('/SaveKeyword','KeywordController@SaveKeyword');
	Route::post('/UpdateKeyword','KeywordController@UpdateKeyword');
	Route::get('/DeleteKeyword','KeywordController@DeleteKeyword');
	//Taglines
	Route::get('/Taglines','TaglineController@Taglines');
	Route::post('/SaveTagline','TaglineController@SaveTagline');
	Route::post('/UpdateTagline','TaglineController@UpdateTagline');
	Route::get('/DeleteTagline','TaglineController@DeleteTagline');
	//Users
	Route::get('/Users','UserController@Users');
	Route::post('/add/user','UserController@CreateUser');
	Route::get('/User/DeleteUser','UserController@DeleteUser');
	Route::get('/User/ChangeStatus','UserController@ChangeStatus');
	//Projects
	Route::get('/projects', 'ProjectController@getProjects');
	Route::get('/project-details/{id}', 'ProjectController@getProjectDetails');
	Route::get('/project/status/{id}', 'ProjectController@projectStatus');
	Route::get('/project-bid/status/{id}', 'ProjectController@projectBidStatus');

	//Projects
	Route::get('/freelancers', 'FreelanceController@getFreelancers');
	Route::get('/freelancer-details/{id}', 'FreelanceController@getFreelancerDetails');

	//Quotations
	Route::get('/quotations', 'QuoteController@getQuotations');
	Route::get('/quotation-details/{id}', 'QuoteController@getQuotationDetails');
});