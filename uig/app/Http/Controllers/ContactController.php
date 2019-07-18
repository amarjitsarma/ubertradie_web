<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Sentinel;
use DB;
class ContactController extends Controller
{
    public function Contacts(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Contacts"]=DB::table("contacts")->orderby("FullName")->get();
		$data["ID"]=$request["ID"];
		$data["FullName"]="";
		$data["ContactNo"]="";
		$data["EmailID"]="";
		$data["Detail"]="";
		if($data["ID"]!="")
		{
			$ContactDetail=DB::table("contacts")->where("ID",$data["ID"])->get();
			$data["FullName"]=$ContactDetail[0]->FullName;
			$data["ContactNo"]=$ContactDetail[0]->ContactNo;
			$data["EmailID"]=$ContactDetail[0]->EmailID;
			$data["Detail"]=$ContactDetail[0]->Detail;
		}
		$data["Title"]="Contacts";
		return view("Contacts",$data);
	}
	
	public function SaveContact(Request $request)
	{
		$this->validate($request, [
			'FullName' => 'required',
			'ContactNo' => 'required',
			'EmailID' => 'required',
            'Detail' => 'required',
        ]);
		$Contact=new Contact();
		$Contact->FullName=$request["FullName"];
		$Contact->ContactNo=$request["ContactNo"];
		$Contact->EmailID=$request["EmailID"];
		$Contact->Detail=$request["Detail"];
		$Contact->save();
		return redirect("/Contacts");
	}
	public function UpdateContact(Request $request)
	{
		$this->validate($request, [
			'FullName' => 'required',
			'ContactNo' => 'required',
			'EmailID' => 'required',
            'Detail' => 'required',
        ]);
		$ID=$request["ID"];
		$data=array("FullName"=>$request["FullName"], "ContactNo"=>$request["ContactNo"], "EmailID"=>$request["EmailID"], "Detail"=>$request["Detail"]);
		DB::table("contacts")->where("ID",$ID)->update($data);
		return redirect("/Contacts");
	}
	public function DeleteContact(Request $request)
	{
		$ID=$request["ID"];
		DB::table("contacts")->where("ID",$ID)->delete();
		return redirect("/Contacts");
	}
	public function SendMessageToContact(Request $request)
	{
		$Contacts=$request["chkContact"];
		$List="";
		if($Contacts!=null)
		{
			foreach($Contacts as $Contact)
			{
				if($List=="")
				{
					$List=$Contact;
				}
				else
				{
					$List=$List.", ".$Contact;
				}
				$api_key = '5573043D93269B';
				$contacts = $List;
				$from = 'UNIUFC';
				$sms_text="";
				$sms_text = urlencode($request["Message"]);
				$api_url = "http://bulksms.24techsoft.com/api/sendmsg.php?user=uig&pass=123456&sender=UNIUFC&phone=".$contacts."&text=".$sms_text."&priority=Priority&stype=normal";
				//$api_url = "http://sms.24techsoft.com/app/smsapi/index.php?key=".$api_key."&campaign=0&routeid=7&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;
				$response = file_get_contents( $api_url);
			}
		}
		return redirect("/Contacts");
	}
}
