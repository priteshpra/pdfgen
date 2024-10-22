<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CmaRequest;
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
use App\Models\Cms;
use App\Models\Page;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('cms_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $page = Page::where('Status', '1')->get()->toArray();
        $pages = [];
        foreach ($page as $key => $value) {
            $pages[$value['PageID']][] = $value;
        }
        $users = Cms::with('role')->paginate(25)->appends($request->query());
        return view('admin.cms.index', compact('users', 'pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('cms_create'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        $country = Country::all();
        $page = Page::where('Status', '1')->get();
        return view('admin.cms.create', compact('roles', 'country', 'page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CmaRequest $request)
    {
        Cms::create($request->validated());
        return redirect()->route('admin.cms.index')->with(['status-success' => "New State Created"]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Cms $user)
    {
        abort_if(Gate::denies('cms_show'), Response::HTTP_FORBIDDEN, 'Forbidden');

        return view('admin.cms.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cms $user, $id)
    {
        $user = Cms::where(['CMSID' => $id])->first();
        abort_if(Gate::denies('cms_edit'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $roles = Role::pluck('title', 'id');
        $country = Country::all();
        $page = Page::where('Status', '1')->get();
        return view('admin.cms.edit', compact('user', 'roles', 'page'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, Cms $user)
    {
        $user->update(array_filter($request->validated()));
        return redirect()->route('admin.cms.index')->with(['status-success' => "State Updated"]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cms $user)
    {
        abort_if(Gate::denies('cms_delete'), Response::HTTP_FORBIDDEN, 'Forbidden');

        $user->delete();
        return redirect()->back()->with(['status-success' => "State Deleted"]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        if ($search != '') {
            $services = Cms::where('State', 'like', '%' . $search . '%')->paginate(25);
            $services->appends(array('search' => Input::get('search'),));
            if (count($services) > 0) {
                return view('admin.cms.index', ['users' => $services]);
            }
            return back()->with('error', 'No results Found');
        }
    }

    public function toggleStatus(Request $request)
    {
        $user = Cms::find($request->CMSID); // Get the user by ID
        if ($user) {
            $user->Status = $request->Status; // Toggle status
            $user->save(); // Save the updated status

            return response()->json(['success' => true, 'status' => $user->status]);
        }

        return response()->json(['success' => false, 'message' => 'User not found']);
    }
}
