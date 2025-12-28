<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
class RoleController extends Controller
{
    public function index()
    {
        $users = User::all();
    $roles = Role::all(); // fetch all roles
    return view('components.users', compact('users', 'roles'));// Create roles.index Blade for managing roles
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        return view('roles.create'); // optional if you want separate form page
    }

    /**
     * Store a newly created role.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        Role::create($validated);

        return redirect()->back()->with('success', 'Role created successfully.');
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.edit', compact('role')); // optional
    }

    /**
     * Update the specified role.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $role->update($validated);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified role.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->back()->with('success', 'Role deleted successfully.');
    }
}
