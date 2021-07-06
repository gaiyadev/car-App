<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
     public function __construct()
    {
        //  $this->middleware('auth', ['except' => ['index']]);
         $this->middleware('auth');

    }

    // Get current Login user
        public function currentLogin() {
        $auth = Auth::user()->id;
        $user = User::find($auth);
        if(!$user)  return response()->json(['message' => 'No record found!', 'status' => false], 404);
        return response()->json(['news' => $user, 'status' => true], 200); 
    }

    //   Change Password
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'comfirmPassword' => 'required|min:6|same:newPassword',
        ]);
                   
        $id = Auth::user()->id;
        $hashPassword = Auth::user()->password;
        if(!Hash::check($request->password, $hashPassword)) {
            return response()->json(['error' => 'Current Password is invalid', 'status' => false], 409);
        }
        if(Hash::check($request->newPassword, $hashPassword)) {
            return response()->json(['error' => 'Current Password cannot be the same with new password', 'status' => false], 409);
        }
         try {
            $user = User::find($id);
            $plainPassword = $request->input('newPassword');
            $user->password = app('hash')->make($plainPassword);
         $user->save();
            return response()->json(['user' => $user, 'message' => 'Password changed successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 409);
        }

    }
        // Update profile
        public function updateDetails(Request $request)
        { 
            $id = Auth::user()->id;
            $this->validate($request, [
            'username' => 'required|string|alpha|min:4',
            'email' => 'required|max:191|email|unique:users,email,' .$id,
        ]);
            
            $id = Auth::user()->id;
            try {
            $user = User::find($id);
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->save();
            return response()->json(['user' => $user, 'message' => 'Profile changed successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong!', 'status' => false], 409);
    }
}
}
