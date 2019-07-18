<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use DB;
use App\User;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function getLogin(){
    	return view('authentication.login');
    }

    protected function check_captcha($user_response){
        $fields_string = '';
        $fields = array(
            'secret' => '6LfJfikUAAAAAFTmyhKKipZRpHNVthkD7z9csV2B',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // public function redirectToProvider()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }

    // /**
    //  * Obtain the user information from GitHub.
    //  *
    //  * @return Response
    //  */
    // public function handleProviderCallback()
    // {
    //     $fbuser = Socialite::driver('facebook')->user();
    //     if(count(User::where('email' , '=', $fbuser->email)->get())==0){
    //         $userdata = ['email' => $fbuser->email, 'password' => 'allowme'];
    //         $user = Sentinel::registerAndActivate($userdata);

    //         $role = Sentinel::findRoleBySlug('client');
    //         $role->users()->attach($user);
    //     }
        

    //     $credentials = ([
    //                 'login'     => $fbuser->email,
    //                 'password'  => 'allowme',
    //             ]);

    //     if(Sentinel::authenticate($credentials)){
    //                 $slug = Sentinel::getUser()->roles()->first()->slug;
    //                 if(Sentinel::getUser()->status == 1){
    //                     if($slug == 'admin'){
    //                         return redirect('/admin')
    //                                 ->with('loginmessage', 'Ok');
    //                     }elseif($slug == 'client' ){
    //                          return redirect('/client')
    //                                 ->with('loginmessage', 'Ok');
    //                     }
    //                 }else{
    //                     Sentinel::logout();
    //                     return redirect()->route('login');
    //                 }
    //             }
    // }

    public function postLogin(Request $request){
        //dd($request->all());
        //$res = $this->check_captcha($request->g_recaptcha_response);

        //if($res['success']){
            try{
                $rememberMe = false;
                if($request->remember_me == 'true'){
                    $rememberMe = true;
                }
                $credentials = ([
                    'login'     => $request->email,
                    'password'  => $request->password,
                ]);

                if(Sentinel::authenticate($credentials, $rememberMe)){
                    $slug = Sentinel::getUser()->roles()->first()->slug;
                    if(Sentinel::getUser()->status == 1){
                        if($slug == 'admin'){
                            $request->session()->flash('loginmessage', 'You are successfully logged in to the system!');
                            return response()->json(['redirect'=> 'Dashboard']);
                        }elseif($slug == 'user'){
                             $request->session()->flash('loginmessage', 'You are successfully logged in to the system!');
                            return response()->json(['redirect'=> 'Dashboard']);
                        }
                    }else{
                        Sentinel::logout();
                        return response()
                                ->json(['failed'=>'You are blocked from accessing this system!'], 500);
                    }
                }else{
                    return response()
                                ->json(['failed'=>'User credentials provided are wrong!'], 500);
                }
            }catch(ThrottlingException $e){
                $delay = $e->getDelay();
                return response()
                            ->json(['failed'=>"Your account is banned for $delay seconds for suspicious activities!"], 500);
            }catch (NotActivatedException $e){
                return response()
                            ->json(['failed'=>'Account Not Activated!'], 500);
            }
        // }else{
        //     return response()
        //              ->json(['error_message'=>'Please verify you are a human not a robot by selecting the reCaptcha!'], 500);
        // }
    }

    public function logout(){
    	Sentinel::logout();
         return redirect()->route("login")->with('message', 'You have successfully logged out of the system!');
    }
}
