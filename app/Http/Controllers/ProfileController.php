<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use Image;
use Sentinel;
use Session;

class ProfileController extends Controller
{
    
    public function getProfile($email){
    	$user = User::where('email', '=', $email)->first();
    	if(count($user)>0){
            return view('admin.pages.profile')
                ->with([
                    'user'      => $user
                    ]);
    	}
    }

    public function postProfile(Request $request, $email){

        $user = User::where('email', '=', $email)->first();
        try {
            if(count($user)>0){
                 User::where('email', '=', $email)
                        ->update([
                            'username'  => $request->username,
                            'phone'     => $request->phone,
                            'first_name'    => $request->first_name,
                            'last_name'     => $request->last_name,
                            'address'       => $request->address
                            ]);
                }else{
                    return redirect()->route('profile', $email)->with('error', 'Internal Server Error! 500');
                }
            
        } catch (Exception $e) {
            return $e;
        }
        return redirect()->route('profile', $email)->with('success', 'Well Done! Profile successfully updated.');
    }

    public function changeProfilePic(Request $request, $email){
        if($request->hasFile('avatar')){
            $user = User::where('email', '=', $email)->first();
            if(count($user)>0){
                //remove the pervious avatar..
                $oldAvatar = User::where('id', '=', $user->id)->first();
                if($oldAvatar->avatar != ''){
                    unlink(public_path($oldAvatar->avatar));
                }
                $avatar = $request->file('avatar');
                $filename = "avatar_".time().".".$avatar->getClientOriginalExtension();
                $completePath = '/uploads/avatar/'.$filename;
                Image::make($avatar)->resize(128,128)->save(public_path($completePath));

                User::where('id', '=', $user->id)
                        ->update([
                            'avatar'    => $completePath
                            ]);   
            }
        }else{
            return redirect()->route('profile', $email)->with('error', 'Oh Snap! Internal Server Error! 500.');
        }
        return redirect()->route('profile', $email)->with('success', 'Well Done! Profile picture successfully updated.');
    }

    public function getChangePassword(){
        return view('admin.pages.change-password');
    }

    public function postChangePassword(Request $request){

        $hasher = Sentinel::getHasher();

        $oldPassword =$request->current_password;
        $password = $request->new_password;
        $passwordConf = $request->confirm_password;

        $user = Sentinel::getUser();

        if (!$hasher->check($oldPassword, $user->password) || $password != $passwordConf) {
            Session::flash('error', 'You have entered a wrong Current Password.');
            return redirect()->route('change.password');
        }

        Sentinel::update($user, array('password' => $password));

        Session::flash('message', 'Password has been changed successfully.');
        return redirect()->route('change.password');
    }
}
