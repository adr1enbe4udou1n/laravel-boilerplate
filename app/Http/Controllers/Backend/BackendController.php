<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.home');
    }
}
