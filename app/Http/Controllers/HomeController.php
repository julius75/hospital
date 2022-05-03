<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function home()
    {
        return view('home');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return redirect(auth()->user()->department);
    }
    public function department()
    {
        return  response(auth()->user()->department);
    }
}
