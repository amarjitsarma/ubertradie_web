<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Reminder;
use Mail;
use Sentinel;

class ForgotPasswordController extends Controller
{

    public function postForgotPassword(Request $request){
    	$user =  User::whereEmail($request->email)->first();

    	if(!$user){
    		return redirect()
    					->route('login')
    					->with('message', 'Reset link is sent to your email!');
    	}

    	$reminder = Reminder::exists($user) ?: Reminder::create($user);
    	$this->sendEmail($user, $reminder->code);

    	return redirect()
					->route('login')
					->with('message', 'Reset link is sent to your email!');
    }

    public function resetPassword($email, $resetCode){
    	$user = User::byEmail($email);

    	if(count($user) == 0){
    		abort(404);
    	}
    	

    	if($reminder = Reminder::exists($user)){
    		if($resetCode == $reminder->code){
    			return view('authentication.reset-password');
    		}else{
    			return redirect()
    					->route('login');
    		}
    	}else{
    		return redirect()
    				->route('login');
    	}
    }

    public function postResetPassword(Request $request, $email, $resetCode){
    	$this->validate($request, [
    		'password'				=> 'confirmed|required|min:5',
    		'password_confirmation'	=> 'required|min:5',
    	]);
    	$user = User::byEmail($email);

    	if(count($user) == 0){
    		abort(404);
    	}
    	

    	if($reminder = Reminder::exists($user)){
    		if($resetCode == $reminder->code){
    			Reminder::complete($user, $resetCode, $request->password);
    			return redirect()->route('login')->with('message', 'Please login with your new password');
    		}else{
    			return redirect()
    					->route('login');
    		}
    	}else{
    		return redirect()
    				->route('login');
    	}
    }

    private function sendEmail($user, $code){
    	Mail::send('emails.forgot-password', [
    		'user'	=> $user,
    		'code'	=> $code,
    	], function($message) use ($user){
    		$message->to($user->email);
    		$message->subject("Hello $user->first_name, reset your password.");
    	});
    }
}
