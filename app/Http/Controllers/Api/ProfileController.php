<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // LIST PROFILE (USER LOGIN)
    public function show(Request $request)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data profile berhasil diambil',
            'data' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email'
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Profile berhasil diperbarui',
        'data' => $user
    ]);
}

}