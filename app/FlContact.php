<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlContact extends Model
{
    protected $table="fl_contact";
    public static function getFlContact($id){
    	return DB::table('fl_contact')->where('fl_basic_id', '=', $id)->first();
    }
}
