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
Route::post('v1/getClients', [ApiController::class, 'getClients']);
Route::post('v1/getCas', [ApiController::class, 'getCas']);
Route::post('v1/getEmployee', [ApiController::class, 'getEmployee']);

Route::post('v1/getDashboardData', [ApiController::class, 'getDashboardData']);
Route::post('v1/getEmployeeDetails', [ApiController::class, 'getEmployeeDetails']);
Route::post('v1/getCASDetails', [ApiController::class, 'getCASDetails']);
Route::post('v1/getClientDetails', [ApiController::class, 'getClientDetails']);
Route::post('v1/addClient', [ApiController::class, 'addClient']);
Route::post('v1/addEmployee', [ApiController::class, 'addEmployee']);
Route::post('v1/addCas', [ApiController::class, 'addCas']);
Route::post('v1/deleteAccount', [ApiController::class, 'deleteAccount']);
Route::post('v1/changePassword', [ApiController::class, 'changePassword']);
Route::post('v1/downlodDocumentList', [ApiController::class, 'downlodDocumentList']);
Route::post('v1/sendNotification', [ApiController::class, 'sendNotification']);
Route::post('v1/reportCouponDownload', [ApiController::class, 'reportCouponDownload']);


//profiles
Route::post('v1/profile/upload', [ProfileController::class, 'uploadProfileImage']);
Route::post('v1/profile/update', [ProfileController::class, 'updateProfile']);
Route::post('v1/profile/getProfile', [ProfileController::class, 'getProfileDetails']);


Route::post('/v1/logout', [ApiController::class, 'logout']);
