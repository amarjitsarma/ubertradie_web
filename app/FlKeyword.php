<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlKeyword extends Model
{
    protected $table="fl_keywords";
    public static function getFlKeyword($id){
    	return DB::table('fl_keywords')->where('fl_basic_id', '=', $id)->get();
    }
}
