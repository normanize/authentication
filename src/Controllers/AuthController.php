<?php

namespace Normanize\Authentication\Controllers;

use Normanize\Authentication\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    /**
     * This method will handle 
     * app login
     */
    public function login(LoginRequest $request)
    {
        try {
            // find user
            $user = User::where('email', $request->email)->first();

            // confirm user & password
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                        'message' => 'Invalid email address or password.',
                    ], 401);
            }

            // create access token
            $token = $user->createToken('api')->accessToken;

            return response()->json([
                    'message' => 'Successfully logged in.',
                    'data' => [
                        'user' => $user,
                        'token' => $token
                    ]
                ]);
        } catch(\Exception $e) {
            return response()->json([
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    /**
     * This method will handle 
     * app logout
     */
    public function logout(Request $request) 
    {
        try {
            $request->user()
                ->tokens
                ->each(function ($token) {
                    $this->revokeAccessAndRefreshTokens($token->id);
                });

            return response()->json([
                    'message' => 'Logged out successfully.'
                ]);
        } catch(\Exception $e) {
            return response()->json([
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    protected function revokeAccessAndRefreshTokens($tokenId) 
    {
        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');

        $tokenRepository->revokeAccessToken($tokenId);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);
    }

}
