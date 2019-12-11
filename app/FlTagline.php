<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class FlTagline extends Model
{
    protected $table="fl_tagline";
    public static function getFlTagline($id){
    	return DB::table('fl_tagline')->where('fl_basic_id', '=', $id)->get();
    }
}
