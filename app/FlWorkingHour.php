<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlWorkingHour extends Model
{
    protected $table="fl_working_hours";
    public static function getFlWorkingHour($id){
    	return DB::table('fl_working_hours')->where('fl_basic_id', '=', $id)->first();
    }
}
