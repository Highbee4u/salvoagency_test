<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Hash;
use App\Http\Requests\Auth\UserLoginFormRequest;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
   public function login(UserLoginFormRequest $request){
        
        $validatedData = $request->validated();
        
        if (Auth::attempt($validatedData)) {
            return redirect()->intended('posts')
                        ->withSuccess('You have Successfully loggedin');
        }

        return redirect("/")->with('error','Oppes! You have entered invalid credentials');
   }

   public function logout()
    {
        Session::flush();
        Auth::logout();
  
        return redirect()->route('home');
    }
}
