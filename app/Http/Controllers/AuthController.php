<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            $msg = [
                'status' => 0,
                'msg' => 'Error'
            ];
        } else {
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            $msg = [
                'status' => 1,
                'access_token' => $token,
                'name' => $user->name,
                'role' => $user->role->name
            ];
        }
        return response()->json($msg);
    }

    public function profile()
    {
        return response()->json([
            'status' => 1,
            'user' => auth()->user()
        ]);
    }

    /**
     * admin register a user
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user = new User();
        $user->role_id = 2;
        $user->active = true;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->name.'123');
        $success = $user->save();
        return response()->json([
            'status' => 1,
            'success' => $success
        ]);
    }

    /**
     * destroy token
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 1,
            'msg' => 'logout'
        ]);
    }
}
