<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Package;
use Sentinel;
class PackageController extends Controller
{
    public function Packages(Request $request)
	{
		// ID PackageName	Price	Duration
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$Packages=DB::table('packages')->get();
		$Package=DB::table('packages')->where('ID',$request["ID"])->get();
		$data["PackageName"]="";
		$data["Price"]="";
		$data["PersonalTrainer"]="";
		$data["Duration"]="";
		if(sizeof($Package)>0)
		{
			$data["PackageName"]=$Package[0]->PackageName;
			$data["Price"]=$Package[0]->Price;
			$data["PersonalTrainer"]=$Package[0]->PersonalTrainer;
			$data["Duration"]=$Package[0]->Duration;
		}
		$data["Title"]="Package";
		$data["Packages"]=$Packages;
		$data["Package"]=$Package;
    	return view('Packages',$data);
	}
	public function SavePackage(Request $request)
	{
		// ID PackageName	Price	Duration
		$this->validate($request, [
			'PackageName' => 'required',
            'Price'=>'required',
			'Duration' => 'required',
        ]);
		$Package= new Package();
		$Package->PackageName = $request["PackageName"];
		$Package->Price = $request["Price"];
		$Package->PersonalTrainer = $request["PersonalTrainer"];
		$Package->Duration = $request["Duration"];
		$Package->save();
        return redirect('/Packages')->with('message', 'Package Saved!');
	}
	public function UpdatePackage(Request $request)
	{
		$this->validate($request, [
			'PackageName' => 'required|min:3|max:100',
            'Price'=>'required|min:3|max:200',
			'PersonalTrainer'=>'required|min:2|max:200',
			'Duration' => 'required|min:1|max:10',
        ]);
		$data=["PackageName"=>$request["PackageName"], "Price"=>$request["Price"], "PersonalTrainer"=>$request["PersonalTrainer"], "Duration"=>$request["Duration"]];
		DB::table("packages")->where("ID",$request["ID"])->update($data);
        return redirect('/Packages')->with('message', 'Package Updated!');;
	}
	public function DeletePackage(Request $request)
	{
		$ID=$request["ID"];
		DB::table("packages")->where("ID",$ID)->delete();
		return redirect('/Packages')->with('message', 'Package Deleted!');
	}
	public function GetPackageDetail(Request $request)
	{
		$ID=$request["ID"];
		$Packages=DB::table('packages')->where("ID",$ID)->get();
		return json_encode($Packages);
	}
}
