<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cartalyst\Sentinel\Users\EloquentUser;
use DB;

class User extends EloquentUser
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'phone',
        'permissions',
        'status',
        'fullname',
        'avatar',
        'dob',
		'location'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $loginNames = ['email','username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function allUsers(){
        return User::orderBy('id', 'desc')->get();
    }

    public static function allDitributor(){
        $roles=DB::table('role_users')
            ->where('role_id', '=', 2)
            ->get();
        
        foreach ($roles as $role) {
           $user[]=User::where('id','=',$role->user_id)->get();
        }
        return $user;
    }

    public static function getUser($email){
        return User::where('email', '=', $email)->first();
    }

      public static function getUserById($id){
        return User::where('id', '=', $id)->first();
    }

    public function getProfile(){
         return $this->belongsTo(Client::class, 'id', 'user_id');
    }

    public static function byEmail($email){
        return static::whereEmail($email)->first();
    }
}
