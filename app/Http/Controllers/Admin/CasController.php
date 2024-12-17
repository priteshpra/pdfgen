<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCAsRequest;
use App\Http\Requests\UpdateCAsRequest;
use App\Models\Role;
use App\Models\CAs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\State;
use App\Models\User;
use App\Models\UserDevices;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('cas_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        // $users = User::where('UserType', '4')->paginate(25)->appends($request->query());
        $users = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->where('users.UserType', '4')->orderBy('users.id', 'desc')->get();
        return view('admin.cas.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('cas_create'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        $roles = Role::pluck('title', 'id');
        return view('admin.cas.create', compact('roles', 'city', 'state', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $userRequest, StoreCAsRequest $casRequest)
    {
        // Store the user information
        $user = User::create($userRequest->validated());
        $lastID = $user->id;
        // Attach the user ID (if needed) to the CAS data
        $casData = $casRequest->validated();

        // Store the CAS information
        $cas = CAs::create($casData);
        $lastCompanyID = $cas->CompanyID;

        $user = User::find($lastID);
        if ($user) {
            $user->CompanyID = $lastCompanyID;
            $user->save();
        }
        return redirect()->route('admin.cas.index')->with(['status-success' => "New CAS Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        abort_if(Gate::denies('cas_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $state = State::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $user = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->where('users.id', $id)->first();
        $employee = User::where('CompanyID', $user->CompanyID)->where('UserType ', '2')->get()->toArray();
        $employeesNameData = array_column($employee, 'FirstName', 'id');
        $employeesId = array_column($employee, 'id');
        $scanDocuments = Scandocument::whereIn('UserID', $employeesId)->orWhere('CompanyID', $user->CompanyID)->get();
        $otherDocuments = OtherDocument::whereIn('UserID', $employeesId)->orWhere('CompanyID', $user->CompanyID)->get();
        $notificationList = Notification::where('UserID', $id)->get();
        // dd($scanDocuments);
        $deviceList = UserDevices::where('user_id', $id)->get();
        return view('admin.cas.show', compact('user', 'city', 'state', 'country', 'employee', 'scanDocuments', 'employeesNameData', 'otherDocuments', 'notificationList', 'id', 'deviceList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CAs $user, $id = null)
    {
        abort_if(Gate::denies('cas_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $user = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->where('users.id', $id)->first();
        $country = Country::all();
        $city = City::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $state = State::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $roles = Role::pluck('title', 'id');
        return view('admin.cas.edit', compact('user', 'roles', 'city', 'state', 'country'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $userRequest, UpdateCAsRequest $casRequest, $id)
    {
        // Find the existing user
        $user = User::findOrFail($id);

        // Update the user information
        $user->update($userRequest->validated());

        // Find the existing CAS record (assuming CAS has a foreign key reference to User)
        $cas = CAs::where('CompanyID', $user->CompanyID)->first();
        // If CAS exists, update it
        if ($cas) {
            $casData = $casRequest->validated(); // Get validated data for CAS
            $cas->update($casData); // Update the CAS record
        }
        return redirect()->route('admin.cas.index')->with(['status-success' => "CAS Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CAs $user)
    {
        abort_if(Gate::denies('cas_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "User Deleted"]);
    }

    public function toggleStatus(Request $request)
    {
        $user = User::find($request->id);
        $companyId = $user->CompanyID;

        $cas = CAs::find($companyId);
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save();

            $cas->Status = $request->Status; // Toggle status
            $cas->save();

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ], [
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the user by ID

        $user = User::findOrFail($id);
        // Check if the old password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with(['status-danger' => 'The old password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return success response
        return back()->with('status-success', 'Password changed successfully!');
    }

    public function notificationToggleStatus(Request $request)
    {
        $user = Notification::find($request->id); // Get the user by ID
        if ($user) {
            $user->IsRead = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Notification read successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Notification read failed.']);
    }

    public function otherDocToggleStatus(Request $request)
    {
        $user = OtherDocument::find($request->id); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }

    public function scanDocToggleStatus(Request $request)
    {
        $user = Scandocument::find($request->id); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
