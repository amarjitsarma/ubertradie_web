<?php
namespace App\Http\Controllers;
require './PHPMailer_5.2.1/src/Exception.php';
require './PHPMailer_5.2.1/src/PHPMailer.php';
require './PHPMailer_5.2.1/src/SMTP.php';
use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use DB;
use App\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\FlBasic;
use App\FlContact;
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
		$Error=1;
		$rememberMe = false;
        if($request->remember_me == 'true'){
            $rememberMe = true;
        }
		$credentials = ([
            'login'     => $request["username"],
            'password'  => $request['password'],
        ]);
		
		$User=null;
		if(Sentinel::authenticate($credentials, $rememberMe))
		{
			$User=Sentinel::getUser();
			if($User)
			{
				DB::table("user_login")->where("DeviceID",$request["DeviceID"])->delete();
				DB::table("user_login")->insert(array("DeviceID"=>$request["DeviceID"],"UserID"=>$User->id,"Status"=>1, "login_type"=>0));
				$Error=0;
				
			}
		}
		return response()->json(["Error"=>$Error,"User"=>$User,"Role"=>$User->roles->first()->name]);
    }
	public function UpdateLoginType(Request $request)
	{
		$Login=DB::table("user_login")->where("DeviceID",$request["DeviceID"])->where("Status",1)->first();
		DB::table("user_login")->where("DeviceID",$request["DeviceID"])->update(array("Status"=>0));
		DB::table("user_login")->insert(array("DeviceID"=>$request["DeviceID"],"UserID"=>$Login->UserID,"Status"=>1, "login_type"=>$request["LoginType"]));
		return response()->json(["Error"=>0,"Message"=>"Success"]);
	}
	public function Signup(Request $request)
	{
		$Table=DB::table("users");
		if($request["phone"]=="" || $request["phone"]==null)
		{
			$Table->where("email",$request["email"]);
		}
		else
		{
			$Table->where("phone",$request["phone"])->orwhere("email",$request["email"]);
		}
		
        $User=$Table->orwhere("username",$request["username"])->get();
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
			$UserID=$user->id;
			if($request["login_type"]==1)
			{
				$role = Sentinel::findRoleBySlug('user');
			}
			else
			{
				$role = Sentinel::findRoleBySlug('tradie');
				$FlBasic=new FlBasic();
				$FlBasic->user_id=$UserID;
				$FlBasic->category=$request["category"];
				$FlBasic->sub_category=$request["sub_category"];
				$FlBasic->fullname=$request["firstname"]." ".$request["lastname"];
				$FlBasic->location=$request["location"];
				$FlBasic->house_no="";
				$FlBasic->street_name=$request["street_name"];
				$FlBasic->suburb="";
				$FlBasic->state=$request["state"];
				$FlBasic->code=$request["code"];
				$FlBasic->postcode=$request["postcode"];
				$FlBasic->longitude=$request["longitude"];
				$FlBasic->latitude=$request["latitude"];
				$FlBasic->status=0;
				$FlBasic->save();
				$FlContact=new FlContact(); 	 	 	 	 	 	 	 	
				$FlContact->fl_basic_id=$FlBasic->id;
				$FlContact->phone=$request["phone"];
				$FlContact->mobile="";
				$FlContact->email=$request["email"];
				$FlContact->website="";
				$FlContact->contact_name=$request["firstname"]." ".$request["lastname"];
				$FlContact->save();
			}
   			$role->users()->attach($user);
			
			$otp=rand(100000,999999);
			$validity = date("Y-m-d H:i:s", strtotime('+24 hours'));

			DB::table("opts")->insert(["user_id"=>$UserID,"verification_code"=>$otp,"valid_till"=>$validity]);
			$this->SendMail($request["email"],"Thank you for registering yourself. Please enter the OTP to Complete registration. Please remember OTP is valid for 24 Hours.<br/>OTP: ".$otp,"Verification Email");
			return response()->json(['status'=>1, "message"=>"Successfully registered","UserID"=>$UserID]);
		}
		else{
			return response()->json(['status'=>0, "message"=>"User already exist.","UserID"=>0]);
		}
	}
	public function ResendVerificationAPI(Request $request)
	{
		$email=$request["email"];
		$User=DB::table("users")->where("email",$email)->first();
		$otp=rand(100000,999999);
		$validity = date("Y-m-d H:i:s", strtotime('+24 hours'));
		DB::table("opts")->where("user_id",$User->id)->delete();
		DB::table("opts")->insert(["user_id"=>$User->id,"verification_code"=>$otp,"valid_till"=>$validity]);
		$Status=$this->SendMail($request["email"],"Thank you for registering yourself. Please enter the OTP to Complete registration. Please remember that the OTP is valid for 24 Hours.<br/>OTP: ".$otp,"Verification Email");
		if($Status==true)
		{
			return response()->json(['status'=>1, "message"=>"Resent verification","UserID"=>$User->id]);	
		}
		else
		{
			return response()->json(['status'=>0, "message"=>"Unable to send verification code","UserID"=>$User->id]);	
		}
	}
	public function mail($name,$email,$otp,$UserID,$validity)
	{
		Mail::to($email)->send(new SendMailable($name, $email, $otp, $UserID, $validity));
		return 'Email was sent';
	}
	public function VerifyRegistration($UserID, $Otp, $DeviceID,$login_type)
	{
		$Validattion=DB::table("opts")->where("valid_till",">=",date("Y-m-d H:i:s"))->first();
		if($Validattion==null)
		{
			return response()->json(['status'=>0, "message"=>"The link is either invalid or expired"]);
		}
		else
		{
			if($DeviceID!="")
			{
				DB::table("user_login")->where("DeviceID",$DeviceID)->update(["status"=>0]);
				if($login_type==1)
				{
					DB::table("user_login")->insert(array("DeviceID"=>$DeviceID,"UserID"=>$UserID,"Status"=>1,"login_type"=>1));
				}
				else
				{
					DB::table("user_login")->insert(array("DeviceID"=>$DeviceID,"UserID"=>$UserID,"Status"=>1,"login_type"=>2));
				}
			}
			DB::table("activations")->insert(array("user_id"=>$UserID,"code"=>md5($DeviceID),"completed"=>1));
			return response()->json(['status'=>1, "message"=>"Thank you. Your registration is completed."]);
		}
	}
    public function Logout(Request $request){
    	DB::table("user_login")->where("DeviceID",$request["DeviceID"])->update(["Status"=>0]);
		return response()->json(['status'=>1, "message"=>"Done"]);
    }
	public function CheckLogin(Request $request)
	{
		$Login=DB::table("user_login")->where("DeviceID",$request["DeviceID"])->where("Status",1)->first();
		if($Login)
		{
			$User=DB::table("users")->where("id",$Login->UserID)->first();
			$User->Tradie=DB::table("fl_basic")->where("user_id",$User->id)->first();
			$Usr=User::getUserById($User->id);
			$User->Role=$Usr->roles->first()->name;
			return response()->json(["Status"=>1,"User"=>$User,"Type"=>$Login->login_type]);
		}
		else
		{
			return response()->json(["Status"=>0]);
		}
	}
	public function UpdateProfile(Request $request)
	{
		
	}
	public function UpdatePassword(Request $request)
	{
		$device_id =$request["DeviceID"];
		$c_passwrd =$request["c_passwrd"];
		$n_password =$request["n_password"];
		$con_password =$request["con_password"];
		if($n_password!=$con_password)
		{
			return response()->json(["Message"=>"New password & confirm password must match.","Error"=>1]);
		}
		$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
		$User=DB::table("users")->where("id",$Login->UserID)->first();
		
		$rememberMe = false;
		$credentials = ([
            'login'     => $User->username,
            'password'  => $c_passwrd,
        ]);
		$Error=1;
		$User=null;
		if(Sentinel::authenticate($credentials, $rememberMe))
		{
			$User=Sentinel::getUser();
			if($User)
			{
				$Error=0;
			}
		}
		if($Error==0)
		{
			DB::table("users")->where("id",$Login->UserID)->update(["password"=>bcrypt($n_password)]);
			return response()->json(["Message"=>"Password updated successfully","Error"=>0]);
		}
		else
		{
			return response()->json(["Message"=>"Invalid old password","Error"=>2]);
		}
	}
	//My Posts
	public function GetMyPosts(Request $request){
		$Login=DB::table("user_login")->where("DeviceID",$request["device_id"])->where("Status",1)->first();
		$Table=DB::table("projects");
		if($request["status"]!=0)
		{
			$Table->where("status",$request["status"]);
		}
		if($request["sort_by"]=="1")
		{
			$Table->orderby("created_at","asc");
		}
		else if($request["sort_by"]=="2")
		{
			$Table->orderby("created_at","desc");
		}
		else if($request["sort_by"]=="3")
		{
			$Table->orderby("estimate_budget","asc");
		}
		else if($request["sort_by"]=="4")
		{
			$Table->orderby("estimate_budget","desc");
		}
		$Table->where("user_id",$Login->UserID)->get();
		$Projects=$Table->get();
		for($i=0;$i<sizeof($Projects);$i++)
		{
			$Projects[$i]->Address=DB::table("project_address")->where("project_id",$Projects[$i]->id)->first();
			$Projects[$i]->User=DB::table("users")->where("id",$Projects[$i]->user_id)->first();
			$Projects[$i]->Category=DB::table("categories")->where("ID",$Projects[$i]->category)->first();
			$Projects[$i]->SubCategory=DB::table("sub_categories")->where("ID",$Projects[$i]->sub_category)->first();
			$Projects[$i]->Bid=DB::table("bids")->where("project_id",$Projects[$i]->id)->where("status",2)->first();
		}
		return response()->json(["Projects"=>$Projects]);
	}
	public function GetMyAssignedPosts(Request $request){
		$Login=DB::table("user_login")->where("DeviceID",$request["device_id"])->where("Status",1)->first();
		$Projects=DB::table("projects")->join("bids","projects.id","=","bids.project_id")->where("bids.status",2)->where("projects.user_id",$Login->UserID)->select("projects.*")->get();
		for($i=0;$i<sizeof($Projects);$i++)
		{
			$Projects[$i]->Address=DB::table("project_address")->where("project_id",$Projects[$i]->id)->first();
			$Projects[$i]->User=DB::table("users")->where("id",$Projects[$i]->user_id)->first();
			$Projects[$i]->Category=DB::table("categories")->where("ID",$Projects[$i]->category)->first();
			$Projects[$i]->SubCategory=DB::table("sub_categories")->where("ID",$Projects[$i]->sub_category)->first();
		}
		return response()->json(["Projects"=>$Projects]);
	}
	public function GetMyReviewedTasks(Request $request){
		$Login=DB::table("user_login")->where("DeviceID",$request["device_id"])->where("Status",1)->first();
		$Bids=DB::table("bids")->join("reviews","bids.project_id","=","reviews.project_id")->where("bids.user_id",$Login->UserID)->where("bids.status",2)->select("bids.*","reviews.rating","reviews.review")->get();
		for($i=0;$i<sizeof($Bids);$i++)
		{
			$Bids[$i]->Project=DB::table("projects")->where("id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Project->Address=DB::table("project_address")->where("project_id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Project->User=DB::table("users")->where("id",$Bids[$i]->Project->user_id)->first();
			$Bids[$i]->Project->Category=DB::table("categories")->where("ID",$Bids[$i]->Project->category)->first();
			$Bids[$i]->Project->SubCategory=DB::table("sub_categories")->where("ID",$Bids[$i]->Project->sub_category)->first();
		}
		return response()->json(["Tasks"=>$Bids]);
	}
	//My Tasks
	public function GetMyTasks(Request $request){
		$Login=DB::table("user_login")->where("DeviceID",$request["device_id"])->where("Status",1)->first();
		$Table=DB::table("bids")->join("projects","bids.project_id","=","projects.id");
		$Table->where("bids.user_id",$Login->UserID)->where("bids.status",2);
		if($request["sort_by"]==1)
		{
			$Table->orderby("projects.created_at","asc");
		}
		else if($request["sort_by"]==2)
		{
			$Table->orderby("projects.created_at","desc");
		}
		else if($request["sort_by"]==3)
		{
			$Table->orderby("projects.estimate_budget","asc");
		}
		else if($request["sort_by"]==4)
		{
			$Table->orderby("projects.estimate_budget","desc");
		}
		$Bids=$Table->select("bids.*")->get();
		for($i=0;$i<sizeof($Bids);$i++)
		{
			$Bids[$i]->Project=DB::table("projects")->where("id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Project->Address=DB::table("project_address")->where("project_id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Project->User=DB::table("users")->where("id",$Bids[$i]->Project->user_id)->first();
			$Bids[$i]->Project->Category=DB::table("categories")->where("ID",$Bids[$i]->Project->category)->first();
			$Bids[$i]->Project->SubCategory=DB::table("sub_categories")->where("ID",$Bids[$i]->Project->sub_category)->first();
		}
		return response()->json(["Tasks"=>$Bids]);
	}
	//My Bids
	public function GetMyBids(Request $request){
		$Login=DB::table("user_login")->where("DeviceID",$request["device_id"])->where("Status",1)->first();
		$Table=DB::table("bids")->join("projects","bids.project_id","=","projects.id");
		$Table->where("bids.user_id",$Login->UserID);
		if($request["sort_by"]==1)
		{
			$Table->orderby("projects.created_at","asc");
		}
		else if($request["sort_by"]==2)
		{
			$Table->orderby("projects.created_at","desc");
		}
		else if($request["sort_by"]==3)
		{
			$Table->orderby("projects.estimate_budget","asc");
		}
		else if($request["sort_by"]==4)
		{
			$Table->orderby("projects.estimate_budget","desc");
		}
		$Bids=$Table->select("bids.*")->get();
		for($i=0;$i<sizeof($Bids);$i++)
		{
			$Bids[$i]->Project=DB::table("projects")->where("id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Project->Address=DB::table("project_address")->where("project_id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Project->User=DB::table("users")->where("id",$Bids[$i]->Project->user_id)->first();
			$Bids[$i]->Project->Category=DB::table("categories")->where("ID",$Bids[$i]->Project->category)->first();
			$Bids[$i]->Project->SubCategory=DB::table("sub_categories")->where("ID",$Bids[$i]->Project->sub_category)->first();
		}
		return response()->json(["Bids"=>$Bids]);
	}
	public function ResetPasswordAPI(Request $request)
	{
		$email=$request["email"];
		$User=DB::table("users")->where("email",$email)->first();
		if($User==null)
		{
			return response()->json(["Status"=>0, "Message"=>"This Email ID is not registered yet."]);
		}
		else
		{
			$new_password=$this->getRandomName(8);
			DB::table("users")->where("id",$User->id)->update(["password"=>bcrypt($new_password)]);
			$this->SendMail($email,"Dear, ".$User->username.", <br/>Your password is reset. Your new password is: ".$new_password,"Reset password");
			return response()->json(["Status"=>1, "Message"=>"Congrats. New password is mailed to your email."]);
		}
	}
	private function getRandomName($n) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 
	
		for ($i = 0; $i < $n; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 
	
		return $randomString; 
	} 
	public function SendMail($To,$Message,$Subject)
	{
		$mail = new PHPMailer(true);
		
		try {
			//Server settings                                    // Enable verbose debug output
			$mail->IsSMTP();
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->SMTPDebug = 0;
			$mail->Host = 'smtp.gmail.com';
			$mail->Port =587;
			$mail->SMTPAuth = true;
			$mail->SMTPSecure = "tls";
			$mail->Username = 'himalayangroup.aus@gmail.com';
			$mail->Password = 'Himalayan@123';
			$mail->AddReplyTo('himalayangroup.aus@gmail.com');
			$mail->AddAddress($To);
			$mail->SetFrom('himalayangroup.aus@gmail.com');
			$mail->Subject = $Subject;
			$mail->isHTML(true);
			$mail->Body=$Message;
			$mail->Send();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
	public function TestMail(Request $request)
	{
		if($this->SendMail("ajs.ghy@gmail.com","Thank you for registering yourself. Please enter the OTP to Complete registration. Please remember that the OTP is valid for 24 Hours.<br/>OTP: 112333","Verification Email"))
		{
			return "Success";
		}
		else
		{
			return "Fail";
		}
	}
}
