<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCAsRequest;
use App\Http\Requests\UpdateCAsRequest;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class CompanyController extends Controller
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
        // $users = User::where('user_type', '4')->paginate(25)->appends($request->query());
        $users = CAs::where('user_type', '4')->orderBy('id', 'desc')->get();
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
    public function store(StoreCAsRequest $request)
    {
        // dd($request);
        Company::create($request->validated());
        return redirect()->route('admin.cas.index')->with(['status-success' => "New Comapny Created"]);
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
        $user = Company::find($id);
        $employee = Company::where('client_id', $id)->where('Status', '1')->get()->toArray();
        $employeesNameData = array_column($employee, 'name', 'id');
        $employeesId = array_column($employee, 'id');
        $scanDocuments = Scandocument::whereIn('UserID', $employeesId)->where('Status', '1')->get();
        $otherDocuments = OtherDocument::whereIn('UserID', $employeesId)->where('Status', '1')->get();
        $notificationList = Notification::where('UserID', $id)->get();
        // dd($scanDocuments);
        return view('admin.cas.show', compact('user', 'city', 'state', 'country', 'employee', 'scanDocuments', 'employeesNameData', 'otherDocuments', 'notificationList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $referer = $request->headers->get('referer');
        if ($referer) {
            // Parse the referer URL and get the path component
            $parsedUrl = parse_url($referer);

            // Extract the last part of the path (the last segment)
            $lastSegment = basename($parsedUrl['path']); // 'cas' will be returned
        }
        abort_if(Gate::denies('cas_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $user = Company::where('ClientID', $id)->first();
        // dd($user);
        $country = Country::all();
        $city = City::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $state = State::orderByRaw("CASE WHEN IsOpen = 'Yes' THEN 1 ELSE 2 END")->get();
        $roles = Role::pluck('title', 'id');
        return view('admin.company.edit', compact('user', 'roles', 'city', 'state', 'country', 'id', 'lastSegment'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $Clientid)
    {

        $cas = Company::where('ClientID', $Clientid)->get();
        if ($cas->isNotEmpty()) {
            $comp = Company::where('ClientID', $Clientid);
            $updated = $comp->update(array_filter($request->validated()));
        } else {
            $company = Company::create($request->validated());
            $lastInsertedId = $company->CompanyID;
            $Company = User::find($Clientid);
            if ($Company) {
                $Company->CompanyID = $lastInsertedId; // Update the field
                $Company->save(); // Save the changes
            }
        }
        if ($request->lastSegment) {
            $LastBackUrl = 'admin.' . $request->lastSegment . '.index';
        } else {
            $LastBackUrl = 'admin.cas.index';
        }
        return redirect()->route($LastBackUrl)->with(['status-success' => "Comapny Updated successfully"]);
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
        $user = CAs::find($request->id); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
