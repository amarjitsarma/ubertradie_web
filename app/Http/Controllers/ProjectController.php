<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectAddress;
use DB;
class ProjectController extends Controller
{
	public function getProjects(){
		$Title = 'Projects';
		$projects = DB::table('projects')
						->orderby('id', 'desc')
						->get();

		return view('projects')->with(['projects' => $projects, 'Title' => $Title]);
	}

	public function getProjectDetails($id){
		$projectDtls = DB::table('projects')
							->where('id', '=', $id)
							->first();

		return view('project-details')->with(['projectDtls' => $projectDtls, 'Title' => 'Project Details']);
	}

	public function projectStatus($id){
		$status = DB::table('projects')
					->where('id', '=', $id)
					->first()
					->status;

		if($status == 1){
			$status = 0;
		}else{
			$status = 1;
		}
		DB::table('projects')
			->where('id', '=', $id)
			->update(['status' => $status]);

		return redirect('/project-details/'.$id);
	}

	public function projectBidStatus($id){
		$status = DB::table('bids')
					->where('id', '=', $id)
					->first()
					->status;

		if($status == 1){
			$status = 0;
		}else{
			$status = 1;
		}
		DB::table('bids')
			->where('id', '=', $id)
			->update(['status' => $status]);

		return redirect('/project-details/'.DB::table('bids')->where('id', '=', $id)->first()->project_id);
	}

	//API
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
		$short_by_posted=$request["short_by_posted"];
		$short_by_budget=$request["short_by_budget"];
		$show_assigned=$request["show_assigned"];
		$budget_0=$request["budget_0"];
		$budget_1=$request["budget_1"];
		$budget_2=$request["budget_2"];
		$budget_3=$request["budget_3"];
		$budget_4=$request["budget_4"];
		$Suberb=$request["Suberb"];
		$RemoteLocation=$request["RemoteLocation"];
		$sub_category=$request["sub_category"];
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
			
			$Projects=DB::table("projects")->where("status",1);
			if($show_assigned==false){
				$Projects=$Projects->orwhere("status",2);
			}
			if($short_by_posted==true)
			{
				$Projects=$Projects->orderby("id","desc");
			}
			if($short_by_budget==true)
			{
				$Projects=$Projects->orderby("estimate_budget");
			}
			if($budget_1==true)
			{
				$Projects=$Projects->where("estimate_budget",">",0);
				$Projects=$Projects->where("estimate_budget","<",101);
			}
			if($budget_2==true)
			{
				$Projects=$Projects->where("estimate_budget",">",100);
				$Projects=$Projects->where("estimate_budget","<",501);
			}
			if($budget_3==true)
			{
				$Projects=$Projects->where("estimate_budget",">",500);
				$Projects=$Projects->where("estimate_budget","<",1001);
			}
			if($budget_4==true)
			{
				$Projects=$Projects->where("estimate_budget",">",1000);
			}
			if($sub_category!=null)
			{
				$Projects=$Projects->where("sub_category",$sub_category);
			}
			$Projects=$Projects->get();
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
		$Suberbs=DB::table("fl_basic")->select('suburb')->groupby('suburb')->orderby("suburb")->get();
		return response()->json(['Suberbs'=>$Suberbs]);
	}
	public function ChangeProjectStatus(Request $request)
	{
		$device_id=$request["device_id"];
		$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
		$ProjectID=$request["project_id"];
		if($request["status"]==3)
		{
			DB::table("projects")->where("id",$ProjectID)->update(["Status"=>3,"completed_by"=>$Login->UserID]);
		}
		else if($request["status"]==2)
		{
			DB::table("projects")->where("id",$ProjectID)->update(["Status"=>2,"completed_by"=>null]);
		}
		return response()->json(['Message'=>"Done"]);
	}
}
