<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class SessionController extends Controller
{

	/**
	 * Login 
	 */

    public function login()
    {
    	return view('session.signin');
    }


    /**
     * Login Submit Action
     */

    public function loginPost(LoginPostRequest $request)
    {
    	$values = $request->validated();

    	if ( Auth::attempt(['email' => $values['email'], 'password' => $values['password']]) ) 
    	{
    		return redirect()->route('dashboard');
    	}
        else
        {
            $errors = new MessageBag(['password' => ['Your login has failed.']]);
            return redirect()->route('login')->withErrors($errors);
        }

    }
}
