<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PDFController;
use App\Http\Controllers\Admin\BussinessCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ReportClientWiseController;
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
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportClientWiseOtherController;
use App\Http\Controllers\Admin\NotificationController;
use App\Models\Company;
use App\Models\User;

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
    return view('auth/login');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', function () {
    return view('about');
});

Route::get('/logout', function () {
    // Perform any logout-related actions, if necessary.
    return redirect('/login'); // Redirect to the login page.
})->name('logout');
Auth::routes();



Route::group(['prefix' => "admin", 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'AdminPanelAccess']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('/users', 'UserController');
    Route::resource('/client', 'ClientController');
    Route::resource('/reportclientwise', 'ReportClientWiseController');
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
    Route::resource('/reports', 'ReportClientWiseController');
    Route::resource('/otherreports', 'ReportClientWiseOtherController');
    Route::resource('/notification', 'NotificationController');

    Route::get('/generate-pdf', [App\Http\Controllers\Admin\PDFController::class, 'generatePDF']);
    Route::get('/reports/monthly', [ReportClientWiseController::class, 'monthly'])->name('reportclientwise.monthly');
    Route::get('/upload-images', [PDFController::class, 'showUploadForm']);
    Route::post('/upload-images', [PDFController::class, 'handleImageUpload']);
    Route::post('/toggle-status', [BussinessCategoryController::class, 'toggleStatus'])->name('toggle.status');
    Route::post('/cas-toggle-status', [CasController::class, 'toggleStatus'])->name('castoggle.status');
    Route::post('/client-toggle-status', [ClientController::class, 'toggleStatus'])->name('clienttoggle.status');
    Route::post('/client-approve-status', [ClientController::class, 'toggleApproveStatus'])->name('clientapprovetoggle.status');
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


    Route::get('/download/{user_id}/{filename}', function ($user_id, $filename) {
        $UserData = User::find($user_id)->CompanyID;
        $CompanyData = Company::find($UserData);
        $pdfsPath = str_replace(' ', '_', $CompanyData->FirmName) . '_' . $CompanyData->ClientCode;
        $path = storage_path("app/public/{$pdfsPath}/{$user_id}/{$filename}");
        // dd($path);
        if (!file_exists($path)) {
            abort(404, "File not found");
        }
        return response()->download($path);
    })->name('download.file');

    Route::get('/documents/chart-data', [HomeController::class, 'fetchChartData'])->name('documents.chart-data');
    Route::get('/documents/line-chart-data', [HomeController::class, 'getDocumentUploadData'])->name('documents.line-chart-data');


    Route::get('/reports', [ReportClientWiseController::class, 'index'])->name('reportclientwise.index');
    Route::get('admin/reports/filter', [ReportClientWiseController::class, 'filter'])->name('reportclientwise.filter');

    Route::get('/otherreports', [ReportClientWiseOtherController::class, 'index'])->name('reportclientwiseother.index');
    Route::get('admin/otherreports/filter', [ReportClientWiseOtherController::class, 'filter'])->name('reportclientwiseother.filter');
});
