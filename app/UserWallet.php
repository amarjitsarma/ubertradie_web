<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserWallet extends Model
{
    protected $table="user_wallets";
	public function GetWalletBalance($user_id)
	{
		$Wallet=DB::table("user_wallets")->raw("select coalesce(sum(a.amount)-sum(b.amount),0) as Balance from user_wallets a,user wallets b where a.user_id=$user_id and a.transaction_type=1 and b.user_id=$user_id and b.transaction_type=2");
		return $Wallet[0]->Balance;
	}
	public function GetInAmount($user_id)
	{
		$Wallet=DB::table("user_wallets")->raw("select coalesce(sum(amount),0) as InAmount from user_wallets where user_id=$user_id and transaction_type=1");
		return $Wallet[0]->InAmount;
	}
	public function GetOutAmount($user_id)
	{
		$Wallet=DB::table("user_wallets")->raw("select coalesce(sum(amount),0) as OutAmount from user_wallets where user_id=$user_id and transaction_type=2");
		return $Wallet[0]->OutAmount;
	}
}
