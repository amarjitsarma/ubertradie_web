<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Review extends Model
{
    protected $table="reviews";

    public static function getProjectBids($id){
    	return DB::table('bids')->where('project_id', '=', $id)->get();
    }
}
