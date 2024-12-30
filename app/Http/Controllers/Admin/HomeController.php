<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\User;
use App\Models\UserDevices;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

        $clientLists = User::select(
            'users.id',
            'users.FirstName',
            'users.LastName',
            'users.MobileNo',
            'users.CompanyID',
            'users.Email',
            'company.ClientCode',
            'company.Address',
            'users.id AS UserID',
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
            'users.id AS UserID',
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
        DB::enableQueryLog();
        $documentLists = Scandocument::select(
            'users.FirstName',
            'users.FirstName',
            'users.LastName',
            'company.FirmName',
            'scanned_documents.CompanyID',
            'scanned_documents.Title',
            'scanned_documents.BatchNo',
            'scanned_documents.UserID',
            'scanned_documents.ImageCount',
            'scanned_documents.Remarks',
            'scanned_documents.DocumentURL',
            'scanned_documents.CreatedDate',
        )->leftJoin('company', 'scanned_documents.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('users', 'users.id', '=', 'scanned_documents.UserID')
            ->where('scanned_documents.Status', '1')
            ->orderBy('scanned_documents.ScanneddocumentID', 'DESC')
            ->limit(20)->get();
        // dd(DB::getQueryLog());
        $otherDocumentLists = OtherDocument::select(
            'users.FirstName',
            'users.FirstName',
            'users.LastName',
            'company.FirmName',
            'otherdocuments.CompanyID',
            'otherdocuments.Title',
            'otherdocuments.BatchNo',
            'otherdocuments.UserID',
            'otherdocuments.ImageCount',
            'otherdocuments.Remarks',
            'otherdocuments.DocumentURL',
            'otherdocuments.CreatedDate',
        )
            ->leftJoin('company', 'otherdocuments.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('users', 'users.id', '=', 'otherdocuments.UserID')
            ->where(['otherdocuments.Status' => '1'])->orderBy('otherdocuments.OtherdocumentsID', 'DESC')->limit(20)->get();

        $androidCount = UserDevices::where('device_type', 'Android')->distinct('user_id')->count('user_id');
        $iosCount = UserDevices::where('device_type', 'iOS')->distinct('user_id')->count('user_id');

        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = Carbon::now()->toDateString();

        $data = Scandocument::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $labels = $data->pluck('date')->toArray();
        $counts = $data->pluck('count')->toArray();
        if (empty($labels)) {
            $labels = ['No Data'];
            $counts = [0];
        }
        // dd(json_encode($labels));
        return view('admin.home', compact('employee', 'clients', 'cas', 'documents', 'employeeLists', 'clientLists', 'casList', 'documentLists', 'otherDocumentLists', 'androidCount', 'iosCount', 'labels', 'counts'));
    }

    public function fetchChartData(Request $request)
    {
        // Default to the current month's data
        $startDate = $request->input('start_date') ?? Carbon::now()->startOfMonth()->toDateString();
        $endDate = $request->input('end_date') ?? Carbon::now()->toDateString();
        DB::enableQueryLog();
        // Fetch data grouped by day
        $data = Scandocument::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        // dd(DB::getQueryLog());
        return response()->json([
            'labels' => $data->pluck('date'),
            'counts' => $data->pluck('count'),
        ]);
    }

    public function getDocumentUploadData(Request $request)
    {
        $startDate = Carbon::parse($request->start_date ?? Carbon::now()->startOfMonth());
        $endDate = Carbon::now(); // Today
        DB::enableQueryLog();
        // Query the document upload counts by client and day
        $data = DB::table('scanned_documents')
            ->select(DB::raw('DATE(scanned_documents.created_at) as date'), 'scanned_documents.CompanyID', 'company.FirmName', DB::raw('count(*) as upload_count'))
            ->leftJoin('company', 'scanned_documents.CompanyID', '=', 'company.CompanyID')
            ->whereBetween('scanned_documents.created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(scanned_documents.created_at)'), 'scanned_documents.CompanyID', 'company.FirmName')
            ->orderBy('date')
            ->get();
        // dd(DB::getQueryLog());
        return response()->json($data);
    }
}
