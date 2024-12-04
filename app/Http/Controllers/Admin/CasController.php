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
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\City;
use App\Models\Country;
use App\Models\State;

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
        // $users = User::where('user_type', '4')->paginate(25)->appends($request->query());
        $users = CAs::where('user_type', '4')->get();
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
        User::create($request->validated());
        return redirect()->route('admin.cas.index')->with(['status-success' => "New CAS Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(CAs $user)
    {
        abort_if(Gate::denies('cas_show'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $country = Country::all();
        $city = City::all();
        $state = State::all();
        return view('admin.cas.show', compact('user', 'city', 'state', 'country'));
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
        $user = CAs::find($id);
        $country = Country::all();
        $city = City::all();
        $state = State::all();
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
    public function update(UpdateCAsRequest $request, $id)
    {
        $cas = CAs::find($id);
        $updated = $cas->update(array_filter($request->validated()));
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
        $user = CAs::find($request->id); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
