<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Category;
class CategoryController extends Controller
{
    public function Categories(Request $request){
		$data["Title"]="Categories";
		$data["Categories"]=DB::table("categories")->orderby("CategoryName")->get();
		$data["ID"]="";
		$data["CategoryName"]="";
		$data["description"]="";
		$data["cover_photo"]="";
		$data["thumbnail"]="";
		if(isset($request["ID"]))
		{
			$Category=DB::table("categories")->where("ID",$request["ID"])->first();
			$data["ID"]=$Category->ID;
			$data["CategoryName"]=$Category->CategoryName;
			$data["description"]=$Category->description;
			$data["cover_photo"]=$Category->cover_photo;
			$data["thumbnail"]=$Category->thumbnail;
		}
		return view("Categories",$data);
	}
	public function SaveCategory(Request $request){
		$Category=new Category();
		$destinationPath = 'uploads';	
		$cover_photo = $request->file('cover_photo');
		$thumbnail = $request->file('thumbnail');
		if(isset($cover_photo))
		{
			$cover_photo_ext=$cover_photo->getClientOriginalExtension();
			$cover_photo_name="cover_photo".time().".".$cover_photo_ext;
			$cover_photo->move($destinationPath,$cover_photo_name);
			$Category->cover_photo=$cover_photo_name;
		}
		if(isset($thumbnail))
		{
			$thumbnail_ext=$thumbnail->getClientOriginalExtension();
			$thumbnail_name="thumbnail".time().".".$thumbnail_ext;
			$thumbnail->move($destinationPath,$thumbnail_name);
			$Category->thumbnail=$thumbnail_name;
		}
		$Category->CategoryName=$request->CategoryName;
		$Category->description=$request->description;
		$Category->save();
		return redirect("/Categories")->with('message', 'Category Saved!');
	}
	public function UpdateCategory(Request $request){
		$ID=$request->ID;
		$destinationPath = 'uploads';	
		$cover_photo = $request->file('cover_photo');
		$thumbnail = $request->file('thumbnail');
		if(isset($cover_photo))
		{
			$cover_photo_ext=$cover_photo->getClientOriginalExtension();
			$cover_photo_name="cover_photo".time().".".$cover_photo_ext;
			$cover_photo->move($destinationPath,$cover_photo_name);
			$data["cover_photo"]=$cover_photo_name;
		}
		if(isset($thumbnail))
		{
			$thumbnail_ext=$thumbnail->getClientOriginalExtension();
			$thumbnail_name="thumbnail".time().".".$thumbnail_ext;
			$thumbnail->move($destinationPath,$thumbnail_name);
			$data["thumbnail"]=$thumbnail_name;
		}
		$data["CategoryName"]=$request->CategoryName;
		$data["description"]=$request->description;
		DB::table("categories")->where("ID",$ID)->update($data);
		return redirect("/Categories")->with('message', 'Category Updated!');
	}
	public function DeleteCategory(Request $request){
		$ID=$request->ID;
		DB::table("categories")->where("ID",$ID)->delete();
		return redirect("/Categories")->with('message', 'Category Deleted!');
	}
	//API
	public function GetAllCategoriesAPI(Request $request)
	{
		$Categories=DB::table("categories")->orderby("CategoryName")->get();
		return response()->json(["Categories"=>$Categories]);
	}
}
