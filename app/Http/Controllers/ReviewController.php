<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Project;
use DB;
class ReviewController extends Controller
{
	public function SaveReviewAPI(Request $request)
	{
		DB::table("reviews")->where("project_id",$request["project_id"])->delete();
		$Project=DB::table("projects")->where("id",$request["project_id"])->first();
		$ApprovedBid=DB::table("bids")->where("status",2)->where("project_id",$request["project_id"])->first();
		$Tradie=DB::table("fl_basic")->where("user_id",$ApprovedBid->user_id)->first();
		$review=new Review();
		$review->project_id=$request["project_id"];
		$review->user_id=$Project->user_id;
		$review->tradie_id=$Tradie->id;
		$review->rating=$request["rating"];
		$review->review=$request["review"];
		$review->save();
		return response()->json(["Error"=>0,"Message"=>"Success"]);
	}
	public function GetReviewByProjectAPI($project_id)
	{
		$Review=DB::table("reviews")->where("project_id",$project_id)->first();
		return response()->json(["Review"=>$Review]);
	}
	public function GetReviewByTradieAPI($tradie_id)
	{
		$Reviews=DB::table("reviews")->where("tradie_id",$tradie_id)->get();
		return response()->json(["Reviews"=>$Reviews]);
	}
	public function GetReviewByCustomer($customer_id)
	{
		$Reviews=DB::table("reviews")->where("user_id",$customer_id)->get();
		return response()->json(["Reviews"=>$Reviews]);
	}
}
