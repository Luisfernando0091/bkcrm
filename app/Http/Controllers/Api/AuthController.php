<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Jefe;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $jefe = Jefe::where('email', $request->email)
            ->where('estado_registro', 1)
            ->first();

        if (!$jefe || !Hash::check($request->password, $jefe->password)) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'message' => 'Login correcto',
            'user' => $jefe
        ], 200);
    }
}
