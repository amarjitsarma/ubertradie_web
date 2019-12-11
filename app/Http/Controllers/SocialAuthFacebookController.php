<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use Session;
use Sentinel;

class SocialAuthFacebookController extends Controller
{
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialFacebookAccountService $service){
        //dd($user);
       	$user = $service->createOrGetUser(Socialite::driver('facebook')->user());
       	//dd($user);

       	if(Sentinel::login($user, true)){
		    return redirect('/');
        }else{
            return 'facebook login failed!';
        }
    }

}
