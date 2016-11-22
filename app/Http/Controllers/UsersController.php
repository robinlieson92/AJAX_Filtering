<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Session;
use App\Http\Requests\UserRequest;


class UsersController extends Controller
{
    public function signup()
  	{
    	return view('users.signup');
  	}
  	public function signup_store(UserRequest $request)
  	{
	    //// below code will register and automatic activate account user
	    //Sentinel::register($request, true);
	    //// or
      $writerrole = Sentinel::findRoleByName('Writer');
	    Sentinel::registerAndActivate($request->all())
        ->roles()->attach($writerrole);
	    Session::flash('notice', 'Success create new user');
	    return redirect()->back();
  	}

}
