<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * Application Login
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $login = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if (Auth::attempt($login)) {
            $user = Auth::user();
            $createdToken = $user->createToken(config('auth.token_key'));

            return $this->responseInfo([
                'token' => [
                    'access' => $createdToken->accessToken,
                    'expires' => $createdToken->token->expires_at->format('Y-m-d H:i:s'),
                ],
                'user' => $user,
            ]);
        }

        return $this->responseError([
            'message' => trans('response.AuthController.login.error'),
            'errors' => [],
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Application logout.
     *
     * @param LogoutRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(LogoutRequest $request)
    {
        $user = $request->user('api');
        if (is_null($user)) {
            return $this->responseError([
                'message' => trans('response.AuthController.logout.error'),
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user->token()->revoke();

        return $this->responseSuccess([
            'message' => trans('response.AuthController.logout.success'),
        ]);
    }
}
