<?php

namespace Modules\User\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\User\Http\Requests\UserRegisterRequest;

class UserController extends Controller
{
    public function registerUser(UserRegisterRequest $request)
    {
        $admin = auth()->user();

        if (!$admin->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tenant_id' => $admin->tenant_id,
        ]);

        $user->assignRole('user');

        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user
        ]);
    }
}
