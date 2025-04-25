<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //
    public function register(Request $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return response()->json($user, 201);
    }

    public function login(Request $request){ 
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
           $user =$request->user();
        //    if (!$user instanceof User) {
        //       throw new \RuntimeException('Authenticated user is not a User model.');
        //    }
            $token = $user ->createToken("auth-token")->plainTextToken;    
            return response()->json($token, 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }   

    }

    public function logout(Request $request){
        // $user =$request->user();
         $user =auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }
            $user->tokens()->delete();
            return response()->json(['message' => 'Logged out successfully'], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

   public function addOrUpdatePersonalData(Request $request){
        $user = auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }

            $personalData = $user->personalData;
            if ($personalData) {
                $personalData->update($request->all());
                return response()->json($personalData, 200);
            } else {
                
                $personalData = $user->personalData()->create($request->all());
                  return response()->json($personalData, 201);
            }
            
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public  function getPersonalData(Request $request){
        $user = auth()->user();
        if ($user) {
            // if(!$user instanceof User) {
            //     throw new \RuntimeException('Authenticated user is not a User model.');
            // }
            $personalData = $user->personalData;
            return response()->json($personalData, 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }   

    // public function updatePersonalData(Request $request, $id){
    //     $user = auth()->user();
    //     if ($user) {
    //         // if(!$user instanceof User) {
    //         //     throw new \RuntimeException('Authenticated user is not a User model.');
    //         // }
    //         $personalData = $user->personalData()->find($id);
    //         if ($personalData) {
    //             $personalData->update($request->all());
    //             return response()->json($personalData, 200);
    //         } else {
    //             return response()->json(['error' => 'Personal data not found'], 404);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Unauthorized'], 401);
    //     }
    // }   

}
