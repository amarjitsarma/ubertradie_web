<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Studentattendance;
use App\Staffattendance;
use Sentinel;
class AttendanceController extends Controller
{
    public function UploadExcel()
	{
		return "Future development";
	}
	public function StudentAttendance()
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Locations"]=DB::table("locations")->get();
		$data["Title"]="Student Attendance";
		if($data["UserType"]=="admin")
		{
			$data["Attendances"] = DB::table('students')
            ->join('studentattendances', 'studentattendances.RegisteredID', '=', 'students.ID', 'left outer')
            ->join('locations', 'students.PlaceID', '=', 'locations.ID', 'left outer')
            ->select('students.IDNo','students.BiometricCode','students.Name','students.MobileNo','students.DOB', 'studentattendances.EntryDate','studentattendances.EntryTime','studentattendances.ExitTime','studentattendances.AttendedDuration','studentattendances.Status', 'locations.LocationName')->where("studentattendances.EntryDate",date("Y-m-d"))
            ->get();
		}
		else
		{
			$data["Attendances"] = DB::table('students')
            ->join('studentattendances', 'studentattendances.RegisteredID', '=', 'students.ID', 'left outer')
            ->join('locations', 'students.PlaceID', '=', 'locations.ID', 'left outer')
            ->select('students.IDNo','students.BiometricCode','students.Name','students.MobileNo','students.DOB', 'studentattendances.EntryDate','studentattendances.EntryTime','studentattendances.ExitTime','studentattendances.AttendedDuration','studentattendances.Status', 'locations.LocationName')->where("students.PlaceID",$data["LocationID"])->where("studentattendances.EntryDate",date("Y-m-d"))
            ->get();
		}
		return view("StudentAttendance",$data);
	}
	public function StudentAttendanceSheet(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$PlaceID=$request["PlaceID"];
		$data["Title"]="Student Attendance";
		$data["Attendances"] = DB::table('students')->select(DB::raw('*,0 as Status'))->where("PlaceID",$PlaceID)
            ->get();
		for($i=0;$i<sizeof($data["Attendances"]);$i++)
		{
			$Today=DB::table("studentattendances")->where("RegisteredID",$data["Attendances"][$i]->ID)->where("EntryDate",date("Y-m-d"))->get();
			if(sizeof($Today)==0)
			{
				$data["Attendances"][$i]->Status=0;
			}
			else
			{
				$data["Attendances"][$i]->Status=1;
			}
		}
		$data["PlaceID"]=$PlaceID;
		return view("StudentAttendanceForm",$data);
	}
	public function StudentAttendanceSave(Request $request)
	{
		$Attendance=new Studentattendance();
		$EntryDate=date("Y-m-d");
		$chkStudent=$request["chkStudent"];
		foreach($chkStudent as $Student)
		{
			DB::table("studentattendances")->where("RegisteredID",$Student)->where("EntryDate",$EntryDate)->delete();
			$StudentDetail=DB::table('students')->where('ID',$Student)->get();
			$Attendance->EntryDate=$EntryDate;
			$Attendance->RegisteredID=$Student;
			$Attendance->RegisteredCode=$StudentDetail[0]->Code;	
			$Attendance->PlaceID=$request["PlaceID"];
			$Attendance->EntryTime="";
			$Attendance->ExitTime="";
			$Attendance->AllPunches="";
			$Attendance->AttendedDuration="";	
			$Attendance->Status=1;
		}
		$Attendance->save();
		return redirect("StudnetAttendance")->with("message","Attendance saved");
	}
	public function StaffAttendance()
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Locations"]=DB::table("locations")->get();
		$data["Title"]="Staff Attendance";
		if($data["UserType"]=="admin")	
		{
			$data["Attendances"] = DB::table('staffs')
            ->join('staffattendances', 'staffattendances.RegisteredID', '=', 'staffs.ID', 'left outer')
            ->join('locations', 'staffs.PlaceID', '=', 'locations.ID', 'left outer')
            ->select('staffs.IDNo','staffs.BiometricCode','staffs.Name','staffs.MobileNo','staffs.DOB', 'staffattendances.EntryDate','staffattendances.EntryTime','staffattendances.ExitTime','staffattendances.AttendedDuration','staffattendances.Status', 'locations.LocationName')->where("staffattendances.EntryDate",date("Y-m-d"))
            ->get();
		}
		else
		{
			$data["Attendances"] = DB::table('staffs')
            ->join('staffattendances', 'staffattendances.RegisteredID', '=', 'staffs.ID', 'left outer')
            ->join('locations', 'staffs.PlaceID', '=', 'locations.ID', 'left outer')
            ->select('staffs.IDNo','staffs.BiometricCode','staffs.Name','staffs.MobileNo','staffs.DOB', 'staffattendances.EntryDate','staffattendances.EntryTime','staffattendances.ExitTime','staffattendances.AttendedDuration','staffattendances.Status', 'locations.LocationName')->where("staffattendances.EntryDate",date("Y-m-d"))->where("staffs.PlaceID",$data["LocationID"])->get();
		}
		return view("StaffAttendance",$data);
	}
	public function StaffAttendanceSheet(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$PlaceID=$request["PlaceID"];
		$data["Title"]="Staff Attendance";
		$data["Attendances"] = DB::table('staffs')->select(DB::raw('*,0 as Status'))->where("PlaceID",$PlaceID)
            ->get();
		for($i=0;$i<sizeof($data["Attendances"]);$i++)
		{
			$Today=DB::table("staffattendances")->where("RegisteredID",$data["Attendances"][$i]->ID)->where("EntryDate",date("Y-m-d"))->get();
			if(sizeof($Today)==0)
			{
				$data["Attendances"][$i]->Status=0;
			}
			else
			{
				$data["Attendances"][$i]->Status=1;
			}
		}
		$data["PlaceID"]=$PlaceID;
		return view("StaffAttendanceForm",$data);
	}
	public function StaffAttendanceSave(Request $request)
	{
		$Attendance=new Staffattendance();
		$EntryDate=date("Y-m-d");
		$chkStaff=$request["chkStaff"];
		foreach($chkStaff as $Staff)
		{
			DB::table("staffattendances")->where("RegisteredID",$Staff)->where("EntryDate",$EntryDate)->delete();
			$StaffDetail=DB::table('staffs')->where('ID',$Staff)->get();
			$Attendance->EntryDate=$EntryDate;
			$Attendance->Category=2;
			$Attendance->RegisteredID=$Staff;
			$Attendance->RegisteredCode="";	
			$Attendance->PlaceID=$request["PlaceID"];
			$Attendance->EntryTime="";
			$Attendance->ExitTime="";
			$Attendance->AllPunches="";
			$Attendance->AttendedDuration="";	
			$Attendance->Status=1;
		}
		$Attendance->save();
		return redirect("StaffAttendance")->with("message","Attendance saved");
	}
	
	public function StudentAttendanceReport(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$FromDate=$request["FromDate"];
		$ToDate=$request["ToDate"];
		$PlaceID=$request["PlaceID"];
		$StudentID=$request["StudentID"];
		$Locations=DB::table("locations")->get();
		if($PlaceID=="")
		{
			$PlaceID=$Locations[0]->ID;
			return redirect("StudentAttendanceReport?FromDate=".$FromDate."&ToDate=".$ToDate."&PlaceID=".$PlaceID);
		}
		$Students=DB::table("students")->where("PlaceID",$PlaceID)->get();
		$data["FromDate"] = $FromDate;
		$data["ToDate"] = $ToDate;
		$data["PlaceID"] = $PlaceID;
		$data["StudentID"] = $StudentID;
		$data["Locations"] = $Locations;
		$data["Students"] = $Students;
		$data["Title"] = "Student Attendance Result";
		if($StudentID=="" || $StudentID==0)
		{
			$data["Attendances"] = DB::table('students')
            ->join('studentattendances', 'studentattendances.RegisteredID', '=', 'students.ID', 'left outer')
            ->select('students.ID','students.IDNo','students.BiometricCode','students.Name','students.MobileNo','students.DOB', 'studentattendances.Status','studentattendances.EntryDate')->where("students.PlaceID",$PlaceID)->whereBetween("studentattendances.EntryDate",[$FromDate,$ToDate])
            ->get();
		}
		else
		{
			$data["Attendances"] = DB::table('students')
            ->join('studentattendances', 'studentattendances.RegisteredID', '=', 'students.ID', 'left outer')
            ->select('students.ID','students.IDNo','students.BiometricCode','students.Name','students.MobileNo','students.DOB', 'studentattendances.Status','studentattendances.EntryDate')->where("students.PlaceID",$PlaceID)->whereBetween("studentattendances.EntryDate",[$FromDate,$ToDate])->where("students.ID",$StudentID)
            ->orderby("studentattendances.EntryDate")->get();
		}
		return view("StudentAttendanceReport",$data);
	}
	public function StaffAttendanceReport(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$FromDate=$request["FromDate"];
		$ToDate=$request["ToDate"];
		$PlaceID=$request["PlaceID"];
		$StaffID=$request["StaffID"];
		$Locations=DB::table("locations")->get();
		if($PlaceID=="")
		{
			$PlaceID=$Locations[0]->ID;
			return redirect("StaffAttendanceReport?FromDate=".$FromDate."&ToDate=".$ToDate."&PlaceID=".$PlaceID);
		}
		$Staffs=DB::table("staffs")->where("PlaceID",$PlaceID)->get();
		$data["FromDate"] = $FromDate;
		$data["ToDate"] = $ToDate;
		$data["PlaceID"] = $PlaceID;
		$data["StaffID"] = $StaffID;
		$data["Locations"] = $Locations;
		$data["Staffs"] = $Staffs;
		$data["Title"] = "Staff Attendance Result";
		if($StaffID=="" || $StaffID==0)
		{
			$data["Attendances"] = DB::table('staffs')
            ->join('staffattendances', 'staffattendances.RegisteredID', '=', 'staffs.ID', 'left outer')
            ->select('staffs.ID','staffs.Code','staffs.Designation','staffs.Name','staffs.MobileNo','staffs.DOB', 'staffattendances.Status','staffattendances.EntryDate')->where("staffs.PlaceID",$PlaceID)->whereBetween("staffattendances.EntryDate",[$FromDate,$ToDate])
            ->get();
		}
		else
		{
			$data["Attendances"] = DB::table('staffs')
            ->join('staffattendances', 'staffattendances.RegisteredID', '=', 'staffs.ID', 'left outer')
            ->select('staffs.ID','staffs.Code','staffs.Name','staffs.Designation','staffs.MobileNo','staffs.DOB', 'staffattendances.Status','staffattendances.EntryDate')->where("staffs.PlaceID",$PlaceID)->whereBetween("staffattendances.EntryDate",[$FromDate,$ToDate])->where("staffs.ID",$StaffID)
            ->orderby("staffattendances.EntryDate")->get();
		}
		return view("StaffAttendanceReport",$data);
	}
}
