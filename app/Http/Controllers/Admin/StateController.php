<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StateRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use App\Models\Country;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('state_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        // $users = State::with('role')->paginate(25)->appends($request->query());
        $users = State::with('role')->get();
        return view('admin.state.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('state_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        $country = Country::all();
        return view('admin.state.create', compact('roles', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StateRequest $request)
    {
        State::create($request->validated());
        return redirect()->route('admin.state.index')->with(['status-success' => "New State Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(State $user)
    {
        abort_if(Gate::denies('state_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.state.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(State $user, $id)
    {
        $user = State::where(['StateID' => $id])->first();
        abort_if(Gate::denies('state_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        $country = Country::all();
        return view('admin.state.edit', compact('user', 'roles', 'country'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, State $user)
    {
        $user->update(array_filter($request->validated()));
        return redirect()->route('admin.state.index')->with(['status-success' => "State Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "State Deleted"]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        if ($search != '') {
            $services = State::where('State', 'like', '%' . $search . '%')->paginate(25);
            $services->appends(array('search' => Input::get('search'),));
            if (count($services) > 0) {
                return view('admin.state.index', ['users' => $services]);
            }
            return back()->with('error', 'No results Found');
        }
    }

    public function toggleStatus(Request $request)
    {
        $user = State::find($request->StateID); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => 'success', 'message' => 'Status updated successfully!', 'status' => $user->status]);
        }

        return response()->json(['success' => 'error', 'message' => 'Status updated failed.']);
    }
}
