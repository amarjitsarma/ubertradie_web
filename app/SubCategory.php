<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public static function getSubCategory($id){
    	return static::where('id', '=', $id)->first();
    }
}
