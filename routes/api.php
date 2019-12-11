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
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/signup","ApiController@Signup");
Route::post("/send-otp","ApiController@SendOTPAPI");
Route::post('/ResendVerification','ApiController@ResendVerificationAPI');
Route::get('/VerifyRegistration/{UserID}/{OTP}/{DeviceID}/{login_type}','ApiController@VerifyRegistration');
Route::post('/UpdateLoginType','ApiController@UpdateLoginType');
Route::post('/login','ApiController@postLogin');
Route::post('/logout','ApiController@Logout');
Route::post('/CheckLogin','ApiController@CheckLogin');
Route::post('/ResetPassword','ApiController@ResetPasswordAPI');
Route::post('/UpdateProfile','ApiController@UpdateProfile');
Route::post('/UpdatePassword','ApiController@UpdatePassword');
Route::post('/UpdateAvatar','ApiController@UpdateAvatar');
//Categories
Route::get('/GetCategories','CategoryController@GetAllCategoriesAPI');
Route::post('/GetSubCategories','SubCategoryController@GetSubCategoriesAPI');
//Taglines
Route::get('/GetSavedTaglines','TaglineController@GetTaglinesAPI');
Route::post('/SaveNewTagline','TaglineController@SaveTaglinesAPI');
//Keywords
Route::get('/GetSavedKeywords','KeywordController@GetKeywordsAPI');
Route::post('/SaveNewKeyword','KeywordController@SaveKeywordAPI');

//Free Lancer
Route::post('/SaveFreelanceBasicAll','FreelanceController@SaveFreeLanceBasicAllAPI');
Route::post('/JoinAsTradie','FreelanceController@JoinAsTradieAPI');

Route::post('/SaveFreelanceBasic','FreelanceController@SaveFreeLanceBasicAPI');
Route::post('/GetFreelancebasic','FreelanceController@GetFreeLanceBasicAPI');
Route::post('/ActivateFreelancer','FreelanceController@ActiveFreelanceAPI');

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
Route::post('/DeleteTagline','FreelanceController@DeleteTaglineAPI');

Route::post('/SaveKeyword','FreelanceController@SaveKeywordAPI');
Route::post('/GetKeywords','FreelanceController@GetKeywordsAPI');
Route::post('/DeleteKeyword','FreelanceController@DeleteKeywordAPI');

Route::post('/GetFreelancers','FreelanceController@GetFreelancersAPI');
Route::post('/GetFreelancer','FreelanceController@GetFreelancerAPI');

Route::post('/GetDocuments','FreelanceController@GetDocumentsAPI');
Route::post('/UploadDocument','FreelanceController@UploadDocumentAPI');
Route::post('/DeleteDocuments','FreelanceController@DeleteDocumentAPI');
Route::post('/VerifyTradie','ApiController@VerifyTradieAPI');

Route::post('/SaveTradieReview','FreelanceController@SaveTradieReviewAPI');

Route::post('/GetSkills','FreelanceController@GetSkillsAPI');

Route::post('/SaveBank','FreelanceController@SaveBankAPI');
Route::post('/GetBank','FreelanceController@GetBankAPI');

Route::post('/UpdateCommission','FreelanceController@UpdateCommissionAPI');

//Project
Route::get('/LoadSuberbs','ProjectController@LoadSuberbsAPI');
Route::post('/SaveProject','ProjectController@SaveProjectAPI');
Route::post('/GetProjects','ProjectController@GetProjectsAPI');
Route::post('/SaveProjectComment','ProjectController@SaveProjectCommentAPI');
Route::post('/DeleteComment','ProjectController@DeleteCommentAPI');
Route::get('/GetProjectbasic/{id}','ProjectController@GetBasicProjectAPI');
Route::post('/ChangeProjectStatus','ProjectController@ChangeProjectStatus');

Route::get("GetUnpaidJobsByCustomer/{user_id}","ProjectController@GetUnpaidJobsByCustomerAPI");

//Project Progress
Route::post('/SaveProjectProgress','ProjectController@SaveProjectProgressAPI');
Route::post('/DeleteProgress','ProjectController@DeleteProgressAPI');
Route::post('/GetProjectProgress','ProjectController@GetProjectProgressAPI');

//Bids
Route::post('/SaveBid','BidController@SaveBidAPI');
Route::post('/GetBids','BidController@GetBidAPI');
Route::post('/LoadPreviousBid','BidController@GetPreviousBidAPI');
Route::post('/ApproveBid','BidController@ApproveBidAPI');

//Quote
Route::post('/SaveQuote','QuoteController@SaveQuoteAPI');
Route::post('/GetQuote','QuoteController@GetQuotesAPI');

//My Posts
Route::post('/GetMyPosts','ApiController@GetMyPosts');
Route::post('/GetMyAssignedPosts','ApiController@GetMyAssignedPosts');
Route::post('/GetMyReviewedTasks','ApiController@GetMyReviewedTasks');
//My Tasks
Route::post('/GetMyTasks','ApiController@GetMyTasks');
//My Bids
Route::post('/GetMyBids','ApiController@GetMyBids');
//Mail
Route::get('/SendMail','ApiController@SendMail');

Route::post('/GetProjectBids','BidController@GetBidsByProject');

//Reviews
Route::post("/SaveReview","ReviewController@SaveReviewAPI");
Route::get("/GetReviewByProject/{project_id}","ReviewController@GetReviewByProjectAPI");
Route::get("/GetReviewByTradie/{tradie_id}","ReviewController@GetReviewByTradieAPI");
Route::get("/GetReviewByCustomer/{customer_id}","ReviewController@GetReviewByCustomer");


//Test
Route::get("LongLat/{long}/{lat}/{distance}","ApiController@LongLat");

//Tradie Wallet

//Transactions
Route::post("/SaveTransaction","WalletController@SaveTransactionAPI");
Route::post("/GetTransactios","WalletController@GetTransactiosAPI");
Route::post("/WithdrawMoney","WalletController@WithdrawMoneyAPI");

//Admin
Route::post('/GetFreelancersAdmin','FreelanceController@GetFreelancersAdminAPI');
Route::post('/GetCustomersAdmin','ApiController@GetCustomersAdminAPI');
Route::post('/ActivationCustomer','ApiController@ActivationCustomerAPI');

Route::get('/GetAllUsers','ApiController@GetUsersAPI');

Route::post('/SaveAdmin','ApiController@AddAdminAPI');
Route::post('/GetAdmin', 'ApiController@GetAdminAPI');
Route::post('/UpdateAdmin','ApiController@UpdateAdminAPI');
Route::post('/ResetPassword','ApiController@ResetAdminPasswordAPI');
Route::post('/DeleteAdmin','ApiController@DeleteAdminAPI');
Route::post('/AcivationAdmin','ApiController@AcivationAdminAPI');

//Settings
Route::post("SaveCategory","CategoryController@SaveCategoryAPI");
Route::post("SaveSubCategory","SubCategoryController@SaveSubCategoryAPI");