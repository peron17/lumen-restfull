<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        try {
            
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            if ($model = User::create($data))
                return response()->json(['user' => $model, 'message' => 'User created'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed'], 409);
        }
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (!$token = Auth::attempt(['email'=>$request->email, 'password'=>$request->password])) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        return response()->json(['Successfully logout'], 200);
    }

    /**
     * Refresh token.
     * for get new token when old token expired
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    
    /**
     * Profile
     */
    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }
}