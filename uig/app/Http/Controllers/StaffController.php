<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Staff;
use Sentinel;
class StaffController extends Controller
{
	public function Staffs()
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		if($data["UserType"]=="admin")
		{
			$data["Staffs"]=DB::table('staffs')
            ->join('locations', 'staffs.PlaceID', '=', 'locations.ID', 'left outer')
            ->select('staffs.*', 'locations.LocationName')
            ->get();
		}
		else
		{
			$data["Staffs"]=DB::table('staffs')
            ->join('locations', 'staffs.PlaceID', '=', 'locations.ID', 'left outer')
            ->select('staffs.*', 'locations.LocationName')->where("PlaceID",$data["LocationID"])
            ->get();
		}
		$data["Title"]="Staffs";
    	return view('Staffs',$data);
	}
    public function StaffRegistration(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$ID=$request["ID"];
		$data["Title"]="Staff Registration";
		if($ID=="")
		{
			$ID=0;
		}
		$Staff=DB::table('staffs')->where('ID',$request["ID"])->get();
		$data["PlaceID"]="";
		$data["IDNo"]="";
		$data["BiometricCode"]="";
		$data["Name"]="";
		$data["Address"]="";
		$data["Age"]="";
		$data["DOB"]="";
		$data["Sex"]="";
		$data["MobileNo"]="";
		$data["Designation"]="";
		$data["EmergencyPerson"]="";
		$data["EmergencyContactNo"]="";
		$data["JoiningDate"]="";
		$data["MaritalStatus"]="";
		$data["BloodGroup"]="";
		$data["AnyMedicalHistory"]="";
		$data["Salary"]="";
		$data["AbsentPenalty"]="";
		$data["WorkDays"]="";
		if(sizeof($Staff)>0)
		{
			$data["PlaceID"]=$Staff[0]->PlaceID;
			$data["IDNo"]=$Staff[0]->IDNo;
			$data["BiometricCode"]=$Staff[0]->BiometricCode;
			$data["Name"]=$Staff[0]->Name;
			$data["Address"]=$Staff[0]->Address;
			$data["Age"]=$Staff[0]->Age;
			$data["DOB"]=$Staff[0]->DOB;
			$data["Sex"]=$Staff[0]->Sex;
			$data["MobileNo"]=$Staff[0]->MobileNo;
			$data["Designation"]=$Staff[0]->Designation;
			$data["EmergencyPerson"]=$Staff[0]->EmergencyPerson;
			$data["EmergencyContactNo"]=$Staff[0]->EmergencyContactNo;
			$data["JoiningDate"]=$Staff[0]->JoiningDate;
			$data["MaritalStatus"]=$Staff[0]->MaritalStatus;
			$data["BloodGroup"]=$Staff[0]->BloodGroup;
			$data["AnyMedicalHistory"]=$Staff[0]->AnyMedicalHistory;
			$data["Salary"]=$Staff[0]->Salary;
			$data["AbsentPenalty"]=$Staff[0]->AbsentPenalty;
			$data["WorkDays"]=$Staff[0]->WorkDays;
		}
		$data["Locations"]=DB::table('locations')->get();
		return view('StaffRegistration',$data);
	}
	public function SaveStaff(Request $request)
	{
		$this->validate($request, [
			'PlaceID' => 'required',
			'IDNo' => 'required',
			'BiometricCode' => 'required',
            'Name' => 'required',
            'Address'=>'required',
            'Age' => 'required',
            'DOB' => 'required',
            'Sex' => 'required',
			'MobileNo' => 'required',
			'Designation' => 'required',
			'EmergencyPerson' => 'required',
			'EmergencyContactNo' => 'required',
			'JoiningDate' => 'required',
			'MaritalStatus' => 'required',
			'BloodGroup' => 'required',
			'Salary' => 'required',
			'AbsentPenalty' => 'required',
			'WorkDays' => 'required',
			'Photo'=>'required'
        ]);
		$file_data = $request->input('Photo'); 
	    $file_name = 'image_'.time().'.jpg'; //generating unique file name; 
	    @list($type, $file_data) = explode(';', $file_data);
	    @list(, $file_data) = explode(',', $file_data);
		if($file_data != ''){
			$destinationPath = public_path('StaffPhotos')."/".$file_name;
			file_put_contents($destinationPath, base64_decode($file_data));
		}
		$Staff= new Staff();
		$Staff->PlaceID = $request["PlaceID"];
		$Staff->IDNo = $request["IDNo"];
		$Staff->BiometricCode = $request["BiometricCode"];
		$Staff->Name = $request["Name"];
		$Staff->Address = $request["Address"];
		$Staff->Age = $request["Age"];
		$Staff->DOB = $request["DOB"];
		$Staff->Sex = $request["Sex"];
		$Staff->MobileNo = $request["MobileNo"];
		$Staff->Designation = $request["Designation"];
		$Staff->EmergencyPerson = $request["EmergencyPerson"];
		$Staff->EmergencyContactNo = $request["EmergencyContactNo"];
		$Staff->JoiningDate = $request["JoiningDate"];
		$Staff->MaritalStatus = $request["MaritalStatus"];
		$Staff->BloodGroup = $request["BloodGroup"];
		$Staff->AnyMedicalHistory = $request["AnyMedicalHistory"];
		$Staff->Salary = $request["Salary"];
		$Staff->AbsentPenalty = $request["AbsentPenalty"];
		$Staff->WorkDays = $request["WorkDays"];
		$Staff->Photo = "/StaffPhotos/".$file_name;
		$Staff->save();
        return redirect('/Staffs')->with('message', 'Staff Saved!');;
	}
	public function UpdateStaff(Request $request)
	{
		$this->validate($request, [
			'PlaceID' => 'required',
			'IDNo' => 'required',
			'BiometricCode' => 'required',
            'Name' => 'required',
            'Address'=>'required',
            'Age' => 'required',
            'DOB' => 'required',
            'Sex' => 'required',
			'MobileNo' => 'required',
			'Designation' => 'required',
			'EmergencyPerson' => 'required',
			'EmergencyContactNo' => 'required',
			'JoiningDate' => 'required',
			'MaritalStatus' => 'required',
			'BloodGroup' => 'required',
			'Salary' => 'required',
			'AbsentPenalty' => 'required',
			'WorkDays' => 'required',
        ]);
		$data=["PlaceID"=>$request["PlaceID"], "IDNo"=>$request["IDNo"], "BiometricCode"=>$request["BiometricCode"], "Name"=>$request["Name"], "Address"=>$request["Address"], "Age"=>$request["Age"], "DOB"=>$request["DOB"], "Sex"=>$request["Sex"], "MobileNo"=>$request["MobileNo"], "Designation"=>$request["Designation"], "EmergencyPerson"=>$request["EmergencyPerson"], "EmergencyContactNo"=>$request["EmergencyContactNo"], "JoiningDate"=>$request["JoiningDate"], "MaritalStatus" => $request["MaritalStatus"], "BloodGroup"=>$request["BloodGroup"], "AnyMedicalHistory"=>$request["AnyMedicalHistory"],"Salary"=>$request["Salary"],"AbsentPenalty"=>$request["AbsentPenalty"],"WorkDays"=>$request["WorkDays"], "Photo"=>"/StaffPhotos/".$file_name];
		$file_data = $request->input('Photo'); 
	    $file_name = 'image_'.time().'.jpg'; //generating unique file name; 
	    @list($type, $file_data) = explode(';', $file_data);
	    @list(, $file_data) = explode(',', $file_data);
		if($file_data != ''){
			$destinationPath = public_path('StudentPhotos')."/".$file_name;
			file_put_contents($destinationPath, base64_decode($file_data));
			$data["Photo"]="/StaffPhotos/".$file_name;
		}
		DB::table("staffs")->where("ID",$request["ID"])->update($data);
        return redirect('/Staffs')->with('message', 'Staff Updated!');;
	}
	public function DeleteStaff(Request $request)
	{
		$ID=$request["ID"];
		DB::table("staffs")->where("ID",$ID)->delete();
		return redirect('/Staffs')->with('message', 'Staff Deleted!');
	}
}
