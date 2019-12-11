<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model
{
    protected $table="projects";

    public static function getProjectBids($id){
    	return DB::table('bids')->where('project_id', '=', $id)->get();
    }
}
