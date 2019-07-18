<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Location;
use Sentinel;
class LocationController extends Controller
{
    public function Locations(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$Locations=DB::table('locations')->get();
		$Location=DB::table('locations')->where('ID',$request["ID"])->get();
		$data["LocationName"]="";
		$data["FullAddress"]="";
		$data["ContactNo"]="";
		$data["EmailID"]="";
		if(sizeof($Location)>0)
		{
			$data["LocationName"]=$Location[0]->LocationName;
			$data["FullAddress"]=$Location[0]->FullAddress;
			$data["ContactNo"]=$Location[0]->ContactNo;
			$data["EmailID"]=$Location[0]->EmailID;
		}
		$data["Title"]="Locations";
		$data["Locations"]=$Locations;
		$data["Location"]=$Location;
    	return view('Places',$data);
	}
	public function SaveLocation(Request $request)
	{
		//ID	LocationName	FullAddress	ContactNo	EmailID	
		$this->validate($request, [
			'LocationName' => 'required|min:3|max:100',
            'FullAddress'=>'required|min:10|max:200',
			'ContactNo' => 'required|min:10|max:10',
			'EmailID' => 'required|min:6',
        ]);
		$Location= new Location();
		$Location->LocationName = $request["LocationName"];
		$Location->FullAddress = $request["FullAddress"];
		$Location->ContactNo = $request["ContactNo"];
		$Location->EmailID = $request["EmailID"];
		$Location->save();
        return redirect('/Places')->with('message', 'Location Saved!');
	}
	public function UpdateStudent(Request $request)
	{
		$this->validate($request, [
			'LocationName' => 'required|min:3|max:100',
            'FullAddress'=>'required|min:10|max:200',
			'ContactNo' => 'required|min:10|max:10',
			'EmailID' => 'required|min:6',
        ]);
		$data=["LocationName"=>$request["LocationName"], "FullAddress"=>$request["FullAddress"], "ContactNo"=>$request["ContactNo"], "EmailID"=>$request["EmailID"]];
		DB::table("locations")->where("ID",$request["ID"])->update($data);
        return redirect('/Places')->with('message', 'Location Updated!');;
	}
	public function DeleteLocation(Request $request)
	{
		$ID=$request["ID"];
		DB::table("locations")->where("ID",$ID)->delete();
		return redirect('/Places')->with('message', 'Location Deleted!');
	}
}
