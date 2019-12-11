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
	public function GetBidAPI(Request $request)
	{
		$id=$request["id"];
		$type=$request["type"];
		if($id!=null && $id!="")
		{
			$Bids=DB::table("bids")->where("id",$id)->first();
			$Bids->Project=DB::table("projects")->where("id",$Bids->project_id)->first();
			$User=DB::table("users")->where("id",$Bids->user_id)->first();
			$Bids->Tradie=DB::table("fl_basic")->where("user_id",$User->id)->first();
		}
		else
		{
			$device_id=$request["device_id"];
			$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
			if($type=="sender")
			{
				$Bids=DB::table("bids")->where("user_id",$Login->UserID)->get();
				for($i=0;$i<sizeof($Bids);$i++)
				{
					$Bids[$i]->Project=DB::table("projects")->where("id",$Bids[$i]->project_id)->first();
					$Bids[$i]->Tradie=DB::table("fl_basic")->where("user_id",$Login->UserID)->first();
				}
			}
			else
			{
				$Projects=DB::table("projects")->where("user_id",$Login->UserID)->get();
				$ProjectIDs=[];
				foreach($Projects as $project)
				{
					array_push($ProjectIDs,$project->id);
				}
				$Bids=DB::table("bids")->wherein("project_id",$ProjectIDs)->get();
				for($i=0;$i<sizeof($Bids);$i++)
				{
					$Bids[$i]->Project=DB::table("projects")->where("id",$Bids[$i]->project_id)->first();
					$Bids[$i]->Tradie=DB::table("fl_basic")->where("user_id",$Login->UserID)->first();
				}
			}
		}
		return response()->json(['Bids'=>$Bids]);
	}
	public function GetBidsByProject(Request $request)
	{
		$ProjectID=$request["ProjectID"];
		$Bids=DB::table("bids")->where("project_id",$ProjectID)->orderby("status","desc")->orderby("created_at","desc")->get();
		for($i=0;$i<sizeof($Bids);$i++)
		{
			$Bids[$i]->Project=DB::table("projects")->where("id",$Bids[$i]->project_id)->first();
			$Bids[$i]->Tradie=DB::table("fl_basic")->join("users","fl_basic.user_id","=","users.id")->select("fl_basic.*","users.avatar")->where("user_id",$Bids[$i]->user_id)->first();
			$Bids[$i]->ReviewSum=DB::table("reviews")->where("tradie_id",$Bids[$i]->Tradie->id)->sum("rating");
			$Bids[$i]->ReviewCount=DB::table("reviews")->where("tradie_id",$Bids[$i]->Tradie->id)->count();
		}
		return response()->json(['Bids'=>$Bids]);
	}
	public function ApproveBidAPI(Request $request)
	{
		$Bid=DB::table("bids")->where("id",$request["bid_id"])->first();
		$Project=DB::table("projects")->where("id",$Bid->project_id)->first();
		DB::table("bids")->where("id",$request["bid_id"])->update(["status"=>2]);
		DB::table("projects")->where("id",$Bid->project_id)->update(["status"=>2]);
		return response()->json(['Message'=>"Done"]);
	}
}
?>