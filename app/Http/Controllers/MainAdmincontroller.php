<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class MainAdmincontroller extends Controller
{
    //
    public function getAllUsers(Request $request)
    {
        // Logic to get all users
        $users = User::where('is_main_admin',false)->get();
        return response()->json($users);
    }
    public function banUser(Request $request)
    {
        // Logic to ban a user
        $user = User::find($request->input('userId'));
        if ($user) {
            // Check if the user is admin or main admin
            if ($user->IsMainAdmin) {
                return response()->json(['message' => 'Cannot ban an Mainadmin user'], 403);
            }
            $user->is_Banned = true;
            $user->save();
            return response()->json(['message' => 'User banned successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
    public function unbanUser(Request $request)
    {
        // Logic to unban a user
        // return $request->user();
        $user = User::find($request->input('userId'));
        if ($user) {
            if ($user->IsMainAdmin) {
                return response()->json(['message' => 'Cannot unban an main admin user'], 403);
            }
            $user->is_Banned = false;
            $user->save();
            return response()->json(['message' => 'User unbanned successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
    public function createAdmin(Request $request)
    {
        // Logic to create an admin user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'isAdmin' => true,
        ]);
        return response()->json($user, 201);
    }
}
