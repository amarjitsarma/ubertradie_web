<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\StaffSalaryPayment;
use App;
use PDF;
use Sentinel;
class HomeController extends Controller
{
	public function __construct()
    {
		$SINGLE=array("One","Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten");
		$TEN=array("Eleven","Twelve","Thirteen","Fourteen","Fifteen","Sixteen","Seventeen","Eighteen","Ninteen");
		$DECA=array("Ten","Twenty","Thirty","Fourty","Fifty","Sixty","Seventy","Eighty","Ninty");
	}
    public function Dashboard(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Dashboard";
		$CurrentYear=date("Y");
		$data["Years"]=[];
		for($i=$CurrentYear;$i>=$CurrentYear-5;$i--)
		{
			array_push($data["Years"],$i);
		}
		$data["Locations"]=DB::table("locations")->get();
		
		$date2=Date('y:m:d', strtotime("+7 days"));
		$date1=Date('y:m:d', strtotime("-3 days"));
		if($data["UserType"]=="admin")
		{
			$data["Expiries"]=DB::table("students")->join("locations","students.PlaceID","=","locations.ID")->join("packages","students.Program","=","packages.ID")->leftjoin("staffs", "students.PersonalTrainer","staffs.ID")->select("students.IDNo","students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.MobileNo",  "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "staffs.Name as PersonalTrainer", "students.ProgramFees", "students.PersonalTrainerFees", "locations.LocationName", "packages.PackageName")->whereBetween("students.ExpiryDate",[$date1,$date2])->get();
		}
		else
		{
			$data["Expiries"]=DB::table("students")->join("locations","students.PlaceID","=","locations.ID")->join("packages","students.Program","=","packages.ID")->leftjoin("staffs", "students.PersonalTrainer","staffs.ID")->select("students.IDNo","students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.MobileNo",  "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "staffs.Name as PersonalTrainer", "students.ProgramFees", "students.PersonalTrainerFees", "locations.LocationName", "packages.PackageName")->whereBetween("students.ExpiryDate",[$date1,$date2])->where("students.PlaceID",$data["LocationID"])->get();
		}
		if($data["UserType"]=="admin")
		{
			$data["Balances"]=DB::table("studentpayments")->join("students","studentpayments.StudentID","=","students.ID")->join("locations","students.PlaceID","=","locations.ID")->select("studentpayments.ID", "students.IDNo", "students.BiometricCode", "students.Name", "students.StartDate", "students.ExpiryDate", "locations.LocationName", "studentpayments.ProgramFees","studentpayments.PersonalTrainer", "studentpayments.PaidAmount", "studentpayments.Balance")->where("studentpayments.Balance",">",0)->get();
		}
		else
		{
			$data["Balances"]=DB::table("studentpayments")->join("students","studentpayments.StudentID","=","students.ID")->join("locations","students.PlaceID","=","locations.ID")->select("studentpayments.ID", "students.IDNo", "students.BiometricCode", "students.Name", "students.StartDate", "students.ExpiryDate", "locations.LocationName","studentpayments.ProgramFees", "studentpayments.PersonalTrainer", "studentpayments.PaidAmount", "studentpayments.Balance")->where("studentpayments.Balance",">",0)->where("students.PlaceID",$data["LocationID"])->get();
		}
		return view("Dashboard",$data);
	}
	public function GetStudentsByPlaceJSON(Request $request)
	{
		$PlaceID=$request["PlaceID"];
		$data=DB::table("students")->where("PlaceID",$PlaceID)->get();
		return json_encode($data);
	}
	public function GetStaffByPlaceJSON(Request $request)
	{
		$PlaceID=$request["PlaceID"];
		$data=DB::table("staffs")->where("PlaceID",$PlaceID)->get();
		return json_encode($data);
	}
	public function GetStaffSalary(Request $request)
	{
		$Year=$request["Year"];
		$Month=$request["Month"];
		$PlaceID=$request["PlaceID"];
		$StaffID=$request["StaffID"];
		$MinDay="01";
		$MaxDay="31";
		$MinDate=$Year."-".$Month."-".$MinDay;
		$MaxDate=$Year."-".$Month."-".$MaxDay;
		$data["MinDate"]=$MinDate;
		$data["MaxDate"]=$MaxDate;
		if($Month!=1 && $Month!=3 && $Month!=5 && $Month!=7 && $Month!=8 && $Month!=10 && $Month!=12 && $Month!=2)
		{
			$MaxDay=30;
		}
		else if($Month==2)
		{
			$MaxDay=28;
			if($Year%100==0)
			{
				if($Year%400==0)
				{
					$MaxDay=29;
				}
			}
			else if($Year%4==0)
			{
				$MaxDay=29;
			}
		}
		if(($Year==date("Y") && $Month<date("m"))||($Year<date("Y")))
		{
			$Salary=DB::table("staffsalarys")->where("PlaceID",$PlaceID)->where("StaffID",$StaffID)->where("Month",$Month)->where("Year",$Year)->get();
			if(sizeof($Salary)>0)
			{
				$data["Staff"]=DB::table("staffs")->join("locations","staffs.PlaceID","=","locations.ID")->select("staffs.BiometricCode","staffs.Name", "staffs.Address", "staffs.Age", "staffs.DOB", "staffs.Sex", "staffs.MobileNo", "staffs.Designation", "staffs.Salary", "staffs.AbsentPenalty", "staffs.WorkDays", "locations.LocationName")->where("staffs.ID",$StaffID)->get();
				$data["Salary"]=DB::table("staffsalarys")->where("ID",$Salary[0]->ID)->get();
				$data["Attendances"]=DB::table("staffattendances")->whereBetween("EntryDate",[$MinDate,$MaxDate])->where("RegisteredID",$StaffID)->get();
				$data["Leaves"]=DB::table("staffleaves")->whereBetween("LeaveDate",[$MinDate,$MaxDate])->where("StaffID",$StaffID)->get();
				
				//return view("StaffSalary",$data);
				$pdf = PDF::loadView('StaffSalary', $data)->setPaper('a5');;
				return $pdf->download('SalarySlip.pdf');
			}
			else
			{
				$this->GenerateSalary($PlaceID,$StaffID,$Month,$Year,$MinDate,$MaxDate);
				return redirect("/GetStaffSalary?PlaceID=".$PlaceID."&StaffID=".$StaffID."&Month=".$Month."&Year=".$Year);
			}
		}
		else
		{
			return redirect("Dashboard")->with(["message"=>"Invalid period"]);
		}
	}
	function GenerateSalary($PlaceID,$StaffID,$Month,$Year,$MinDate,$MaxDate)
	{
		$Location=DB::table("locations")->where("ID",$PlaceID)->get();
		$Staff=DB::table("staffs")->where("ID",$StaffID)->get();
		$DutyDays=$Staff[0]->WorkDays;
		$Salary=$Staff[0]->Salary;
		$AbsentPenalty=$Staff[0]->AbsentPenalty;
		$StaffAttendance=DB::table("staffattendances")->whereBetween("EntryDate",[$MinDate,$MaxDate])->where("RegisteredID",$StaffID)->get();
		$LeaveApplication=DB::table("staffleaves")->whereBetween("LeaveDate",[$MinDate,$MaxDate])->where("StaffID",$StaffID)->get();
		$Penalty=0;
		if(sizeof($StaffAttendance)+sizeof($LeaveApplication)<$DutyDays)
		{
			$AbsentPenalty=$AbsentPenalty*($DutyDays-(sizeof($StaffAttendance)+sizeof($LeaveApplication)));
		}
		$StaffSalaryPayment=new StaffSalaryPayment();
		$StaffSalaryPayment->PlaceID=$PlaceID;
		$StaffSalaryPayment->StaffID=$StaffID;
		$StaffSalaryPayment->Month=$Month;
		$StaffSalaryPayment->Year=$Year;
		$StaffSalaryPayment->MonthlySalary=$Salary;
		$StaffSalaryPayment->WorkingDays=sizeof($StaffAttendance);
		$StaffSalaryPayment->AbsentPenalty=$AbsentPenalty;
		$StaffSalaryPayment->TotalSalary=$Salary-$AbsentPenalty;
		$StaffSalaryPayment->save();
	}
	
	
	public function NUMBERTOTEXT($NUM)
	{
		$SINGLE=array("One","Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten");
		$TEN=array("Eleven","Twelve","Thirteen","Fourteen","Fifteen","Sixteen","Seventeen","Eighteen","Ninteen");
		$DECA=array("Ten","Twenty","Thirty","Fourty","Fifty","Sixty","Seventy","Eighty","Ninty");
		$NUM=round($NUM);
		$TEXT="";
		if($NUM>9999999)
		{
			$CRORE=intVal($NUM/10000000);
			if($CRORE==10)
			{
				$TEXT=$DECA[0]." Crore ";
			}
			else if($CRORE>10 && $CRORE<20)
			{
				$TEXT=$TEN[$CRORE-11]." Crore ";
			}
			else if($CRORE>=20 && $CRORE%10==0)
			{
				$TEXT=$DECA[($CRORE/10)-1]." Crore ";
			}
			else if($CRORE<10 && $CRORE>0)
			{
				$TEXT=$SINGLE[$CRORE-1]." Crore ";
			}
			else
			{
				$TEXT=$DECA[($CRORE/10)-1]." ".$SINGLE[($CRORE%10)-1]." Crore ";
			}
			$NUM=$NUM-$CRORE*10000000;
		}
		if($NUM>99999 && $NUM<10000000)
		{
			$LAKH=intVal($NUM/100000);
			if($LAKH==10)
			{
				$TEXT=$TEXT.$DECA[0]." Lakh ";
			}
			else if($LAKH>10 && $LAKH<20)
			{
				$TEXT=$TEXT.$TEN[$LAKH-11]." Lakh ";
			}
			else if($LAKH>=20 && $LAKH%10==0)
			{
				$TEXT=$TEXT.$DECA[($LAKH/10)-1]." Lakh ";
			}
			else if($LAKH<10 && $LAKH>0)
			{
				$TEXT=$TEXT.$SINGLE[$LAKH-1]." Lakh ";
			}
			else
			{
				$TEXT=$TEXT.$DECA[($LAKH/10)-1]." ".$SINGLE[($LAKH%10)-1]." Lakh ";
			}
			$NUM=$NUM-$LAKH*100000;
		}
		if($NUM>999 && $NUM<100000)
		{
			$THOUSAND=intVal($NUM/1000);
			if($THOUSAND==10)
			{
				$TEXT=$TEXT.$DECA[0]." Thousand ";
			}
			else if($THOUSAND>10 && $THOUSAND<20)
			{
				$TEXT=$TEXT.$TEN[$THOUSAND-11]." Thousand ";
			}
			else if($THOUSAND>=20 && $THOUSAND%10==0)
			{
				$TEXT=$TEXT.$DECA[($THOUSAND/10)-1]." Thousand ";
			}
			else if($THOUSAND<10 && $THOUSAND>0)
			{
				$TEXT=$TEXT.$SINGLE[$THOUSAND-1]." Thousand ";
			}
			else
			{
				$TEXT=$TEXT.$DECA[($THOUSAND/10)-1]." ".$SINGLE[($THOUSAND%10)-1]." Thousand ";
			}
			$NUM=$NUM-$THOUSAND*1000;
		}
		if($NUM>99 && $NUM<1000)
		{
			$HUNDRED=intVal($NUM/100);
			if($HUNDRED==10)
			{
				$TEXT=$TEXT.$DECA[0]." Hundred ";
			}
			else if($HUNDRED>10 && $HUNDRED<20)
			{
				$TEXT=$TEXT.$TEN[$HUNDRED-11]." Hundred ";
			}
			else if($HUNDRED>=20 && $HUNDRED%10==0)
			{
				$TEXT=$TEXT.$DECA[($HUNDRED/10)-1]." Hundred ";
			}
			else if($HUNDRED<10 && $HUNDRED>0)
			{
				$TEXT=$TEXT.$SINGLE[$HUNDRED-1]." Hundred ";
			}
			else
			{
				$TEXT=$TEXT.$DECA[($HUNDRED/10)-1]." ".$SINGLE[($HUNDRED%10)-1]." Hundred ";
			}
			$NUM=$NUM-$HUNDRED*100;
		}
		if($NUM>0 && $NUM<99)
		{
			$DECIMAL=intVal($NUM);
			if($DECIMAL==10)
			{
				$TEXT=$TEXT.$DECA[0];
			}
			else if($DECIMAL>10 && $DECIMAL<20)
			{
				$TEXT=$TEXT.$TEN[$HUNDRED-11];
			}
			else if($DECIMAL>=20 && $DECIMAL%10==0)
			{
				$TEXT=$TEXT.$DECA[($HUNDRED/10)-1];
			}
			else if($DECIMAL<10 && $DECIMAL>0)
			{
				$TEXT=$TEXT.$SINGLE[$DECIMAL-1];
			}
			else
			{
				$TEXT=$TEXT.$DECA[($DECIMAL/10)-1]." ".$SINGLE[($DECIMAL%10)-1];
			}
			$NUM=$NUM-$DECIMAL;
		}
		$TEXT=$TEXT." Rupees Only";
		return $TEXT;
	}
	
	public function GetStudentReceipt(Request $request)
	{
		$StudentID=$request["StudentID"];
		$Receipt=DB::table("students")->join("packages","students.Program","=","packages.ID")->leftJoin("staffs","staffs.ID","=","students.PersonalTrainer")->join("studentpayments","students.ID","=","studentpayments.StudentID")->select("students.ID", "students.PlaceID", "students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.HomePhone", "students.MobileNo", "students.WorkPlace", "students.Designation", "students.EmergencyPerson", "students.EmergencyContactNo", "students.HowYouKnow", "students.Program", "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "students.PersonalTrainer","packages.PackageName","packages.Duration","staffs.Name","studentpayments.PaymentDate",	"studentpayments.ProgramFees","studentpayments.PersonalTrainer","studentpayments.PaidAmount")->where("students.ID",$StudentID)->orderby("studentpayments.PaymentDate")->get();
		if(sizeof($Receipt)>0)
		{
			$data["Receipt"]=$Receipt[sizeof($Receipt)-1];
			$pdf = PDF::loadView('StudentReceipt', $data)->setPaper('a5');;
			return $pdf->download('StudentReceipt.pdf');
		}
		else
		{
			return redirect("/Dashboard");
		}
	}
	public function StudentPaymentHistory(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Student Payment History";
		$data["PlaceID"]=$request["PlaceID"];
		$data["StudentID"]=$request["StudentID"];
		$data["Locations"]=DB::table("locations")->get();
		if($data["PlaceID"]=="")
		{
			if(sizeof($data["Locations"])>0)
			{
				$data["PlaceID"]=$data["Locations"][0]->ID;
			}
		}
		$data["Students"]=DB::table("students")->where("PlaceID",$data["PlaceID"])->get();
		
		if($data["StudentID"]=="")
		{
			if(sizeof($data["Students"])>0)
			{
				$data["StudentID"]=$data["Students"][0]->ID;
			}
		}
		else
		{
			$StudentDetail=DB::table("students")->where("ID",$data["StudentID"])->get();
			if($data["PlaceID"]!=$StudentDetail[0]->PlaceID)
			{
				if(sizeof($data["Students"])>0)
				{
					$data["StudentID"]=$data["Students"][0]->ID;
				}
			}
		}
		$data["Receipts"]=DB::table("students")->join("packages","students.Program","=","packages.ID")->leftJoin("staffs","staffs.ID","=","students.PersonalTrainer")->join("studentpayments","students.ID","=","studentpayments.StudentID")->select("students.ID", "students.PlaceID", "students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.HomePhone", "students.MobileNo", "students.WorkPlace", "students.Designation", "students.EmergencyPerson", "students.EmergencyContactNo", "students.HowYouKnow", "students.Program", "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "students.PersonalTrainer","packages.PackageName","packages.Duration","staffs.Name","studentpayments.PaymentDate",	"studentpayments.ProgramFees","studentpayments.PersonalTrainer","studentpayments.PaidAmount")->where("students.ID",$data["StudentID"])->orderby("studentpayments.PaymentDate")->get();
		return view("StudentPaymentHistory",$data);
	}
	
	public function StaffSalaryHistory(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Satff Salary History";
		$data["PlaceID"]=$request["PlaceID"];
		$data["StaffID"]=$request["StaffID"];
		$data["Locations"]=DB::table("locations")->get();
		if($data["PlaceID"]=="")
		{
			if(sizeof($data["Locations"])>0)
			{
				$data["PlaceID"]=$data["Locations"][0]->ID;
			}
		}
		$data["Staffs"]=DB::table("staffs")->where("PlaceID",$data["PlaceID"])->get();
		
		if($data["StaffID"]=="")
		{
			if(sizeof($data["Staffs"])>0)
			{
				$data["StaffID"]=$data["Staffs"][0]->ID;
			}
		}
		else
		{
			$StaffDetail=DB::table("staffs")->where("ID",$data["StaffID"])->get();
			if($data["PlaceID"]!=$StaffDetail[0]->PlaceID)
			{
				if(sizeof($data["Staffs"])>0)
				{
					$data["StaffID"]=$data["Staffs"][0]->ID;
				}
			}
		}
		$data["Salaries"]=DB::table("staffs")->join("staffsalarys","staffs.ID","=","staffsalarys.StaffID")->select("staffs.BiometricCode", "staffs.Name", "staffs.Address", "staffs.Age", "staffs.DOB", "staffs.Sex", "staffs.MobileNo", "staffs.Designation", "staffs.EmergencyPerson", "staffs.EmergencyContactNo", "staffs.JoiningDate", "staffs.MaritalStatus", "staffs.BloodGroup", "staffs.AnyMedicalHistory", "staffs.Salary", "staffs.AbsentPenalty as AbsentPenaltyPerDay", "staffs.WorkDays", "staffsalarys.PlaceID", "staffsalarys.StaffID", "staffsalarys.Month", "staffsalarys.Year", "staffsalarys.MonthlySalary", "staffsalarys.WorkingDays", "staffsalarys.AbsentPenalty", "staffsalarys.TotalSalary")->where("staffs.ID",$data["StaffID"])->orderby("staffsalarys.created_at")->get();
		return view("StaffSalaryHistory",$data);
	}
	public function PersonalTrainerHistory(Request $request)
	{
		//dd($request["PlaceID"]);
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		
		$data["Title"]="Satff Salary History";
		$data["PlaceID"]=$request["PlaceID"];
		$data["Locations"]=DB::table("locations")->get();
		if($data["PlaceID"]=="")
		{
			if(sizeof($data["Locations"])>0)
			{
				$data["PlaceID"]=$data["Locations"][0]->ID;
			}
		}
		
		$data["PersonalTrainers"]=DB::table("students")->join("staffs","staffs.ID","=","students.PersonalTrainer")->select("students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.HomePhone", "students.MobileNo","staffs.BiometricCode", "staffs.Name")->where("students.ExpiryDate",">",date("Y-m-d"))->where("students.PlaceID",$data["PlaceID"])->orderby("students.ID")->get();
		return view("PersonalTrainerHistory",$data);
	}
	public function EditStudentReceipt(Request $request)
	{
		$data["LocationID"]=Sentinel::getUser()->location;
		$data["UserType"]=Sentinel::getUser()->roles()->first()->slug;
		$ID=$request["ID"];
		$ReceiptDetail=DB::table("studentpayments")->where("ID",$ID)->get();
		$data["ID"]=$ID;
		$data["Title"]="Edit Student Receipt";
		$data["ProgramFees"]=$ReceiptDetail[0]->ProgramFees;
		$data["PersonalTrainer"]=$ReceiptDetail[0]->PersonalTrainer;
		$data["PaidAmount"]=$ReceiptDetail[0]->PaidAmount;
		$data["Balance"]=$ReceiptDetail[0]->Balance;
		return view("EditStudentReceipt",$data);
	}
	public function UpdateStudentReceipt(Request $request)
	{
		$ProgramFees=$request["ProgramFees"];
		$PersonalTrainer=$request["PersonalTrainer"];
		$PaidAmount=$request["PaidAmount"];
		$Balance=$request["Balance"];
		$AmountToPay=$request["AmountToPay"];
	}
	
	public function SendExpiry(Request $request)
	{
		$LocationID=Sentinel::getUser()->location;
		$UserType=Sentinel::getUser()->roles()->first()->slug;
		$date2=Date('y:m:d', strtotime("+5 days"));
		$date1=Date('y:m:d', strtotime("-5 days"));
		$Expiries=[];
		if($UserType=="admin")
		{
			$Expiries=DB::table("students")->join("locations","students.PlaceID","=","locations.ID")->join("packages","students.Program","=","packages.ID")->leftjoin("staffs", "students.PersonalTrainer","staffs.ID")->select("students.IDNo","students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.MobileNo",  "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "staffs.Name as PersonalTrainer", "students.ProgramFees", "students.PersonalTrainerFees", "locations.LocationName", "packages.PackageName")->whereBetween("students.ExpiryDate",[$date1,$date2])->get();
		}
		else
		{
			$Expiries=DB::table("students")->join("locations","students.PlaceID","=","locations.ID")->join("packages","students.Program","=","packages.ID")->leftjoin("staffs", "students.PersonalTrainer","staffs.ID")->select("students.IDNo","students.BiometricCode", "students.Name", "students.Address", "students.Age", "students.DOB", "students.Sex", "students.MobileNo",  "students.StartDate", "students.ExpiryDate", "students.MaritalStatus", "students.BloodGroup", "students.AnyMedicalHistory", "staffs.Name as PersonalTrainer", "students.ProgramFees", "students.PersonalTrainerFees", "locations.LocationName", "packages.PackageName")->whereBetween("students.ExpiryDate",[$date1,$date2])->where("students.PlaceID",$data["LocationID"])->get();
		}
		foreach($Expiries as $row)
		{
			$api_key = '5573043D93269B';
			$contacts = $row->MobileNo.",9864765656";
			$from = 'UNIUFC';
			$sms_text="";
			if($row>=date("Y-m-d"))
			{
				$sms_text = urlencode("Dear ".$row->Name." your package will expire on ".date('d M, Y',strtotime($row->ExpiryDate)).". Contact your us for renewal of your package");
			}
			else
			{
				$sms_text = urlencode("Dear ".$row->Name." your package is expired on ".date('d M, Y',strtotime($row->ExpiryDate)).". Contact your us for renewal of your package");
			}
			$api_url = "http://book.24techsoft.com/api/sendmsg.php?user=uig123&pass=123456&sender=UNIUFC&phone=".$contacts."&text=".$sms_text."&priority=Priority&stype=normal";
			$response = file_get_contents( $api_url);
		}
		return redirect("/Dashboard")->with("message", "Messages for expiry has been sent.");
	}
	public function SendBalance(Request $request)
	{
		$LocationID=Sentinel::getUser()->location;
		$UserType=Sentinel::getUser()->roles()->first()->slug;
		$Balances=[];
		if($UserType=="admin")
		{
			$Balances=DB::table("studentpayments")->join("students","studentpayments.StudentID","=","students.ID")->join("locations","students.PlaceID","=","locations.ID")->select("studentpayments.ID", "students.IDNo", "students.BiometricCode", "students.Name", "students.StartDate", "students.ExpiryDate", "locations.LocationName", "studentpayments.ProgramFees","studentpayments.PersonalTrainer", "studentpayments.PaidAmount", "studentpayments.Balance")->where("studentpayments.Balance",">",0)->get();
		}
		else
		{
			$Balances=DB::table("studentpayments")->join("students","studentpayments.StudentID","=","students.ID")->join("locations","students.PlaceID","=","locations.ID")->select("studentpayments.ID", "students.IDNo", "students.BiometricCode", "students.Name", "students.StartDate", "students.ExpiryDate", "locations.LocationName","studentpayments.ProgramFees", "studentpayments.PersonalTrainer", "studentpayments.PaidAmount", "studentpayments.Balance")->where("studentpayments.Balance",">",0)->where("students.PlaceID",$data["LocationID"])->get();
		}
		foreach($Balances as $row)
		{
			$api_key = '5573043D93269B';
			$contacts = $row->MobileNo;
			$from = 'UNIUFC';
			$sms_text="";
			$sms_text = urlencode("Dear ".$row->Name." you've a balance of Rs. ".$row->Balance."/- to be paid. Please pay the remainig at the earliest.");
			$api_url = "http://book.24techsoft.com/api/sendmsg.php?user=uig123&pass=123456&sender=UNIUFC&phone=".$contacts."&text=".$sms_text."&priority=Priority&stype=normal";
			//$api_url = "http://sms.24techsoft.com/app/smsapi/index.php?key=".$api_key."&campaign=0&routeid=7&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;
			$response = file_get_contents( $api_url);
		}
		return redirect("/Dashboard")->with("message", "Messages for balance has been sent.");
	}
}
