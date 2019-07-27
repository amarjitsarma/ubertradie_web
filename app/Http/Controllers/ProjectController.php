<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectAddress;
use DB;
class ProjectController extends Controller
{
    public function SaveProjectAPI(Request $request)
	{
		$device_id=$request["device_id"];
		$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
		$Project=new Project();
		$Project->user_id=$Login->UserID;
		$Project->category=$request["category"];
		$Project->sub_category=$request["sub_category"];
		$Project->location_type=$request["location_type"];
		$Project->title=$request["title"];
		$Project->description=$request["description"];
		$Project->skills=$request["skills"];
		$Project->payment_mode=$request["payment_mode"];
		$Project->estimate_budget=$request["estimate_budget"];
		$Project->working_hour=$request["working_hour"];
		$Project->status=0;
		$Project->save();
		$ProjectID=$Project->id;
		if($request["location_type"] == "onsite")
		{
			$ProjectAddress=new ProjectAddress();
			$ProjectAddress->project_id=$ProjectID;
			$ProjectAddress->house_no=$request["house_no"];
			$ProjectAddress->street_name=$request["street_name"];
			$ProjectAddress->suberb=$request["suberb"];
			$ProjectAddress->state=$request["state"];
			$ProjectAddress->code=$request["code"];
			$ProjectAddress->save();
		}
		return response()->json(['id'=>$ProjectID]);
	}
	public function GetProjectsAPI(Request $request)
	{
		$id=$request["ProjectID"];
		if($id!="" || $id!=null)
		{
			$Projects=DB::table("projects")->where("id",$id)->first();
			$Projects->Address=DB::table("project_address")->where("project_id",$Projects->id)->first();
			$Projects->User=DB::table("users")->where("id",$Projects->user_id)->first();
			$Projects->Category=DB::table("categories")->where("ID",$Projects->category)->first();
			$Projects->SubCategory=DB::table("sub_categories")->where("ID",$Projects->sub_category)->first();
		}
		else
		{
			$Projects=DB::table("projects")->orderby("id","desc")->get();
			for($i=0;$i<sizeof($Projects);$i++)
			{
				$Projects[$i]->Address=DB::table("project_address")->where("project_id",$Projects[$i]->id)->first();
				$Projects[$i]->User=DB::table("users")->where("id",$Projects[$i]->user_id)->first();
				$Projects[$i]->Category=DB::table("categories")->where("ID",$Projects[$i]->category)->first();
				$Projects[$i]->SubCategory=DB::table("sub_categories")->where("ID",$Projects[$i]->sub_category)->first();
			}
		}
		return response()->json(['Projects'=>$Projects]);
	}
	public function LoadSuberbsAPI(Request $request)
	{
		$Suberbs=DB::table("project_address")->select('suberb')->groupby('suberb')->get();
		return response()->json(['Suberbs'=>$Suberbs]);
	}
}
