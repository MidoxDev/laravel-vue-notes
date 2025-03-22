<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // User registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json(["error"=>$validator->errors()->toJson()], 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }

    //update info
    public function update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = Auth::user()->update([
            'name' => $request->get('name'),
            'email' => $request->get('email')
        ]);

        $current_password=$request->password;
        $new_password= $request->new_password;

        if ($current_password!='' && $new_password!= '') {

            $validator = validator([
                $current_password =>'required|string|min:6',
                $new_password   => 'required|string|min:6'
            ]);

            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }

            if (Hash::check($current_password,Auth::user()->password)) {
                Auth::user()->update([
                    'password' => Hash::make($new_password),
                ]);
            }else
                return response()->json("Current password doesn't match", 400);

        }

        return response()->json(['message'=>'User updated successfuly',compact('user')], 200);
    }

    function changePassword($current_password,$new_password) {




        /*

         */
        /* if (Hash::make($current_password)===Auth::user()->password) {
            return response()->json( $current_password,400);
           /*  Auth::user()->update([
                'password' => Hash::make($new_password),
            ]);
         }else
            return response()->json("Current password doesn't match", 400); */


    }

    // User login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Get the authenticated user.
            $user = auth()->user();

            // (optional) Attach the role to the token.
            $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);

            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    // Get authenticated user
    public function getUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    // User logout
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }
}
