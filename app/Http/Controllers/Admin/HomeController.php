<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employee = User::where(['Status' => '1', 'UserType' => '2'])->count();
        $clients = User::where(['Status' => '1', 'UserType' => '3'])->count();
        $cas = User::where(['users.Status' => '1', 'UserType' => '4'])->count();
        $documents = Scandocument::where(['Status' => '1'])->count();
        $employeeLists = User::with('role')->where('UserType', '2')->orderBy('id', 'desc')->limit('5')->get();
        DB::enableQueryLog();
        $clientLists = User::select(
            'users.id',
            'users.FirstName',
            'users.LastName',
            'users.MobileNo',
            'users.CompanyID',
            'users.Email',
            'company.ClientCode',
            'company.Address',
            'company.FirmName',
            'company.AadharNumber',
            'company.GSTNumber',
            'company.PANNumber',
            'company.FirmType',
            'users.IsApproved',
            'businesscategory.CategoryName',
        )->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('businesscategory', 'businesscategory.BusinessCategoryID', '=', 'company.BusinnessCatID')
            ->where('users.UserType', '3')
            ->whereNotNull('users.CompanyID')
            ->whereDate('users.created_at', Carbon::now()->toDateString())
            ->orderBy('users.id', 'desc')->get();
        // dd(DB::getQueryLog());
        $casList = User::select(
            'users.id',
            'users.FirstName',
            'users.LastName',
            'users.MobileNo',
            'users.CompanyID',
            'users.Email',
            'company.ClientCode',
            'company.Address',
            'company.FirmName',
            'company.AadharNumber',
            'company.GSTNumber',
            'company.PANNumber',
            'company.FirmType',
            'users.IsApproved',
            'businesscategory.CategoryName',
        )->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('businesscategory', 'businesscategory.BusinessCategoryID', '=', 'company.BusinnessCatID')
            ->where('users.UserType', '4')
            ->whereNotNull('users.CompanyID')
            ->orderBy('users.id', 'desc')
            ->whereDate('users.created_at', Carbon::now()->toDateString())
            ->get();

        $documentLists = Scandocument::select(
            'users.FirstName',
            'users.FirstName',
            'users.LastName',
            'company.FirmName',
            'scanned_documents.CountryID',
            'scanned_documents.Title',
            'scanned_documents.BatchNo',
            'scanned_documents.ImageCount',
            'scanned_documents.Remarks',
            'scanned_documents.DocumentURL',
            'scanned_documents.CreatedDate',
        )
            ->leftJoin('company', 'scanned_documents.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('users', 'users.id', '=', 'scanned_documents.CreatedBy')
            ->where(['scanned_documents.Status' => '1'])->orderBy('scanned_documents.id', 'DESC')->limit(20);

        $otherDocumentLists = OtherDocument::select(
            'users.FirstName',
            'users.FirstName',
            'users.LastName',
            'company.FirmName',
            'otherdocuments.CountryID',
            'otherdocuments.Title',
            'otherdocuments.BatchNo',
            'otherdocuments.ImageCount',
            'otherdocuments.Remarks',
            'otherdocuments.DocumentURL',
            'otherdocuments.CreatedDate',
        )
            ->leftJoin('company', 'otherdocuments.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('users', 'users.id', '=', 'otherdocuments.CreatedBy')
            ->where(['otherdocuments.Status' => '1'])->orderBy('otherdocuments.id', 'DESC')->limit(20);

        return view('admin.home', compact('employee', 'clients', 'cas', 'documents', 'employeeLists', 'clientLists', 'casList', 'documentLists', 'otherDocumentLists'));
    }
}
