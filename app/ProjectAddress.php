<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAddress extends Model
{
    protected $table="project_address";

    public static function getProjectAddress($id){
    	return static::where('project_id', '=', $id)->first();
    }
}
