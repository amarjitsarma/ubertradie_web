<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bid;
use DB;
class BidController extends Controller
{
	public function SaveBidAPI(Request $request)
	{
		$device_id=$request["device_id"];
		$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
		$Bid=new Bid();
		$Bid->user_id=$Login->UserID;
		$Bid->project_id=$request["project_id"];
		$Bid->bid_amount=$request["bid_amount"];
		$Bid->completion_time=$request["completion_time"];
		$Bid->bid_desc=$request["bid_desc"];
		$Bid->status=1;
		$Bid->save();
		return response()->json(['id'=>$Bid->id]);
	}
}
?>