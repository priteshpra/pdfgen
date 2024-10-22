<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\BussinessCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CasController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\PageController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::group(['prefix' => "admin", 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'AdminPanelAccess']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/users', 'UserController');
    Route::resource('/client', 'ClientController');
    Route::resource('/cas', 'CasController');
    Route::resource('/bussinesscategory', 'BussinessCategoryController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController')->except(['show']);

    Route::resource('/country', 'CountryController');
    // Route::post('/search', 'CountryController');

    Route::post('/search', 'StateController@search')->name('state.search');
    Route::resource('/state', 'StateController');

    Route::resource('/city', 'CityController');
    Route::resource('/cms', 'CmsController');
    Route::resource('/page', 'PageController');
    Route::get('/generate-pdf', [App\Http\Controllers\Admin\PDFController::class, 'generatePDF']);
    Route::get('/upload-images', [PDFController::class, 'showUploadForm']);
    Route::post('/upload-images', [PDFController::class, 'handleImageUpload']);
    Route::post('/toggle-status', [BussinessCategoryController::class, 'toggleStatus'])->name('toggle.status');
    Route::post('/cas-toggle-status', [CasController::class, 'toggleStatus'])->name('castoggle.status');
    Route::post('/client-toggle-status', [ClientController::class, 'toggleStatus'])->name('clienttoggle.status');
    Route::post('/user-toggle-status', [UserController::class, 'toggleStatus'])->name('usertoggle.status');
    Route::post('/state-toggle-status', [StateController::class, 'toggleStatus'])->name('statetoggle.status');
    Route::post('/country-toggle-status', [CountryController::class, 'toggleStatus'])->name('countrytoggle.status');
    Route::post('/city-toggle-status', [CityController::class, 'toggleStatus'])->name('citytoggle.status');
    Route::post('/cms-toggle-status', [CmsController::class, 'toggleStatus'])->name('cmstoggle.status');
    Route::post('/page-toggle-status', [PageController::class, 'toggleStatus'])->name('pagetoggle.status');


    // Route::post('/search', 'CityController');
});
