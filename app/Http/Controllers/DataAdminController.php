<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataAdmins = DataAdmin::with('user')->get();

        return view('admin.data-admins.index', compact('dataAdmins'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.data-admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'contact' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'nuptk' => 'nullable|string|max:255',
            'nip' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the User
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the user the 'admin' role
        $user->assignRole('admin');

        // Create the DataAdmin associated with the User
        DataAdmin::create([
            'user_id' => $user->id,
            'contact' => $request->contact,
            'address' => $request->address,
            'nuptk' => $request->nuptk,
            'nip' => $request->nip,
        ]);

        return redirect()->route('admin.data-admins.index')->with('success', 'Admin created successfully.');
    }


    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        // Retrieve the admin data by its ID
        $admin = DataAdmin::findOrFail($id);

        // Pass the admin data to the view
        return view('admin.data-admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $dataAdmin = DataAdmin::findOrFail($id);
        $user = $dataAdmin->user;

        return view('admin.data-admins.edit', compact('dataAdmin', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $dataAdmin = DataAdmin::findOrFail($id);
    $user = $dataAdmin->user;

    $validatedData = $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
        'contact' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'nuptk' => 'required|string|max:255',
        'nip' => 'required|string|max:255',
    ]);

    // Update the user
    $user->update([
        'username' => $validatedData['username'],
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
    ]);

    if ($request->filled('password')) {
        $user->update(['password' => Hash::make($validatedData['password'])]);
    }

    // Update the DataAdmin
    $dataAdmin->update([
        'contact' => $validatedData['contact'],
        'address' => $validatedData['address'],
        'nuptk' => $validatedData['nuptk'],
        'nip' => $validatedData['nip'],
    ]);

    return redirect()->route('admin.data-admins.index')->with('success', 'Admin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         $admin = DataAdmin::findOrFail($id);

         // Optionally, delete the associated user
         $user = User::find($admin->user_id);
         if ($user) {
             $user->delete();
         }

         // Delete the admin record
         $admin->delete();

         return redirect()->route('admin.data-admins.index')->with('success', 'Admin deleted successfully.');
     }
}
