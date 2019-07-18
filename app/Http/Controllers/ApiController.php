<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use DB;
use App\User;
use Laravel\Socialite\Facades\Socialite;

class ApiController extends Controller
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

    public function postLogin(Request $request){
		$User=DB::table("users")->where("username",$request["username"])->where("password",bcrypt($request['password']))->first();
		$Error=0;
		if($User)
		{
			DB::table("user_login")->where("DeviceID",$request["DeviceID"])->update(array("Status"=>0));
			DB::table("user_login")->insert(array("DeviceID"=>$request["DeviceID"],"UserID"=>$User["id"],"Status"=>1));
			$Error=1;
			
		}
		return response()->json(["Error"=>$Error,"User"=>$User]);
    }
	public function Signup(Request $request)
	{
        $User=DB::table("users")->where("phone",$request["phone"])->orwhere("email",$request["email"])->orwhere("username",$request["username"])->get();
		if(sizeof($User)==0)
		{
			$user= new User();
			$user->first_name= $request['firstname'];
			$user->last_name= $request['lastname'];
			$user->phone= $request['phone'];
			$user->email= $request['email'];
			$user->username= $request['username'];
			$user->password= bcrypt($request['password']);
			$user->save();
			return response()->json(['status'=>1,"message"=>"Successfully registered"]);
		}
		else{
			return response()->json(['status'=>0,"message"=>"User already exist."]);
		}
	}
    public function Logout(Request $request){
    	
    }
	public function CheckLogin(Request $request)
	{
		$Login=DB::table("user_login")->where("DeviceID",$request["DeviceID"])->where("Status",1)->first();
		if($Login)
		{
			$User=DB::table("users")->where("id",$Login->UserID)->first();
			return response()->json(["Status"=>1,"User"=>$User]);
		}
		else
		{
			return response()->json(["Status"=>0]);
		}
	}
}
