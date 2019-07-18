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
		$data["Locations"]=DB::table('locations')->get();
		$data["Title"]="User Master";
    	return view('users',$data);
    }
    public function CreateUser(Request $request)
    {
		dd($request->all());
        $this->validate($request, [
            'FullName' => 'required|min:3|max:100',
            'DOB'=>'required',
            'MobileNo' => 'required|min:10|max:10|unique:users',
            'EmailID' => 'required|email|unique:users',
            'UserID' => 'required|max:50|unique:users',
            'Password' => 'required|min:6|max:50|confirmed',
			'PlaceID' => 'required'
        ]);
        $user= new User();
        $user->FullName= $request['FullName'];
        $user->DOB= $request['DOB'];
        $user->MobileNo= $request['MobileNo'];
        $user->EmailID= $request['EmailID'];
        $user->UserID= $request['UserID'];
        $user->Password= bcrypt($request['Password']);
        $user->Location= $request['PlaceID'];
        $user->save();
        return redirect('/Users');
    }
    public function DeleteUser(Request $request)
    {
        $ID=$request["ID"];
        DB::table("users")->where("ID",$ID)->delete();
    }
}
