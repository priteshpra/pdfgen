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
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Country;
use App\Models\Notification;
use App\Models\OtherDocument;
use App\Models\Scandocument;
use App\Models\State;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        // $users = User::with('role')->where('user_type', '3')->paginate(25)->appends($request->query());
        $users = User::with('role')->where('user_type', '3')->orderBy('id', 'desc')->get();
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        return view('admin.clients.index', compact('users', 'country', 'city', 'state'));
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
    public function store(StoreClientRequest $request)
    {
        // dd($request);
        User::create($request->validated());
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
        $user = User::find($id);
        $employee = User::where('client_id', $id)->where('Status', '1')->get()->toArray();
        $employeesNameData = array_column($employee, 'name', 'id');
        $employeesId = array_column($employee, 'id');
        $scanDocuments = Scandocument::whereIn('UserID', $employeesId)->where('Status', '1')->get();
        $otherDocuments = OtherDocument::whereIn('UserID', $employeesId)->where('Status', '1')->get();
        $notificationList = Notification::where('UserID', $id)->get();

        return view('admin.clients.show', compact('user', 'city', 'state', 'employee', 'scanDocuments', 'employeesNameData', 'otherDocuments', 'notificationList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id = null)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $user = User::find($id);
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
    public function update(UpdateClientRequest $request, $id)
    {
        $user = User::find($id);
        $user->update(array_filter($request->validated()));
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
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
