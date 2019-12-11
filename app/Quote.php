<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Quote extends Model
{
    protected $table="quote_requests";

    public static function getQuotationFiles($id){
    	return DB::table('quote_files')->where('quote_id', '=', $id)->get();
    }
}
