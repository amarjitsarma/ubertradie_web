<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\FlBasic;
use App\FlAbout;
use App\FlContact;
use App\FlKeyword;
use App\FlPhoto;
use App\FlService;
use App\FlTagline;
use App\FlWorkingHour;
class FreelanceController extends Controller
{
    
	
	//API
	public function SaveFreeLanceBasicAPI(Request $request)
	{
		$FlBasic=new FlBasic();
		$device_id=$request["device_id"];
		$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
		$FlBasic->user_id=$Login->UserID;
		$FlBasic->category=$request["category"];
		$FlBasic->sub_category=$request["sub_category"];
		$FlBasic->fullname=$request["fullname"];
		$FlBasic->location=$request["location"];
		$FlBasic->house_no=$request["house_no"];
		$FlBasic->street_name=$request["street_name"];
		$FlBasic->suburb=$request["suburb"];
		$FlBasic->state=$request["state"];
		$FlBasic->code=$request["code"];
		$FlBasic->postcode=$request["postcode"];
		$FlBasic->status=0;
		$FlBasic->save();
		$id=$FlBasic->id;
		return response()->json(['id'=>$id]);
	}
	public function GetFreeLanceBasicAPI(Request $request)
	{
		$basic_id=$request["basic_id"];
		$Basic=DB::table("fl_basic")->where("id",$basic_id)->first();
		return response()->json(['Basic'=>$Basic]);
	}
	
	public function SaveWorkingHoursAPI(Request $request)
	{
		$FlWorkingHour=new FlWorkingHour(); 	 	 	
		$FlWorkingHour->fl_basic_id=$request["fl_basic_id"];
		$FlWorkingHour->monday=$request["monday"];
		$FlWorkingHour->tuesday=$request["tuesday"];
		$FlWorkingHour->wednessday=$request["wednessday"];
		$FlWorkingHour->thursday=$request["thursday"];
		$FlWorkingHour->friday=$request["friday"];
		$FlWorkingHour->saturday=$request["saturday"];
		$FlWorkingHour->sunday=$request["sunday"];
		$FlWorkingHour->save();
		$id=$FlWorkingHour->id;
		return response()->json(['id'=>$id]);
	}
	public function GetWorkingHoursAPI(Request $request)
	{
		$basic_id=$request["basic_id"];
		$WorkingHour=DB::table("fl_working_hours")->where("basic_id",$basic_id)->first();
		return response()->json(['WorkingHour'=>$WorkingHour]);
	}
	
	public function SaveContactAPI(Request $request)
	{
		$FlContact=new FlContact(); 	 	 	 	 	 	 	 	
		$FlContact->fl_basic_id=$request["fl_basic_id"];
		$FlContact->phone=$request["phone"];
		$FlContact->mobile=$request["mobile"];
		$FlContact->email=$request["email"];
		$FlContact->website=$request["website"];
		$FlContact->contact_name=$request["contact_name"];
		$FlContact->save();
		$id=$FlContact->id;
		return response()->json(['id'=>$id]);
	}
	public function GetContactAPI(Request $request)
	{
		$basic_id=$request["basic_id"];
		$Contact=DB::table("fl_contact")->where("basic_id",$basic_id)->first();
		return response()->json(['Contact'=>$Contact]);
	}
	
	public function SavePhotoAPI(Request $request)
	{
		$FlPhoto=new FlPhoto(); 	
		$ID=$request["basic_id"];
        $Photos=$request["Photos"];
        for($i=0; $i<count($Photos); $i++){
            $image = $Photos[$i];
            preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
            $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
            $image = str_replace(' ', '+', $image);
            $imageName = 'fl_photo_' . time().'.' . $image_extension[1]; //generating unique file name;
            $success = file_put_contents('./uploads/'.$imageName, base64_decode($image));
			$FlPhoto->fl_basic_id=$ID;
            $FlPhoto->title=$request["title"];
			$FlPhoto->Photo=$imageName;
			$FlPhoto->save();
        }
		return response()->json(['status'=>'Done!']);
	}
	public function GetPhotosAPI(Request $request)
	{
		$ID=$request["basic_id"];
		$Photos=DB::table("fl_photos")->where("fl_basic_id",$ID)->orderby("id")->get();
		return response()->json(['Photos'=>$Photos]);
	}
	public function SaveAboutAPI(Request $request)
	{
		$FlAbout=new FlAbout();
		$FAbout->fl_basic_id=$request["fl_basic_id"];
		$FAbout->short_desc=$request["short_desc"];
		$FAbout->about=$request["about"];
		$FAbout->save();
		return response()->json(['status'=>'Done!']);
	}
	public function GetAboutAPI(Request $request)
	{
		$basic_id=$request["basic_id"];
		$About=DB::table("fl_about")->where("basic_id",$basic_id)->first();
		return response()->json(['About'=>$About]);
	}
	
	public function SaveServiceAPI(Request $request)
	{
		$FlService=new FlService();
		$FlService->fl_basic_id=$request["fl_basic_id"];
		$FlService->service=$request["service"];
		$FAbout->save();
		return response()->json(['status'=>'Done!']);
	}
	public function GetServiceAPI(Request $request)
	{
		$basic_id=$request["basic_id"];
		$Service=DB::table("fl_services")->where("basic_id",$basic_id)->first();
		return response()->json(['Service'=>$Service]);
	}
	
	public function SaveTaglineAPI(Request $request)
	{
		$FlTagline=new FlTagline();
		$FlTagline->fl_basic_id=$request["fl_basic_id"];
		$FlTagline->tagline=$request["tagline"];
		$FlTagline->save();
		return response()->json(['status'=>'Done!']);
	}
	public function GetTaglineAPI(Request $request)
	{
		$ID=$request["fl_basic_id"];
		$Taglines=DB::table("fl_tagline")->where("fl_basic_id",$ID)->orderby("tagline")->get();
		return response()->json(['Taglines'=>$Taglines]);
	}
	public function SaveKeywordAPI(Request $request)
	{
		$FlKeyword=new FlKeyword();
		$FlKeyword->fl_basic_id=$request["fl_basic_id"];
		$FlKeyword->keyword=$request["keyword"];
		$FlKeyword->save();
		return response()->json(['status'=>'Done!']);
	}
	public function GetKeywordsAPI(Request $request)
	{
		$ID=$request["fl_basic_id"];
		$Keywords=DB::table("fl_keywords")->where("fl_basic_id",$ID)->orderby("keyword")->get();
		return response()->json(['Keywords'=>$Keywords]);
	}
}
