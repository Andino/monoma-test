<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use App\Http\Resources\GeneralResponseResource;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if(!$user){
                return $this->createResponse($e, 'Token is invalid');
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->createResponse($e, 'Token is Invalid');
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->createResponse($e, 'Token is Expired');
            }else{
                return $this->createResponse($e, 'Authorization Token not found');
            }
        }
        return $next($request);
    }

    private function createResponse(Exception $e, $message){
        $response = [
            "success" => false,
            "errors" => [$message],
            "data"=> []
        ];
        $response_resource = new GeneralResponseResource($response);
        return $response_resource
        ->response()
        ->setStatusCode(401);
    }
}
