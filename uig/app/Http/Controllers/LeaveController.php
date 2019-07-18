<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\StudentLeave;
use App\StaffLeave;
use Sentinel;
class LeaveController extends Controller
{
    public function StudentLeave(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Student Leave";
		if($data["UserType"]!="admin")
		{
			$data["PlaceID"]=$data["LocationID"];
		}
		else
		{
			$data["PlaceID"]=$request["PlaceID"];
		}
		$data["StudentID"]=$request["StudentID"];
		$data["Locations"]=DB::table("locations")->get();
		if($data["PlaceID"]=="")
		{
			$data["PlaceID"]=$data["Locations"][0]->ID;
		}
		$data["Students"]=DB::table("students")->where("PlaceID",$data["PlaceID"])->get();
		if($data["StudentID"]=="")
		{
			if(sizeof($data["Students"])>0)
			{
				$data["StudentID"]=$data["Students"][0]->ID;
			}
			else
			{
				$data["StudentID"]=0;
			}
		}
		if($data["UserType"]=="admin")
		{
			$data["Leaves"]=DB::table('students')
            ->join('studentleaves', 'studentleaves.StudentID', '=', 'students.ID')
            ->select('studentleaves.ID','students.Code','students.Name','students.MobileNo','students.DOB', 'studentleaves.LeaveDate','studentleaves.Reason')->get();
		}
		else
		{
			$data["Leaves"]=DB::table('students')
            ->join('studentleaves', 'studentleaves.StudentID', '=', 'students.ID')
            ->select('studentleaves.ID','students.Code','students.Name','students.MobileNo','students.DOB', 'studentleaves.LeaveDate','studentleaves.Reason')->where("students.PlaceID",$data["LocationID"])->get();
		}
		return view("StudentLeave",$data);
	}
	public function NewStudentLeave(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["PlaceID"]=$request["PlaceID"];
		$data["StudentID"]=$request["StudentID"];
		$data["Student"]=DB::table("students")->join("locations","students.PlaceID","=","locations.ID")->select('students.Code','students.Name','students.MobileNo','students.DOB','locations.LocationName')->get();
		$data["Title"]="New Leave Entry";
		return view("/NewStudentLeave",$data);
	}
	public function SaveStudentLeave(Request $request)
	{
		$this->validate($request, [
    		'FromDate' 	=> 'required|min:10',
    		'ToDate'	=> 'required|min:10',
    		'Reason'	=> 'required',
    	]);
		$FromDate=$request["FromDate"];
		$ToDate=$request["ToDate"];
		while (strtotime($FromDate) <= strtotime($ToDate)) {
			$day=date("D",strtotime($FromDate));
			if($day!="Sun")
			{
				$StudentLeave=new StudentLeave();
				$StudentLeave->LeaveDate=$FromDate;
				$StudentLeave->PlaceID=$request["PlaceID"];
				$StudentLeave->StudentID=$request["StudentID"];
				$StudentLeave->Reason=$request["Reason"];
				$StudentLeave->save();
				$StudentDetail=DB::table("students")->where("ID",$request["StudentID"])->get();
				$ExpiryDate=$StudentDetail[0]->ExpiryDate;
				$ExpiryDate=date ("Y-m-d", strtotime("+1 day", strtotime($ExpiryDate)));
				DB::table("students")->where("ID",$request["StudentID"])->update(["ExpiryDate"=>$ExpiryDate]);
			}
			$FromDate = date ("Y-m-d", strtotime("+1 day", strtotime($FromDate)));
		}
		return redirect("/StudentLeave?PlaceID=".$request["PlaceID"]."&StudentID=".$request["StudentID"]);
	}
	public function DeleteStudentLeave(Request $request)
	{
		$ID=$request["ID"];
		DB::table('studentleaves')->where("ID",$request["ID"])->delete();
		return redirect("/StudentLeave");
	}
	public function StaffLeave(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Staff Leave";
		$data["PlaceID"]=$request["PlaceID"];
		$data["StaffID"]=$request["StaffID"];
		$data["Locations"]=DB::table("locations")->get();
		if($data["PlaceID"]=="")
		{
			$data["PlaceID"]=$data["Locations"][0]->ID;
		}
		$data["Staffs"]=DB::table("staffs")->where("PlaceID",$data["PlaceID"])->get();
		if($data["StaffID"]=="")
		{
			if(sizeof($data["Staffs"])>0)
			{
				$data["StaffID"]=$data["Staffs"][0]->ID;
			}
			else
			{
				$data["StaffID"]=0;
			}
		}
		if($data["UserType"]=="admin")
		{
			$data["Leaves"]=DB::table('staffs')
            ->join('staffleaves', 'staffleaves.StaffID', '=', 'staffs.ID')
            ->select('staffs.Code','staffs.Name','staffs.MobileNo','staffs.DOB', 'staffleaves.ID', 'staffleaves.LeaveDate','staffleaves.Reason')->get();
		}
		else
		{
			$data["Leaves"]=DB::table('staffs')
            ->join('staffleaves', 'staffleaves.StaffID', '=', 'staffs.ID')
            ->select('staffs.Code','staffs.Name','staffs.MobileNo','staffs.DOB', 'staffleaves.ID', 'staffleaves.LeaveDate','staffleaves.Reason')->where("staffs.PlaceID",$data["LocationID"])->get();
		}
		return view("StaffLeave",$data);
	}
	public function NewStaffLeave(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["PlaceID"]=$request["PlaceID"];
		$data["StaffID"]=$request["StaffID"];
		$data["Staff"]=DB::table("staffs")->join("locations","staffs.PlaceID","=","locations.ID")->select('staffs.Code','staffs.Name','staffs.MobileNo','staffs.DOB','locations.LocationName')->get();
		$data["Title"]="New Leave Entry";
		return view("/NewStaffLeave",$data);
	}
	public function SaveStaffLeave(Request $request)
	{
		$this->validate($request, [
    		'FromDate' 	=> 'required|min:10',
    		'ToDate'	=> 'required|min:10',
    		'Reason'	=> 'required',
    	]);
		$FromDate=$request["FromDate"];
		$ToDate=$request["ToDate"];
		while (strtotime($FromDate) <= strtotime($ToDate)) 
		{    
			$day=date("D",strtotime($FromDate));
			if($day!="Sun")
			{
				$StaffLeave=new StaffLeave();
				$StaffLeave->LeaveDate=$FromDate;
				$StaffLeave->PlaceID=$request["PlaceID"];
				$StaffLeave->StaffID=$request["StaffID"];
				$StaffLeave->Reason=$request["Reason"];
				$StaffLeave->save();
			}
			$FromDate = date ("Y-m-d", strtotime("+1 day", strtotime($FromDate)));
		}
		return redirect("/StaffLeave?PlaceID=".$request["PlaceID"]."&StaffID=".$request["StaffID"]);
	}
	public function DeleteStaffLeave(Request $request)
	{
		$ID=$request["ID"];
		DB::table('staffleaves')->where("ID",$request["ID"])->delete();
		return redirect("/StaffLeave");
	}
}
