<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DataAdmin;
use Illuminate\Http\Request;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $dataAdmins = DataAdmin::all();
        $dataAdmins = DataAdmin::paginate(10);

        return view('admin.dataAdmins.index', compact('dataAdmins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.dataAdmins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DataAdmin $dataAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataAdmin $dataAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataAdmin $dataAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataAdmin $dataAdmin)
    {
        //
    }
}
