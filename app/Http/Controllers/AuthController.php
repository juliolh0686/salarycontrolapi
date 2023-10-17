<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
   public function createUser(Request $request)
   {
       try {
           //Validated
           $validateUser = Validator::make($request->all(),
           [
               'name' => 'required',
               'email' => 'required|email|unique:users,email',
               'password' => 'required'
           ]);

           if($validateUser->fails()){
               return response()->json([
                   'status' => false,
                   'message' => 'validation error',
                   'errors' => $validateUser->errors()
               ], 401);
           }

           $user = User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => Hash::make($request->password)
           ]);

           return response()->json([
               'status' => true,
               'message' => 'User Created Successfully',
               'token' => $user->createToken("API TOKEN")->plainTextToken
           ], 200);

       } catch (\Throwable $th) {
           return response()->json([
               'status' => false,
               'message' => $th->getMessage()
           ], 500);
       }
   }

   public function loginUser(Request $request)
   {
       try {
           $validateUser = Validator::make($request->all(),
           [
               'email' => 'required|email',
               'password' => 'required'
           ]);

           if($validateUser->fails()){
               return response()->json([
                   'status' => false,
                   'message' => 'validation error',
                   'errors' => $validateUser->errors()
               ], 401);
           }

           if(!Auth::attempt($request->only(['email', 'password']))){
               return response()->json([
                   'status' => false,
                   'message' => 'El correo electrónico y la contraseña no coinciden con nuestro registro.',
               ], 401);
           }

           $user = User::where('email', $request->email)->first();

           return response()->json([
               'status' => true,
               'message' => 'El usuario inició sesión correctamente',
               'token' => $user->createToken("API TOKEN")->plainTextToken,
               'user' => $user
           ], 200);

       } catch (\Throwable $th) {
           return response()->json([
               'status' => false,
               'message' => $th->getMessage()
           ], 500);
       }
   }

   public function logout() {

    auth()->user()->tokens()->delete();

    return [
      'message'=> 'Logout Satisfactorio'
    ];
  }
  
}
