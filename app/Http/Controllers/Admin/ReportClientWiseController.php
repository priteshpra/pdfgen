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
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\State;
use App\Models\UserDevices;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportClientWiseController extends Controller
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
            DB::raw('(SELECT COUNT(scanned_documents.ScanneddocumentID)
                    FROM scanned_documents
                    WHERE scanned_documents.CompanyID = users.CompanyID) as document_count')
        )
            ->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')
            ->with('role')
            ->where('users.UserType', '3')
            ->whereNotNull('users.CompanyID')
            ->whereDate('users.created_at', '=', $currentDate)
            ->orderBy('users.id', 'desc')->get();
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        return view('admin.reportclients.index', compact('users', 'country', 'city', 'state'));
    }

    public function monthly(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $currentDate = Carbon::now()->toDateString();
        $monthEndDate = Carbon::now()->endOfMonth()->toDateString();


        $users = User::select(
            'users.*',
            'company.*',
            DB::raw('(SELECT COUNT(scanned_documents.ScanneddocumentID)
                    FROM scanned_documents
                    WHERE scanned_documents.CompanyID = users.CompanyID) as document_count')
        )
            ->leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->with('role')->where('users.UserType', '3')->whereNotNull('users.CompanyID')->whereBetween('users.created_at', [$currentDate, $monthEndDate])->orderBy('users.id', 'desc')->get();
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        return view('admin.reportclients.monthly', compact('users', 'currentDate', 'monthEndDate', 'state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $state = State::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $roles = Role::pluck('title', 'id');
        return view('admin.clients.create', compact('roles', 'city', 'state', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $userRequest, StoreClientRequest $clientRequest)
    {
        // Store the user information
        $user = User::create($userRequest->validated());
        $lastID = $user->id;
        // Attach the user ID (if needed) to the CAS data
        $casData = $clientRequest->validated();

        // Store the CAS information
        $cas = CAs::create($casData);
        $lastCompanyID = $cas->CompanyID;

        $user = User::find($lastID);
        if ($user) {
            $user->CompanyID = $lastCompanyID;
            $user->save();
        }
        return redirect()->route('admin.client.index')->with(['status-success' => "New Client Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $city = City::all();
        $state = State::all();
        $roles = Role::pluck('title', 'id');
        $user = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->where('users.id', $id)->first();
        $employee = User::where('CompanyID', $user->CompanyID)->where('UserType', '2')->get()->toArray();
        $employeesNameData = array_column($employee, 'FirstName', 'id');
        $employeesId = array_column($employee, 'id');
        $scanDocuments = Scandocument::where('UserID', $id)->orWhere('CompanyID', $user->CompanyID)->get();
        $otherDocuments = OtherDocument::where('UserID', $id)->orWhere('CompanyID', $user->CompanyID)->get();
        $employees = User::where('CompanyID', $user->CompanyID)->where('UserType', '3')->get()->toArray();
        $employeesNameDatas = array_column($employees, 'FirstName', 'id');
        $notificationList =
            Notification::where('UserID', $id)->get();
        $deviceList = UserDevices::where('user_id', $id)->get();

        return view('admin.clients.show', compact('user', 'city', 'state', 'employee', 'scanDocuments', 'employeesNameData', 'otherDocuments', 'notificationList', 'id', 'deviceList', 'employeesNameDatas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CAs $user, $id = null)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $user = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->where('users.id', $id)->first();
        $country = Country::all();
        $city = City::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $state = State::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $roles = Role::pluck('title', 'id');
        return view('admin.clients.edit', compact('user', 'roles', 'country', 'state', 'city'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $userRequest, UpdateClientRequest $clientRequest, $id)
    {
        // Find the existing user
        $user = User::findOrFail($id);

        // Update the user information
        $user->update($userRequest->validated());

        // Find the existing CAS record (assuming CAS has a foreign key reference to User)
        $cas = CAs::where('CompanyID', $user->CompanyID)->first();
        // If CAS exists, update it
        if ($cas) {
            $casData = $clientRequest->validated(); // Get validated data for CAS
            $cas->update($casData); // Update the CAS record
        }
        return redirect()->route('admin.client.index')->with(['status-success' => "Client Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "User Deleted"]);
    }

    public function toggleStatus(Request $request)
    {
        $user = User::find($request->id); // Get the user by ID
        $companyId = $user->CompanyID;

        $cas = CAs::find($companyId);
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            $cas->Status = $request->Status; // Toggle status
            $cas->save();

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
