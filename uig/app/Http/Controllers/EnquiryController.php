<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Enquiry;
use Sentinel;
class EnquiryController extends Controller
{
	public function Enquiries()
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Enquiries";
		if($data["UserType"]=='admin')
		{
		$data["Enquiries"]=DB::table('enquiries')->join('locations','enquiries.PlaceID','=','locations.ID')->select('enquiries.*','locations.LocationName')->get();
		}
		else
		{
			$data["Enquiries"]=DB::table('enquiries')->join('locations','enquiries.PlaceID','=','locations.ID')->select('enquiries.*','locations.LocationName')->where('enquiries.PlaceID',$data["LocationID"])->get();
		}
		return view("Enquiries",$data);
	}
    public function NewEnquiry()
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Add New Enquiry";
		$data["Locations"]=DB::table('locations')->get();
		return view("EnquiryRegistration",$data);
	}
	public function SaveEnquiry(Request $request)
	{
		$this->validate($request, [
			'PlaceID' => 'required',
			'Name' => 'required',
            'Email' => 'required',
            'ContactNo'=>'required',
            'Message' => 'required',
            'ReminderOn' => 'required',
        ]);
		$Enquiry=new Enquiry;
		$Enquiry->PlaceID=$request["PlaceID"];
		$Enquiry->Name=$request["Name"];
		$Enquiry->Email=$request["Email"];
		$Enquiry->ContactNo=$request["ContactNo"];
		$Enquiry->EnquiryDate=date("Y-m-d");
		$Enquiry->Message=$request["Message"];
		$Enquiry->ReminderOn=$request["ReminderOn"];
		$Enquiry->save();
		return redirect("/Enquiries")->with('message', 'Enquiry Saved!');
	}
	public function DeleteEnquiry(Request $request)
	{
		$ID=$request["ID"];
		DB::table('enquiries')->where("ID",$request["ID"])->delete();
		return redirect("/Enquiries")->with('message', 'Enquiry Deleted!');
	}
}
