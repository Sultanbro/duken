<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Traits\Api\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;
    /**
     * @param RegisterRequest $registerRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(RegisterRequest $registerRequest)
    {
        try {

            $user = User::create([
                'name' => $registerRequest->name,
                'email' => $registerRequest->email,
                'password' => Hash::make($registerRequest->password)
            ]);

            return $this->successResponse(['token' => $user->createToken("API TOKEN")->plainTextToken]);

        } catch (\Throwable $th) {
            return $this->errorResponse(null, $th->getMessage(), 500);
        }
    }

    /**
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(LoginRequest $loginRequest)
    {
        try {

            if(!Auth::attempt($loginRequest->only(['email', 'password']))){
                return $this->errorResponse(
                    'Email & Password does not match with our record.', null, 401);
            }

            $user = User::where('email', $loginRequest->email)->first();

            return $this->successResponse(
                ['token' => $user->createToken("API TOKEN")->plainTextToken],
                'User Logged In Successfully', 200);

        } catch (\Throwable $th) {
            return $this->errorResponse(null, $th->getMessage(), 500);

        }
    }
}
