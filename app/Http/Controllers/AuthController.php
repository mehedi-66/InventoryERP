<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{
    public function registerForm()
    {
        $user = new User();
        $data = compact('user');
     return view('auth.register')->with($data);
    }

    // Register Post request
    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]
        );

        $user = new User();

        $user->name = $request['name'];  
        $user->email = $request['email'];  
        $user->password = Hash::make($request['password']);  
       
       $res =  $user->save();
       if($res)
       {
            // If successful then redirect to login page
           return redirect('/login');
           
       }else{
            return back()->with('fail', 'Registration failed');
       }

    }

    public function loginForm()
    {
        $user = new User();
        $data = compact('user');
     return view('auth.login')->with($data);
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

    
        $user = User::where('email', $request->email)->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $request->session()->put('loginId', $user->email);
                $request->session()->put('loginRole', $user->name);
                return redirect('/dashboard');
            }
            else{

                return back()->with('fail', 'Email or password is incorrect');
            }
            
        }else{
             return back()->with('fail', 'Email or password is incorrect');
        }
        // Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    }
    public function logout()
    {
        if(Session::has('loginId'))
        {
            Session::pull('loginId');
            Session::pull('loginRole');
        }
        return redirect('/login');
    }
    
}
