<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    //  public function __construct()
    // {
    //      $this->middleware('auth', ['except' => ['index']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try{
        $user = User::orderBy('created_at', 'desc')->paginate(100);
            if($user){                
                return response()->json(['users' => $user,]);
            }
        }
        catch(\Exception $e){
        return response()->json(['error' => 'Something went wrong!', 'status' => false], 409);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string|min:4|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        
           try {
            $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->save();
            return response()->json(['user' => $user, 'message' => 'Account created successfully', 'status' => true], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Account Registration Failed!', 'status' => false], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user)  return response()->json(['error' => 'Not record found!', 'status' => false], 404);
        return response()->json(['user' => $user, 'status' => true], 200);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try{
            $user = User::findOrFail($id);
            $user->delete();
            if($user){                
                return response()->json(['user' => $user, 'message'=> 
                'Account deleted successfully', 'status' => true], 200);  
            } else {
                 return response()->json(['message'=> 
                'Not found', 'status' => true], 200);  
            }
        }
        catch(\Exception $e){
            return response()->json(['error' => 'Something went wrong!', 'status' => false], 500);

        }
    }
    // Lign
        public function login(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Username or Password is in valid'], 401);
        }
        return $this->respondWithToken($token);
    }
}
