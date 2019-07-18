<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Sentinel;
class UserController extends Controller
{
    public function LoginPage()
    {
    	return view('login');
    }
    public function Login(Request $request)
    {
    	$UserID = $request->input('UserID');
    	$Password=$request->input('Password');
    	return redirect('User/Users');
    }
    public function Users()
    {
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
    	$data["Users"]=DB::table('users')->get();
		$data["Title"]="User Master";
    	return view('users',$data);
    }
    public function CreateUser(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|min:3|max:100',
			'last_name' => 'required|min:3|max:100',
            'dob'=>'required',
            'phone' => 'required|min:10|max:10|unique:users',
            'email' => 'required|email|unique:users',
            'username' => 'required|max:50|unique:users',
            'password' => 'required|min:6|max:50|confirmed'
        ]);
        $user= new User();
        $user->first_name= $request['first_name'];
		$user->last_name= $request['last_name'];
        $user->dob= $request['dob'];
        $user->phone= $request['phone'];
        $user->email= $request['email'];
        $user->username= $request['username'];
        $user->password= bcrypt($request['password']);
        $user->save();
        return redirect('/Users');
    }
    public function DeleteUser(Request $request)
    {
        $ID=$request["ID"];
        DB::table("users")->where("id",$ID)->delete();
		return redirect('/Users');
    }
	public function ChangeStatus(Request $request)
    {
		$ID=$request["ID"];
		$User=DB::table("users")->where("id",$ID)->first();
		if($User->status==0)
		{
			DB::table("users")->where("id",$ID)->update(["status"=>1]);
		}
		else
		{
			DB::table("users")->where("id",$ID)->update(["status"=>0]);
		}
		return redirect('/Users');
	}
}
