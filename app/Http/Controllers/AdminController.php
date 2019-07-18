<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Stock;
use Sentinel;
use DB;

class AdminController extends Controller
{
	public function getDashboard(){
        $stock = Stock::allStock();
	   return view('admin.pages.dashboard')
                ->with(['stock' => $stock]);
	}

    public function getUserManagement(){
    	$users = User::allUsers();
    	$roles = DB::table('roles')
    				->get();

    	return view('admin.pages.user-management')
    			->with([
    				'users' => $users,
    			 	'roles' => $roles,
 				]);
    }

    public function addUser(Request $request){
        //dd($request->all());
    	$this->validate($request, [
    		'fullname' 	   => 'required|min:3',
    		'dob'		   => 'required|min:3',
    		'username'	   => 'required|unique:users',
    		'phone'		   => 'required|unique:users',
    		'email'		   => 'required|unique:users',
    		'password'	   => 'required|min:4',
    	]);

    	$user = Sentinel::registerAndActivate($request->all());

   		$role = Sentinel::findRoleBySlug('user');
   		$role->users()->attach($user);
         return redirect('Users')->with('success', 'User added successfully.');
    }

    public function getEditUser(Request $request){
    	$roles = DB::table('roles')
    					->get();
    	$user = User::getUser($request->id);
    	if(count($user)>0){
    		
    		return view('admin.pages.edit-user')
    				->with(['user'	=> $user, 'roles' =>$roles]);
    	} 
    }

    public function editUser(Request $request, $id){

    	$this->validate($request, [
    		'first_name' 	=> 'required|min:3',
    		'last_name'		=> 'required|min:3',
    		'username'		=> 'required',
    		'phone'			=> 'required',
    		'category'		=> 'required',
    		'address'		=> 'required|min:4'
    	]);

    	User::where('id', '=', $id)
    			->update([
    				'username' 	   => $request->username,
    				'phone'		   => $request->phone,
                    'first_name'   => $request->first_name,
                    'last_name'    => $request->last_name,
                    'address'      => $request->address

    			]);

    	DB::table('role_users')
                ->where('user_id', $id)
                ->update(['role_id' => $request->category]);

    	 return redirect()->route('user.management')
    	 					->with('success', 'User updated successfully.');
    }

    public function block($id){
    	if(isset($id)){
            if(Sentinel::findById($id)->status == 1)
                $status = 0;
            else
                $status =1;

            User::where('id', '=', $id)
                    ->update([
                        'status' => $status,
                    ]);
           return redirect()->route('user.management')
    				->with('error', 'User has been blocked/unblocked.');
           
        }else{
            return "500, Internal serve error.";
        }
    }

    public function delete($id){
    	if(isset($id)){
    		User::where('id', '=', $id)->delete();
    		return redirect()->route('user.management')
    				->with('error', 'User data has been successfully deleted.');
    	}else{
    		return "500, Internal serve error.";
    	}
    }
}
