<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; // Or App\User if using older structure
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use Jrean\UserVerification\Facades\UserVerification;
use App\Http\Requests\Front\UserFrontRegisterFormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class RegisterController extends Controller
{
    

    public function CandidateRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:80',
            'last_name' => 'required|max:80',
            'email' => 'required|unique:users,email|email|max:100',
            'mobile_num' => 'required',
            'password' => 'required|confirmed|min:6|max:50',
            'terms_of_use' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        log::info("entry");
        try {
            Log::channel('api')->info("Attempting registration", $request->except('password'));

            $user = new User();
            $user->first_name = $request->input('first_name');
            // $user->middle_name = $request->input('middle_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->mobile_num = $request->input('mobile_num');
            $user->password = bcrypt($request->input('password'));
            $user->is_active = 0;
            $user->verified = 0;

            if (!$user->save()) {
                throw new \Exception('Failed to save user');
            }

            $user->name = $user->getName();
            if (!$user->update()) {
                throw new \Exception('Failed to update user name');
            }

            event(new Registered($user));
            event(new UserRegistered($user));

            $this->guard()->login($user);

            UserVerification::generate($user);
            UserVerification::send(
                $user,
                'User Verification',
                config('mail.recieve_to.address'),
                config('mail.recieve_to.name')
            );

            return response()->json([
                'status' => 'success',
                'message' => 'User registered and logged in successfully. Verification email sent.',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ], 201);
        } catch (QueryException $e) {
            Log::channel('api')->error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status'=> 'error',
                'message' => 'Registration failed: Email already exists or data conflict.',
                'error' => $e->getMessage(),
            ], 409);
        } catch (\Exception $e) {
            Log::channel('api')->error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json([
                'status'=> 'error',
                'message' => 'Registration failed: Unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
