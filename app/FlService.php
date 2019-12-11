<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlService extends Model
{
    protected $table="fl_services";
    public static function getFlService($id){
    	return DB::table('fl_services')->where('fl_basic_id', '=', $id)->first();
    }
}
