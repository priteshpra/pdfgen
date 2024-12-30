<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CmaRequest;
use App\Http\Requests\UpdateCMSRequest;
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
use App\Models\Notification;
use App\Models\Page;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('cms_access'), Response::HTTP_FORBIDDEN, 'Forbidden');
        $page = Notification::where('IsRead', '0')->orderBy('NotificationID', 'DESC')->get();
        return view('admin.notification.index', compact('page'));
    }
}
