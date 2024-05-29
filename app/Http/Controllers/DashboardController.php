<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $breadcrumbs = Breadcrumbs::generate();

        // Pass breadcrumbs data to the view
        return view('layouts.dashboard', compact('breadcrumbs'));
    }
}
