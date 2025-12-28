<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=User::all();
        return response()->json([
            'message'=>'success',
            'data'=>$user
        ]);
    }

    /**
     * Store a newly created resource in storage.
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
        'avatar'    => 'nullable|string|max:255',
        'password'  => 'required|string|min:6',
        'status'    => 'required|in:active,inactive',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json([
            'message' => 'Insert success',
            'data' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
