<?php

use App\Http\Controllers\API\V1\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\ProfileController;
use App\Http\Controllers\API\V1\BannerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('v1/login', [ApiController::class, 'login']);
Route::get('v1/getClients', [ApiController::class, 'getClients']);
Route::get('v1/getCas', [ApiController::class, 'getCas']);
Route::get('v1/getRoles', [ApiController::class, 'getRoles']);

Route::get('v1/getEmployee', [ApiController::class, 'getEmployee']);
Route::get('v1/getBusinessCategory', [ApiController::class, 'getBusinessCategory']);
Route::get('v1/getPageList', [ApiController::class, 'getPageList']);
Route::get('v1/getDocumentList', [ApiController::class, 'getDocumentList']);


Route::get('v1/getDashboardData', [ApiController::class, 'getDashboardData']);

Route::get('v1/getEmployeeDetails', [ApiController::class, 'getEmployeeDetails']);
Route::get('v1/getCASDetails', [ApiController::class, 'getCASDetails']);
Route::get('v1/getClientDetails', [ApiController::class, 'getClientDetails']);
Route::get('v1/getPageContentById', [ApiController::class, 'getPageContentById']);

// below api remove token wise
Route::get('v1/getCity', [ApiController::class, 'getCity']);
Route::get('v1/getCountry', [ApiController::class, 'getCountry']);
Route::get('v1/getState', [ApiController::class, 'getState']);
Route::get('v1/getOtherDocument', [ApiController::class, 'getOtherDocument']);
Route::get('v1/getNotificationList', [ApiController::class, 'getNotificationList']);

// below update version API
Route::get('v1/getAppversion', [ApiController::class, 'getAppversion']);

Route::post('v1/addClient', [ApiController::class, 'addClient']);
Route::post('v1/addEmployee', [ApiController::class, 'addEmployee']);
Route::post('v1/addCas', [ApiController::class, 'addCas']);
Route::post('v1/deleteAccount', [ApiController::class, 'deleteAccount']);
Route::post('v1/changePassword', [ApiController::class, 'changePassword']);
Route::post('v1/downlodDocumentList', [ApiController::class, 'downlodDocumentList']);
Route::post('v1/sendNotification', [ApiController::class, 'sendNotification']);
Route::post('v1/reportCouponDownload', [ApiController::class, 'reportCouponDownload']);
Route::post('v1/documentUpload', [ApiController::class, 'documentUpload']);
Route::post('v1/otherDocumentUpload', [ApiController::class, 'otherDocumentUpload']);


//profiles
Route::post('v1/profile/upload', [ProfileController::class, 'uploadProfileImage']);
Route::post('v1/profile/update', [ProfileController::class, 'updateProfile']);
Route::post('v1/profile/getProfile', [ProfileController::class, 'getProfileDetails']);


Route::post('/v1/logout', [ApiController::class, 'logout']);


Route::post('v1/forgot-password', [ApiController::class, 'sendResetLinkEmail']);

Route::get('v1/reset-password/{token}', [ApiController::class, 'showResetForm'])->name('password.reset');
Route::post('v1/reset-password', [ApiController::class, 'reset'])->name('password.update');
