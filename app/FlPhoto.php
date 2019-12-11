<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlPhoto extends Model
{
    protected $table="fl_photos";
    public static function getFlPhoto($id){
    	return DB::table('fl_photos')->where('fl_basic_id', '=', $id)->get();
    }
}
