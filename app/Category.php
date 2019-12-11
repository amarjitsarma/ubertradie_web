<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function getCategory($id){
    	return static::where('id', '=', $id)->first();
    }
}
