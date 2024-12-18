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
// use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ScandocumentController;
use App\Http\Controllers\Admin\OtherdocumentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ConfigurationController;
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
    // Route::resource('/company', 'CompanyController');
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
    Route::resource('/scandocument', 'ScandocumentController');
    Route::resource('/otherdocument', 'OtherdocumentController');
    Route::resource('/profile', 'ProfileController');
    Route::resource('/configuration', 'ConfigurationController');

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
    Route::post('/cas/{id}/update-password', [CasController::class, 'updatePassword'])->name('cas.update-password');
    // Route::post('/update-password/{id}', [CasController::class, 'updatePassword'])->name('cas.update.password');
    Route::post('/notification-toggle-status', [
        CasController::class,
        'notificationToggleStatus'
    ])->name('notificationtoggle.status');
    Route::post('/otherdoc-toggle-status', [CasController::class, 'otherDocToggleStatus'])->name('otherdoctoggle.status');
    Route::post('/scandoc-toggle-status', [CasController::class, 'scanDocToggleStatus'])->name('scandoctoggle.status');

    // Route::get('/admin/company/create/{userId}', [CompanyController::class, 'create'])->name('admin.company.create');

    // Route::post('/search', 'CityController');

    Route::get('download/{user_id}/{filename}', function ($user_id, $filename) {
        $path = storage_path("app/public/pdfs/{$user_id}/{$filename}");
        if (!file_exists($path)) {
            abort(404, "File not found");
        }
        return response()->download($path);
    })->name('download.file');

    // Route::get('pdf/{user_id}/{filename}', [PDFController::class, 'downloadFile'])->name('pdf.file');
});
