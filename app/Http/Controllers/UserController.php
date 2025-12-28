<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
class UserController extends Controller
{/**
     * Display a listing of the users.
     */
    public function index(Request $request)
    {
        $query = User::query();

    // Optional search
    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('full_name', 'like', "%{$search}%")
              ->orWhere('username', 'like', "%{$search}%");
    }

    $users = $query->get();

    // Fetch roles for the Add User modal
    $roles = Role::all();

    // Pass users and roles to the Blade
    return view('components.users', compact('users', 'roles'));
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'username'  => 'required|string|max:100|unique:users,username',
        'email'     => 'required|email|unique:users,email',
        'phone'     => 'nullable|string|max:20',
        'gender'    => 'required|string|max:20',
        'role_id'   => 'required|integer|exists:roles,id',
        'avatar'    => 'nullable|image|max:2048',
        'password'  => 'required|string|min:6',
        'status'    => 'required|in:active,inactive',
    ]);

    $validated['password'] = Hash::make($validated['password']);
    $validated['status'] = $validated['status'] === 'active' ? 1 : 0;

    if ($request->hasFile('avatar')) {
        $file = $request->file('avatar');
        $path = $file->store('avatars', 'public');
        $validated['avatar'] = $path;
    }

    User::create($validated);

    return redirect()->back()->with('success', 'User created successfully.');
    }

    /**
     * Update an existing user.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'username'  => 'required|string|max:100|unique:users,username,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'phone'     => 'nullable|string|max:20',
            'gender'    => 'required|string|max:20',
            'role_id'   => 'required|integer|exists:roles,id',
            'avatar'    => 'nullable|image|max:2048',
            'password'  => 'nullable|string|min:6',
            'status'    => 'required|in:active,inactive',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['status'] = $validated['status'] === 'active' ? 1 : 0;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = $file->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    /**
     * Remove a user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Optionally delete avatar file if exists
        if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
            unlink(storage_path('app/public/' . $user->avatar));
        }

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
