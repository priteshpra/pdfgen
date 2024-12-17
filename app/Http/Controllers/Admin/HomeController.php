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
        $cas = User::where(['users.Status' => '1', 'UserType' => '4'])->count();
        $documents = Scandocument::where(['Status' => '1'])->count();
        $employeeLists = User::with('role')->where('UserType', '2')->orderBy('id', 'desc')->limit('5')->get();
        $clientLists = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->leftJoin('scanned_documents', 'users.id', '=', 'scanned_documents.UserID')->with('role')->where('users.UserType', '3')->orderBy('users.id', 'desc')->limit('5')->get();
        $casList = User::leftJoin('company', 'users.CompanyID', '=', 'company.CompanyID')->leftJoin('scanned_documents', 'users.id', '=', 'scanned_documents.UserID')->where('users.UserType', '4')->orderBy('users.id', 'desc')->limit('5')->get();
        return view('admin.home', compact('employee', 'clients', 'cas', 'documents', 'employeeLists', 'clientLists', 'casList'));
    }
}
