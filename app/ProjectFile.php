<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectFile extends Model
{
    protected $table="project_files";
    public static function getProjectFile($id){
    	return DB::table('project_files')->where('project_id', '=', $id)->get();
    }
}
