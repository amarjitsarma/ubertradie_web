<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tagline;
class TaglineController extends Controller
{
    public function Taglines(Request $request){
		$data["Title"]="Taglines";
		$data["Taglines"]=DB::table("taglines")->orderby("tagline")->get();
		$data["ID"]="";
		$data["tagline"]="";
		if(isset($request["ID"]))
		{
			$Tagline=DB::table("taglines")->where("ID",$request["ID"])->first();
			$data["ID"]=$Tagline->id;
			$data["tagline"]=$Tagline->tagline;
		}
		return view("Taglines",$data);
	}
	public function SaveTagline(Request $request){
		$Tagline=new Tagline();
		$Tagline->tagline=$request->tagline;
		$Tagline->save();
		return redirect("/Taglines")->with('message', 'Tagline Saved!');
	}
	public function UpdateTagline(Request $request){
		$ID=$request->ID;
		$data["tagline"]=$request->tagline;
		DB::table("taglines")->where("id",$ID)->update($data);
		return redirect("/Taglines")->with('message', 'Tagline Updated!');
	}
	public function DeleteTagline(Request $request){
		$ID=$request->ID;
		DB::table("taglines")->where("id",$ID)->delete();
		return redirect("/Taglines")->with('message', 'Tagline Deleted!');
	}
	public function GetTaglinesAPI(Request $request)
	{
		$Taglines=DB::table("taglines")->orderby("tagline")->get();
		return response()->json(['Taglines'=>$Taglines]);
	}
	public function SaveTaglinesAPI(Request $request)
	{
		$Tagline=new Tagline();
		$Tagline->tagline=$request->tagline;
		$Tagline->save();
		return response()->json(['status'=>'Done!']);
	}
}
