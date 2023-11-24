<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\GeneralResponseResource;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    /**
     * Method that makes the credentials verification and token generation - Single Method Controller
     * @param LoginRequest $request
     * @return GeneralResponseResource
     */
    public function __invoke(LoginRequest $request)
    {
        try{
            $credentials = $request->only('username', 'password');
            $token = Auth::attempt($credentials);
            if (!$token) {
                throw ValidationException::withMessages([
                    "The credentials for: {$request->username} are incorrect"
                ])->status(401);
            }
    
            $user = Auth::user();
    
            $response = [
                "success" => true,
                "errors" => [],
                "data"=> [
                    'token' => $token,
                    'type' => 'bearer'
                ]
            ];
            return new GeneralResponseResource($response);
        } catch(ValidationException $error){
            $response = [
                "success" => false,
                "errors" => [$error->getMessage()],
                "data"=> []
            ];
            $response_resource = new GeneralResponseResource($response);
            return $response_resource
            ->response()
            ->setStatusCode($error->status);
        }
    }
}