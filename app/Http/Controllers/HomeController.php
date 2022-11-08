<?php

namespace App\Http\Controllers;

use App\EffectedPoint;
use App\Events\broadcastHouseHoldVisits;
use App\Events\notifyPatient;
use App\Exports\PatientExport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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

    public function blocked()
    {
        return view('layouts.blockedpage');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {

        if (auth()->User()->isAdmin()) {
            return redirect('/development');
        } elseif (auth()->User()->isPlaning()) {
            return redirect('/planning');
        } else {
            return view('layouts.blockedpage');
        }
    }

    public function planning()
    {
        return view('planning');
    }

    public function user()
    {
        return view('add_users');
    }

    public function addDetails()
    {
        return view('AddDetails');
    }
}
