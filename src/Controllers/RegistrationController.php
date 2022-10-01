<?php

namespace Normanize\Authentication\Controllers;

use Normanize\Authentication\Requests\RegistrationStoreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use DB;

class RegistrationController extends Controller
{
    /**
     * This method will handle 
     * app registration
     */
    public function register(RegistrationStoreRequest $request)
    {
        DB::beginTransaction();

        try {
            // create user
            $createdUser = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
            
            DB::commit();

            return response()->json([
                    'message' => 'Successfully registered.',
                    'data' => $createdUser
                ], 202);
        } catch(\Exception $e) {
            DB::rollback();

            return response()->json([
                    'error' => $e->getMessage()
                ], 500);
        }
    }
}
