<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserPhotoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('page_access'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $users = Page::paginate(25)->appends($request->query());
        // dd($users);
        return view('admin.page.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('page_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.page.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        Page::create($request->validated());
        return redirect()->route('admin.page.index')->with(['status-success' => "New Country Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Page $user)
    {
        abort_if(Gate::denies('page_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.page.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $user, $id)
    {
        $user = Page::where(['PageID' => $id])->first();
        abort_if(Gate::denies('page_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        return view('admin.page.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Page $user)
    {
        $user->update(array_filter($request->validated()));
        return redirect()->route('admin.page.index')->with(['status-success' => "Country Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $user)
    {
        abort_if(Gate::denies('page_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "Country Deleted"]);
    }

    public function toggleStatus(Request $request)
    {
        $user = Page::find($request->PageID); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => true, 'status' => $user->status]);
        }

        return response()->json(['success' => false, 'message' => 'User not found']);
    }
}
