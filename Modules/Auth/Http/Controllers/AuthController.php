<?php

namespace Modules\Auth\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Tenant\Models\Tenant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Modules\Auth\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest  $request)
    {

        DB::beginTransaction();


        $tenant = Tenant::create([
            'name' => $request->input('tenant_name'),
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'tenant_id' => $tenant->id,
        ]);

        $user->assignRole('admin');

        event(new Registered($user));
        $token = $user->createToken('access_token');
        DB::commit();
        return response()->json([
            'access_token' => $token->plainTextToken,
        ]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => trans('auth.failed'),
            ], 401);
        }

        $token = $user->createToken('access_token');

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getRoleNames()->first(),
            ]
        ]);
    }

    public function userInfo(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            if (!$user) {
                return response()->json(['message' => 'User not authenticated'], 401);
            }

            $token = $user->currentAccessToken();

            if (!$token) {
                return response()->json(['message' => 'No valid access token found.'], 401);
            }

            $token->delete();

            return response()->json(['message' => 'Logged out successfully']);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }
}
