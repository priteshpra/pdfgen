<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\CAs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\State;
use App\Models\UserDevices;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportClientWiseOtherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $currentDate = Carbon::now()->toDateString();
        $users = User::select(
            'users.*',
            'company.*',
            DB::raw('(SELECT COUNT(otherdocuments.OtherdocumentsID)
                    FROM otherdocuments
                    WHERE otherdocuments.CompanyID = users.CompanyID) as document_count')
        )
            ->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')
            ->with('role')
            ->where('users.UserType', '3')
            ->whereNotNull('users.CompanyID')
            ->whereDate('users.created_at', '=', $currentDate)
            ->orderBy('users.id', 'desc')->get();
        $clients = Company::select(
            'users.FirstName',
            'users.LastName',
            'company.FirmName',
            'company.CompanyID',
            'users.id',
        )
            ->leftJoin('users', 'users.CompanyID', '=', 'company.CompanyID')->get();  // Get all clients
        $selectedClientId = $clients->first()->CompanyID;
        $selectedUserId = $clients->first()->id;

        $users = $this->getUsers($selectedClientId, $selectedUserId, date('Y-m-d'), date('Y-m-d'));
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        return view('admin.reportclients.otherdoc', compact('users', 'country', 'city', 'state', 'clients', 'selectedClientId'));
    }

    public function filter(Request $request)
    {
        $CompanyID = $request->input('CompanyID');
        $client_user_id = $request->input('client_user_id');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $users = $this->getUsers($CompanyID, $client_user_id, $fromDate, $toDate);
        return view('admin.reportclients.clientwise_table', compact('users'));  // Partial view for the table rows
    }

    private function getUsers($CompanyID, $client_user_id, $fromDate, $toDate)
    {
        DB::enableQueryLog();
        return User::select(
            'users.*',
            'company.FirmName',
            'otherdocuments.Title',
            'otherdocuments.created_at',
            'otherdocuments.BatchNo',
            'otherdocuments.Remarks',
            DB::raw('(SELECT SUM(otherdocuments.ImageCount)
              FROM otherdocuments
              WHERE otherdocuments.CompanyID = users.CompanyID) as total_image_count')
        )
            ->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')
            ->leftJoin('otherdocuments', 'users.CompanyID', '=', 'otherdocuments.CompanyID')
            ->where('otherdocuments.CompanyID', $CompanyID)
            ->where('otherdocuments.UserID', $client_user_id)
            ->whereBetween('users.created_at', [$fromDate, $toDate])
            ->orderBy('users.id', 'desc')->get();
        // dd(DB::getQueryLog());
    }

    public function monthly(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $currentDate = Carbon::now()->toDateString();
        $monthEndDate = Carbon::now()->endOfMonth()->toDateString();


        $users = User::select(
            'users.*',
            'company.*',
            DB::raw('(SELECT COUNT(otherdocuments.OtherdocumentsID)
                    FROM otherdocuments
                    WHERE otherdocuments.CompanyID = users.CompanyID) as document_count')
        )
            ->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->with('role')->where('users.UserType', '3')->whereNotNull('users.CompanyID')->whereBetween('users.created_at', [$currentDate, $monthEndDate])->orderBy('users.id', 'desc')->get();
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        return view('admin.reportclients.monthly', compact('users', 'currentDate', 'monthEndDate', 'state'));
    }
}
