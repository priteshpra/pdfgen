<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scandocument;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employee = User::where(['Status' => '1', 'UserType' => '2'])->count();
        $clients = User::where(['Status' => '1', 'UserType' => '3'])->count();
        $cas = User::where(['Status' => '1', 'UserType' => '4'])->count();
        $documents = Scandocument::where(['Status' => '1'])->count();
        $employeeLists = User::with('role')->where('UserType', '2')->orderBy('id', 'desc')->limit('5')->get();
        $clientLists = User::with('role')->where('UserType', '3')->orderBy('id', 'desc')->limit('5')->get();
        $casList = User::where('UserType', '4')->orderBy('id', 'desc')->limit('5')->get();
        return view('admin.home', compact('employee', 'clients', 'cas', 'documents', 'employeeLists', 'clientLists', 'casList'));
    }
}
