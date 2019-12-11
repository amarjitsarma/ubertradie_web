<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlAbout extends Model
{
    protected $table="fl_about";
    public static function getFlAbout($id){
    	return DB::table('fl_about')->where('fl_basic_id', '=', $id)->first();
    }
}
