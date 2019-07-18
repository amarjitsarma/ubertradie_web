<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Student;
use Sentinel;
use App\studentpayment;
class StudentController extends Controller
{
	public function Students()
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		if($data["UserType"]=="admin")
		{
			$data["Students"]=DB::table('students')
            ->join('locations', 'students.PlaceID', '=', 'locations.ID', 'left outer')
			->join('packages','students.Program','=','packages.ID')
            ->select('students.*', 'locations.LocationName','packages.PackageName')
            ->get();
		}
		else
		{
			$data["Students"]=DB::table('students')
            ->join('locations', 'students.PlaceID', '=', 'locations.ID', 'left outer')
			->join('packages','students.Program','=','packages.ID')
            ->select('students.*', 'locations.LocationName','packages.PackageName')->where("students.PlaceID",$data["LocationID"])->get();
		}
		$data["Title"]="Students";
    	return view('Students',$data);
	}
    public function StudentRegistration(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$ID=$request["ID"];
		$data["Title"]="Student Registration";
		if($ID=="")
		{
			$ID=0;
		}
		$data["PlaceID"] = "";
		$data["IDNo"]="";
		$data["BiometricCode"] = "";
		$data["Name"] = "";
		$data["Address"] = "";
		$data["Age"] = "";
		$data["DOB"] = "";
		$data["Sex"] = "";
		$data["HomePhone"] = "";
		$data["MobileNo"] = "";
		$data["WorkPlace"] = "";
		$data["Designation"] = "";
		$data["EmergencyPerson"] = "";
		$data["EmergencyContactNo"] = "";
		$data["HowYouKnow"] = "";
		$data["Program"] = "";
		$data["StartDate"] = date("Y-m-d");
		$data["ExpiryDate"] = "";
		$data["MaritalStatus"] = "";
		$data["BloodGroup"] = "";
		$data["AnyMedicalHistory"] = "";
		$data["PersonalTrainer"] = "";
		$data["ProgramFees"] = "";
		$data["PersonalTrainerFees"] = "";
		$data["ReceiptNo"] = "";
		$data["Photo"]="";
		$data["IDProof"]="";
		$Student=DB::table('students')->where("ID",$ID)->get();
		if(sizeof($Student)>0)
		{
			$data["PlaceID"] = $Student[0]->PlaceID;
			$data["IDNo"] = $Student[0]->IDNo;
			$data["BiometricCode"] = $Student[0]->BiometricCode;
			$data["Name"] = $Student[0]->Name;
			$data["Address"] = $Student[0]->Address;
			$data["Age"] = $Student[0]->Age;
			$data["DOB"] = $Student[0]->DOB;
			$data["Sex"] = $Student[0]->Sex;
			$data["HomePhone"] = $Student[0]->HomePhone;
			$data["MobileNo"] = $Student[0]->MobileNo;
			$data["WorkPlace"] = $Student[0]->WorkPlace;
			$data["Designation"] = $Student[0]->Designation;
			$data["EmergencyPerson"] = $Student[0]->EmergencyPerson;
			$data["EmergencyContactNo"] = $Student[0]->EmergencyContactNo;
			$data["HowYouKnow"] = $Student[0]->HowYouKnow;
			$data["Program"] = $Student[0]->Program;
			$data["StartDate"] = $Student[0]->StartDate;
			$data["ExpiryDate"] = $Student[0]->ExpiryDate;
			$data["MaritalStatus"] = $Student[0]->MaritalStatus;
			$data["BloodGroup"] = $Student[0]->BloodGroup;
			$data["AnyMedicalHistory"] = $Student[0]->AnyMedicalHistory;
			$data["PersonalTrainer"] = $Student[0]->PersonalTrainer;
			$data["ProgramFees"] = $Student[0]->ProgramFees;
			$data["PersonalTrainerFees"] = $Student[0]->PersonalTrainerFees;
			$data["ReceiptNo"] = $Student[0]->ReceiptNo;
			$data["Photo"]=$Student[0]->Photo;
			$data["IDProof"]=$Student[0]->IDProof;
		}
		$data["Locations"]=DB::table('locations')->get();
		$data["Packages"]=DB::table('packages')->get();
		$data["Trainers"]=DB::table('staffs')->where("Designation","Trainer")->where("PlaceID",$data["LocationID"])->get();
		return view('StudentRegistrationForm',$data);
	}
	public function SaveStudent(Request $request)
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
            'HomePhone' => 'required',
			'MobileNo' => 'required',
			'WorkPlace' => 'required',
			'Designation' => 'required',
			'EmergencyPerson' => 'required',
			'EmergencyContactNo' => 'required',
			'Program' => 'required',
			'StartDate' => 'required',
			'ExpiryDate' => 'required',
			'MaritalStatus' => 'required',
			'BloodGroup' => 'required',
			'PersonalTrainer' => 'required',
			'ProgramFees' => 'required',
			'PersonalTrainerFees' => 'required',
			'ReceiptNo'=>'required',
			'Photo'=>'required',
			'IDProof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
		//dd($request->all());
		$file_data = $request->input('Photo'); 
	    $file_name = 'image_'.time().'.jpg'; //generating unique file name; 
	    @list($type, $file_data) = explode(';', $file_data);
	    @list(, $file_data) = explode(',', $file_data);
		if($file_data != ''){
			$destinationPath = public_path('StudentPhotos')."/".$file_name;
			file_put_contents($destinationPath, base64_decode($file_data));
		}
		$image = $request->file('IDProof');
		$IDProof = time().'.'.$image->getClientOriginalExtension();
		$destinationPath = public_path('StudentPhotos');
		$image->move($destinationPath, $IDProof);

		$Student= new Student();
		$Student->PlaceID = $request["PlaceID"];
		$Student->IDNo = $request["IDNo"];
		$Student->BiometricCode = $request["BiometricCode"];
		$Student->Name = $request["Name"];
		$Student->Address = $request["Address"];
		$Student->Age = $request["Age"];
		$Student->DOB = $request["DOB"];
		$Student->Sex = $request["Sex"];
		$Student->HomePhone = $request["HomePhone"];
		$Student->MobileNo = $request["MobileNo"];
		$Student->WorkPlace = $request["WorkPlace"];
		$Student->Designation = $request["Designation"];
		$Student->EmergencyPerson = $request["EmergencyPerson"];
		$Student->EmergencyContactNo = $request["EmergencyContactNo"];
		$Student->HowYouKnow = $request["HowYouKnow"];
		$Student->Program = $request["Program"];
		$Student->StartDate = $request["StartDate"];
		$Student->ExpiryDate = $request["ExpiryDate"];
		$Student->MaritalStatus = $request["MaritalStatus"];
		$Student->BloodGroup = $request["BloodGroup"];
		$Student->AnyMedicalHistory = $request["AnyMedicalHistory"];
		$Student->PersonalTrainer = $request["PersonalTrainer"];
		$Student->ProgramFees=$request["ProgramFees"];
		$Student->PersonalTrainerFees=$request["PersonalTrainerFees"];
		$Student->Photo = "/StudentPhotos/".$file_name;
		$Student->ReceiptNo = $request["ReceiptNo"];
		$Student->IDProof=$IDProof;
		$Student->save();
		
		$StudentPayment=new studentpayment();
		$StudentID =$Student->id;
			
		$StudentPayment->StudentID=$StudentID;
		$StudentPayment->PlaceID= $request["PlaceID"];
		$StudentPayment->PaymentDate=date("Y-m-d");
		$StudentPayment->ProgramFees=$request["ProgramFees"];
		$StudentPayment->PersonalTrainer=$request["PersonalTrainerFees"];
		$StudentPayment->Discount=$request["Discount"];
		$StudentPayment->Total=$request["TotalFees"];
		$StudentPayment->PaidAmount=$request["PaidAmount"];
		$StudentPayment->Balance=floatval($request["TotalFees"])-floatval($StudentPayment->PaidAmount);
		$StudentPayment->save();
		
		$contacts=$request["MobileNo"];
		$sms_text="Dear ".$request["Name"].", thank you for joining us. This sms confirms your registration for the period from ".$request["StartDate"]." to ".$request["ExpiryDate"];
		$api_url = "http://book.24techsoft.com/api/sendmsg.php?user=uig123&pass=123456&sender=UNIUFC&phone=".$contacts."&text=".$sms_text."&priority=Priority&stype=normal";
		$response = file_get_contents( $api_url);
			
        return redirect('/Students')->with('message', 'Student Saved!');;
	}
	public function UpdateStudent(Request $request)
	{
		$this->validate($request, [
			'PlaceID' => 'required',
			'Code' => 'required',
            'Name' => 'required',
            'Address'=>'required',
            'Age' => 'required',
            'DOB' => 'required',
            'Sex' => 'required',
            'HomePhone' => 'required',
			'MobileNo' => 'required',
			'WorkPlace' => 'required',
			'Designation' => 'required',
			'EmergencyPerson' => 'required',
			'EmergencyContactNo' => 'required',
			'Program' => 'required',
			'StartDate' => 'required',
			'ExpiryDate' => 'required',
			'MaritalStatus' => 'required',
			'BloodGroup' => 'required',
			'PersonalTrainer' => 'required',
			'ProgramFees' => 'required',
			'PersonalTrainerFees' => 'required',
			'ReceiptNo'=>'required'
        ]);
		$data=["PlaceID"=>$request["PlaceID"], "Code"=>$request["Code"], "Name"=>$request["Name"], "Address"=>$request["Address"], "Age"=>$request["Age"], "DOB"=>$request["DOB"], "Sex"=>$request["Sex"], "HomePhone"=>$request["HomePhone"], "MobileNo"=>$request["MobileNo"], "WorkPlace"=>$request["WorkPlace"],"Designation"=>$request["Designation"], "EmergencyPerson"=>$request["EmergencyPerson"], "EmergencyContactNo"=>$request["EmergencyContactNo"], "HowYouKnow"=>$request["HowYouKnow"], "Program"=>$request["Program"], "StartDate"=>$request["StartDate"], "ExpiryDate" => $request["ExpiryDate"], "MaritalStatus" => $request["MaritalStatus"], "BloodGroup"=>$request["BloodGroup"], "AnyMedicalHistory"=>$request["AnyMedicalHistory"],"ProgramFees"=>$request["ProgramFees"],"PersonalTrainerFees"=>$request["PersonalTrainerFees"]];
		
		//dd($request->all());
		$file_data = $request->input('Photo'); 
	    $file_name = 'image_'.time().'.jpg'; //generating unique file name; 
	    @list($type, $file_data) = explode(';', $file_data);
	    @list(, $file_data) = explode(',', $file_data);
		if($file_data != ''){
			$destinationPath = public_path('StudentPhotos')."/".$file_name;
			file_put_contents($destinationPath, base64_decode($file_data));
			$data["Photo"]="/StudentPhotos/".$file_name;
		}
		
		DB::table("students")->where("ID",$request["ID"])->update($data);
        return redirect('/Students')->with('message', 'Student Updated!');;
	}
	public function DeleteStudent(Request $request)
	{
		$ID=$request["ID"];
		DB::table("students")->where("ID",$ID)->delete();
		return redirect('/Students')->with('message', 'Student Deleted!');
	}
	public function StudentUpgradeForm(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["PlaceID"]=$request["PlaceID"];
		$data["Title"]="Upgrade Student Package";
		$data["ID"]=$request["ID"];
		$StudentDetail=DB::table("students")->where("ID",$data["ID"])->get();
		$data["StartDate"]=$StudentDetail[0]->ExpiryDate;
		$data["Packages"]=DB::table('packages')->get();
		$data["Trainers"]=DB::table('staffs')->where("Designation","Trainer")->where("PlaceID",$data["LocationID"])->get();
		return view('StudentUpgradeForm',$data);
	}
	public function StudentUpgrade(Request $request)
	{
		$this->validate($request, [
			'Program' => 'required',
			'StartDate' => 'required',
            'ExpiryDate' => 'required',
            'ProgramFees'=>'required',
            'PersonalTrainerFees' => 'required',
			]);
		DB::table("students")->where("ID",$request["ID"])->update(["Program"=>$request["Program"],"StartDate"=>$request["StartDate"],"ExpiryDate"=>$request["ExpiryDate"],"ProgramFees"=>$request["ProgramFees"],"PersonalTrainerFees"=>$request["PersonalTrainerFees"],"ReceiptNo"=>$request["ReceiptNo"]]);
		$StudentPayment=new studentpayment();
		$StudentID =$request["ID"];
		$StudentPayment->StudentID=$StudentID;
		$StudentPayment->PlaceID=$request["PlaceID"];
		$StudentPayment->PaymentDate=date("Y-m-d");
		$StudentPayment->ProgramFees=$request["ProgramFees"];
		$StudentPayment->PersonalTrainer=$request["PersonalTrainerFees"];
		$StudentPayment->Discount=$request["Discount"];
		$StudentPayment->Total=$request["TotalFees"];
		$StudentPayment->PaidAmount=$request["PaidAmount"];
		$StudentPayment->Balance=floatval($request["TotalFees"])-floatval($StudentPayment->PaidAmount);
		$StudentPayment->save();
		
		$StudentDetail=DB::table("students")->where("ID",$request["ID"])->get();
		$contacts=$StudentDetail[0]->MobileNo;
		$sms_text="Dear ".$StudentDetail[0]->Name.", thank you for renewing your package. This sms confirms your registration for the period from ".$StudentDetail[0]->StartDate." to ".$StudentDetail[0]->ExpiryDate;
		$api_url = "http://book.24techsoft.com/api/sendmsg.php?user=uig123&pass=123456&sender=UNIUFC&phone=".$contacts."&text=".$sms_text."&priority=Priority&stype=normal";
		$response = file_get_contents( $api_url);
		
        return redirect('/Students')->with('message', 'Student Saved!');;
	}
}
