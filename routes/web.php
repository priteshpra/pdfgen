<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PDFController;
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

    // Route::post('/search', 'CityController');
});
