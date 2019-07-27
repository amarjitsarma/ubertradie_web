<?php

use Illuminate\Http\Request;

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
Route::post('/signup','ApiController@SignUp');
Route::post('/login','ApiController@postLogin');
Route::post('/CheckLogin','ApiController@CheckLogin');
Route::get('/GetCategories','CategoryController@GetAllCategoriesAPI');
Route::post('/GetSubCategories','SubCategoryController@GetSubCategoriesAPI');
Route::get('/GetSavedTaglines','TaglineController@GetTaglinesAPI');
Route::post('/SaveNewTagline','TaglineController@SaveTaglinesAPI');
Route::get('/GetSavedKeywords','KeywordController@GetKeywordsAPI');
Route::post('/SaveNewKeyword','KeywordController@SaveKeywordAPI');

//Free Lancer
Route::post('/SaveFreelanceBasic','FreelanceController@SaveFreeLanceBasicAPI');
Route::post('/GetFreelancebasic','FreelanceController@GetFreeLanceBasicAPI');

Route::post('/SaveWorkingHours','FreelanceController@SaveWorkingHoursAPI');
Route::post('/GetWorkingHours','FreelanceController@GetWorkingHoursAPI');

Route::post('/SaveContact','FreelanceController@SaveContactAPI');
Route::post('/GetContact','FreelanceController@GetContactAPI');

Route::post('/SavePhoto','FreelanceController@SavePhotoAPI');
Route::post('/GetPhotos','FreelanceController@GetPhotosAPI');

Route::post('/SaveAbout','FreelanceController@SaveAboutAPI');
Route::post('/GetAbout','FreelanceController@GetAboutAPI');

Route::post('/SaveService','FreelanceController@SaveServiceAPI');
Route::post('/GetService','FreelanceController@GetServiceAPI');

Route::post('/SaveTagline','FreelanceController@SaveTaglineAPI');
Route::post('/GetTaglines','FreelanceController@GetTaglineAPI');

Route::post('/SaveKeyword','FreelanceController@SaveKeywordAPI');
Route::post('/GetKeywords','FreelanceController@GetKeywordsAPI');

Route::get('/GetFreelancers','FreelanceController@GetFreelancersAPI');
Route::post('/GetFreelancer','FreelanceController@GetFreelancerAPI');

//Project
Route::get('/LoadSuberbs','ProjectController@LoadSuberbsAPI');
Route::post('/SaveProject','ProjectController@SaveProjectAPI');
Route::get('/GetProjects','ProjectController@GetProjectsAPI');
//Bids
Route::post('/SaveBid','BidController@SaveBidAPI');

//Quote
Route::post('/SaveQuote','QuoteController@SaveQuoteAPI');
Route::post('/GetQuote','QuoteController@GetQuotesAPI');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
