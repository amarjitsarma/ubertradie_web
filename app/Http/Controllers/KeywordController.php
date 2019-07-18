<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Keyword;
class KeywordController extends Controller
{
    public function Keywords(Request $request){
		$data["Title"]="Keywords";
		$data["Keywords"]=DB::table("keywords")->orderby("keyword")->get();
		$data["ID"]="";
		$data["keyword"]="";
		if(isset($request["ID"]))
		{
			$Keyword=DB::table("keywords")->where("ID",$request["ID"])->first();
			$data["ID"]=$Keyword->id;
			$data["keyword"]=$Keyword->keyword;
		}
		return view("Keywords",$data);
	}
	public function SaveKeyword(Request $request){
		$Keyword=new Keyword();
		$Keyword->keyword=$request->keyword;
		$Keyword->save();
		return redirect("/Keywords")->with('message', 'Keyword Saved!');
	}
	public function UpdateKeyword(Request $request){
		$ID=$request->ID;
		$data["Keyword"]=$request->keyword;
		DB::table("keywords")->where("id",$ID)->update($data);
		return redirect("/Keywords")->with('message', 'Keyword Updated!');
	}
	public function DeleteKeyword(Request $request){
		$ID=$request->ID;
		DB::table("keywords")->where("id",$ID)->delete();
		return redirect("/Keywords")->with('message', 'Keyword Deleted!');
	}
	public function GetKeywordsAPI(Request $request)
	{
		$Keywords=DB::table("keywords")->orderby("keyword")->get();
		return response()->json(['Keywords'=>$Keywords]);
	}
	public function SaveKeywordAPI(Request $request)
	{
		$Keyword=new Keyword();
		$Keyword->keyword=$request->keyword;
		$Keyword->save();
		return response()->json(['status'=>'Done!']);
	}
}
