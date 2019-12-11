<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlBasic extends Model
{
    protected $table="fl_basic";

    public static function getFreelancerByUserID($id){
    	return DB::table('fl_basic')->where('user_id', '=', $id)->first();
    }

}
