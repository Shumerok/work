<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Position;
use Illuminate\Http\Request;

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
        $employees = Employer::all()->count();
        $positions = Position::all()->count();
        return view('index', compact('employees','positions'));
    }
}
