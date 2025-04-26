<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class AdminController extends Controller
{
    //
 
    public function getAllUsers(Request $request)
    {
        // Logic to get all users
        $users = User::where('isAdmin', false)->where('is_main_admin',false)->get();
        return response()->json($users);
    }
    public function banUser(Request $request)
    {
        // Logic to ban a user
        $user = User::find($request->input('userId'));
        if ($user) {
            // Check if the user is admin or main admin
            if ($user->isAdmin || $user->is_main_admin) {
                return response()->json(['message' => 'Cannot ban an admin user'], 403);
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
        $user = User::find($request->input('userId'));
        if ($user) {
            if ($user->isAdmin || $user->is_main_admin) {
                return response()->json(['message' => 'Cannot unban an admin user'], 403);
            }
            $user->is_Banned = false;
            $user->save();
            return response()->json(['message' => 'User unbanned successfully']);
        }
        return response()->json(['message' => 'User not found'], 404);
    }
  
}
