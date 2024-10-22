<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BussinessCatRequest;
use App\Http\Requests\UpdateBussinessRequest;
use App\Models\Role;
use App\Models\BussinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BussinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('bussiness_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $users = BussinessCategory::with('role')->paginate(25)->appends($request->query());
        // dd($users);
        return view('admin.bussiness.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('bussiness_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.bussiness.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BussinessCatRequest $request)
    {
        BussinessCategory::create($request->validated());
        return redirect()->route('admin.bussinesscategory.index')->with(['status-success' => "New Bussiness Category Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(BussinessCategory $user)
    {
        abort_if(Gate::denies('bussiness_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.bussiness.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BussinessCategory $user, $id)
    {
        $user = BussinessCategory::where(['BusinessCategoryID' => $id])->first();
        abort_if(Gate::denies('bussiness_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.bussiness.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBussinessRequest $request, BussinessCategory $user)
    {
        $user->update(array_filter($request->validated()));
        return redirect()->route('admin.bussinesscategory.index')->with(['status-success' => "Bussiness Category Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BussinessCategory $user)
    {
        abort_if(Gate::denies('bussiness_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "Bussiness Category Deleted"]);
    }

    public function toggleStatus(Request $request)
    {
        $user = BussinessCategory::find($request->BusinessCategoryID); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => true, 'status' => $user->status]);
        }

        return response()->json(['success' => false, 'message' => 'User not found']);
    }
}
