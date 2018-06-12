<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use TwigBridge\Facade\Twig;

class FAQAuthController extends Controller
{


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
   
    public function authenticate(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $rules = array(
    'name'  => 'required|max:60',
    'password' => 'required',
     );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
         {
         return redirect()->route('auth')->withErrors($validation->messages());
         } else {

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin');
        } else {return redirect()->route('auth');}
     }
    
    }

    public function login()
    {
        return Twig::render('auth');
    }
    

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('user'); 
        }
        
    }

}
