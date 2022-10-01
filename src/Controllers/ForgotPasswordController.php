<?php

namespace Normanize\Authentication\Controllers;

use Normanize\Authentication\Requests\ResetPasswordStoreRequest;
use Normanize\Authentication\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class ForgotPasswordController extends Controller
{
    /**
     * This method will handle 
     * app forgot password
     */
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $exists = User::where('email', $request->email)->exists();

            if (!$exists) {
                return response()->json([
                        'message' => 'The email address does not exist.',
                    ], 400);
            }

            $reset = DB::table('password_resets')
                ->where('email', $request->only('email'));
    
            if ($reset->exists()) {
                $reset->delete();
            }

            $response = Password::sendResetLink(
                    $request->only('email')
                );

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return response()->json([
                            "message" => trans($response)
                        ]);
                case Password::INVALID_USER:
                    return response()->json([
                            "message" => trans($response)
                        ], 400);
            }
        } catch(\Exception $e) {
            return response()->json([
                    'error' => $e->getMessage()
                ], 500);
        }
    }

    /**
     * This method will handle 
     * app reset password
     */
    public function resetPassword(ResetPasswordStoreRequest $request)
    {
        try {
            $reset = Password::reset($request->all(), function ($user, $password) {
                    $user->password = $password;
                    $user->save();
                });

            if ($reset == Password::INVALID_TOKEN) {
                return response()->json([
                        "message" => "Invalid token provided."
                    ], 400);
            }

            return response()->json([
                    "message" => "Password has been successfully changed."
            ]);
        } catch(\Exception $e) {
            return response()->json([
                    'error' => $e->getMessage()
                ], 500);
        }
    }
}
