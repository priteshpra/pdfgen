<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\Role;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('users_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        // $users = City::with('role')->paginate(25)->appends($request->query());
        $users = City::with('role', 'state')->leftJoin('states', 'cities.StateID', '=', 'states.StateID')->get();

        return view('admin.city.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('city_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        $country = Country::all();
        $state = State::all();
        return view('admin.city.create', compact('roles', 'country', 'state'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        City::create($request->validated());
        return redirect()->route('admin.city.index')->with(['status-success' => "New City Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(City $user)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.city.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $user, $id)
    {
        $user = City::where(['CityID' => $id])->first();
        $country = Country::all();
        $state = State::all();
        // dd($user);
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.city.edit', compact('user', 'state', 'roles', 'country'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update(array_filter($request->validated()));
        return redirect()->route('admin.city.index')->with(['status-success' => "City Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $city->delete();
        return redirect()->back()->with(['status-success' => "City Deleted"]);
    }

    public function toggleStatus(Request $request)
    {
        $user = City::find($request->CityID); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
