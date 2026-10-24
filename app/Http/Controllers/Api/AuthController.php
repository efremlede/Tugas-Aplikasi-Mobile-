<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // <-- Tambahan untuk memanggil model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Tambahan untuk cek password

class AuthController extends Controller
{
    /**
     * Membuat Endpoint Login dan Token (API Sanctum)
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Buat token untuk user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ]);
    }
}