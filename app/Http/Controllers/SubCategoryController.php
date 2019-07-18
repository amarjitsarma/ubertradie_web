<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\SubCategory;
class SubCategoryController extends Controller
{
    public function SubCategories(Request $request){
		$data["Title"]="Sub Categories";
		$data["Categories"]=DB::table("categories")->orderby("CategoryName")->get();
		$data["SubCategories"]=DB::table("sub_categories")->orderby("SubCategoryName")->get();

		$data["ID"]="";
		$data["CategoryID"]="";
		$data["SubCategoryName"]="";
		$data["Icon"]="";
		$data["cover_photo"]="";
		$data["short_desc"]="";
		$data["description"]="";
		if(isset($request["ID"]))
		{
			$Category=DB::table("sub_categories")->where("ID",$request["ID"])->first();
			$data["ID"]=$Category->ID;
			$data["CategoryID"]=$Category->CategoryID;
			$data["SubCategoryName"]=$Category->SubCategoryName;
			$data["Icon"]=$Category->Icon;
			$data["cover_photo"]=$Category->cover_photo;
			$data["short_desc"]=$Category->short_desc;
			$data["description"]=$Category->description;
		}
		return view("SubCategories",$data);
	}
	public function SaveSubCategory(Request $request){
		$SubCategory=new SubCategory();
		$destinationPath = 'uploads';	
		$Icon = $request->file('Icon');
		$cover_photo = $request->file('cover_photo');
		if(isset($cover_photo))
		{
			$cover_photo_ext=$cover_photo->getClientOriginalExtension();
			$cover_photo_name="cover_photo".time().".".$cover_photo_ext;
			$cover_photo->move($destinationPath,$cover_photo_name);
			$SubCategory->cover_photo=$cover_photo_name;
		}
		if(isset($Icon))
		{
			$Icon_ext=$Icon->getClientOriginalExtension();
			$Icon_name="Icon".time().".".$Icon_ext;
			$Icon->move($destinationPath,$Icon_name);
			$SubCategory->Icon=$Icon_name;
		}
		$SubCategory->CategoryID=$request->CategoryID;
		$SubCategory->SubCategoryName=$request->SubCategoryName;
		$SubCategory->short_desc=$request->short_desc;
		$SubCategory->description=$request->description;
		$SubCategory->save();
		return redirect("/SubCategories")->with('message', 'Sub Category Saved!');
	}
	public function UpdateSubCategory(Request $request){
		$ID=$request->ID;
		$destinationPath = 'uploads';	
		$cover_photo = $request->file('cover_photo');
		$Icon = $request->file('Icon');
		if(isset($cover_photo))
		{
			$cover_photo_ext=$cover_photo->getClientOriginalExtension();
			$cover_photo_name="cover_photo".time().".".$cover_photo_ext;
			$cover_photo->move($destinationPath,$cover_photo_name);
			$data["cover_photo"]=$cover_photo_name;
		}
		if(isset($Icon))
		{
			$Icon=$Icon->getClientOriginalExtension();
			$Icon_name="Icon".time().".".$Icon_ext;
			$Icon->move($destinationPath,$Icon_name);
			$data["Icon"]=$Icon_name;
		}
		$data["CategoryID"]=$request->CategoryID;
		$data["SubCategoryName"]=$request->SubCategoryName;
		$data["short_desc"]=$request->short_desc;
		$data["description"]=$request->description;
		DB::table("sub_categories")->where("ID",$ID)->update($data);
		return redirect("/SubCategories")->with('message', 'Sub Category Updated!');
	}
	public function DeleteSubCategory(Request $request){
		$ID=$request->ID;
		DB::table("sub_categories")->where("ID",$ID)->delete();
		return redirect("/SubCategories")->with('message', 'Sub Category Deleted!');
	}
	
	//API
	public function GetSubCategoriesAPI(Request $request)
	{
		$ID=$request->ID;
		$SubCategories=DB::table("sub_categories")->where("CategoryID",$ID)->orderby("SubCategoryName")->get();
		return response()->json(["SubCategories"=>$SubCategories]);
	}
}
