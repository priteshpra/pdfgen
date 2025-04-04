<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Role;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        // $users = Country::with('role')->paginate(25)->appends($request->query());
        $users = Country::with('role')->get();
        // dd($users);
        return view('admin.country.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.country.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        Country::create($request->validated());
        return redirect()->route('admin.country.index')->with(['status-success' => "New Country Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Country $user)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.country.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $user, $id)
    {
        $user = Country::where(['CountryID' => $id])->first();
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.country.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update(array_filter($request->validated()));
        return redirect()->route('admin.country.index')->with(['status-success' => "Country Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $country->delete();
        return redirect()->back()->with(['status-success' => "Country Deleted"]);
    }

    public function toggleStatus(Request $request)
    {
        $user = Country::find($request->CountryID); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
