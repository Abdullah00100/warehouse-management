<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends ApiController
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error(
                'incorrect password',
                'The password you entered is incorrect.',
                403
            );
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        PersonalAccessToken::where('tokenable_type', User::class)
            ->where('tokenable_id', $user->id)
            ->get();
        $response = [
            'success' => true,
            'user' => new UserResource($user),
            'token' => $token
        ];
        return $this->success($response, 200, 'You are logged in successfully');
    }
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = 4;

        $user = User::create($data);

        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'success' => true,
            'customer' => new UserResource($user),
            'token' => $token
        ];
        return $this->success($response, 200, 'You are logged in successfully');
    }
    public function reset_password(ResetPasswordRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = auth('sanctum')->user();
        $user->update($data);
        $current_token = auth('sanctum')->user()->tokens->first()->id;
        $user->tokens()->whereNot('id', $current_token)->where('tokenable_id', '=', $user->id)->delete();
        $response = [
            'success' => true,
            'customer' => new UserResource($user),
            'token' => $request->bearerToken()
        ];
        return $this->success($response, 200, 'Password changed successfully');
    }
    public function logout()
    {
        $user = auth('sanctum')->user();
        $current_token = auth('sanctum')->user()->tokens->first()->id;
        $user->tokens()->where('id', $current_token)->delete();
        return $this->responseDelete('logout successfully', 200);
    }
}
