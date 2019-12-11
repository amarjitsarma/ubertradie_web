<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quote;
class QuoteController extends Controller
{
	public function getQuotations(){
		$quotations = DB::table('quote_requests')
							->orderby('id', 'desc')
							->get();

		return view('quotations')->with(['quotations' => $quotations, 'Title' => 'Quotations']);
	}

	public function getQuotationDetails($id){
		$quotationDtls = DB::table('quote_requests')
							->where('id', '=', $id)
							->first();

		return view('quotation-details')->with(['quotationDtls' => $quotationDtls, 'Title' => 'Quotations']);
	}
	//API
    public function SaveQuoteAPI(Request $request)
	{
		$device_id=$request["device_id"];
		$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
		
		$Quote=new Quote();
		$Quote->user_id=$Login->UserID;
		$Quote->quote_to=$request["quote_to"];
		$Quote->title=$request["title"];
		$Quote->description=$request["description"];
		$Quote->skills=$request["skills"];
		$Quote->payment_mode=$request["payment_mode"];
		$Quote->estimate_duration=$request["estimate_duration"];
		$Quote->status=1;
		$Quote->remarks="";
		$Quote->save();
		$id=$Quote->id;
		return response()->json(['id'=>$id]);
	}
	public function GetQuotesAPI(Request $request)
	{
		$id=$request["id"];
		$type=$request["type"];
		
		
		if($id!="" && $id!=null)
		{
			$Quotes=DB::table("quote_requests")->where("id",$id)->first();
			$Quotes->Sender=DB::table("users")->where("id",$Quotes->user_id)->first();
			$Quotes->Receiver=DB::table("fl_basic")->where("user_id",$Quotes->quote_to)->first();
		}
		else
		{
			$device_id=$request["device_id"];
			$Login=DB::table("user_login")->where("DeviceID",$device_id)->where("Status",1)->first();
			$user_id=$Login->UserID;
			$Freelancer=DB::table("fl_basic")->where("user_id",$user_id)->first();
			if($type=="sender")
			{
				$Quotes=DB::table("quote_requests")->where("user_id",$user_id)->orderby("id","desc")->get();
			}
			else
			{
				$Quotes=DB::table("quote_requests")->where("quote_to",$Freelancer->id)->orderby("id","desc")->get();
			}
			for($i=0;$i<sizeof($Quotes);$i++)
			{
				$Quotes[$i]->Sender=DB::table("users")->where("id",$Quotes[$i]->user_id)->first();
				$Quotes[$i]->Receiver=DB::table("fl_basic")->where("user_id",$Quotes[$i]->quote_to)->first();
			}
		}
		return response()->json(['Quotes'=>$Quotes]);
	}
}
