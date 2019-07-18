<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Client;
use App\User;

class RegistrationController extends Controller
{
   public function getRegister(){
   		return view('authentication.register');
   }

   public function postRegister(Request $request){
      
   		$this->validate($request, [
   			'username'	=> 'unique:users',
   			'email'		=> 'unique:users',
   		]);
   		$user = Sentinel::registerAndActivate($request->all());

   		$role = Sentinel::findRoleBySlug('admin');
   		$role->users()->attach($user);

   		return redirect()
                     ->route('login')
                     ->with('message', 'Account created, you can login now!');
   }
}
