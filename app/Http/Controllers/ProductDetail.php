<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   Class ProductDetail extends  CI_Controller{
   	public function __construct(){
   		parent::__construct();
		$this->load->model('adminmodel');
		$this->load->model('mainmodel');
		$this->load->model('ordermodel');
		$this->load->helper('url');
		$this->load->helper('cookie');
   	}
	
	public function index(){
		$data["CustomerID"]=$this->input->cookie("CustomerID",true);
		/*header*/
		$Token=$this->input->cookie("Token",true);
		if($Token=="")
		{
			$this->input->set_cookie("Token",rand(11111111,99999999).time(),864000);
			$Token=$this->input->cookie("Token",true);
		}
		$ipaddress = $Token;
		$whereit="IPAddress='$ipaddress'";
		$data["Cart"]=$this->ordermodel->showCart($whereit);
		/*header*/
		$ID=$this->input->get("ID",true);
		$where="a.ID=$ID order by a.ID desc";
		$wherei="ItemID=$ID";
		$Items=$this->mainmodel->showProducts($where);
		$ItemID=0;
		for($i=0;$i<sizeOf($Items);$i++){
			$ItemID=$Items[$i]["ID"];
			$wherep="(Quality='Gold Polished' or Quality='Gold Coated') and ItemID=$ItemID";
			$items=$this->adminmodel->showItemPrice($wherep);
			$Items[$i]["ItemPrice"]=$items;
			
		}
		$data["ID"]=$ID;
		$data["Items"]=$Items;
		$data["Photos"]=$this->mainmodel->showItemPhoto($wherei);
		$data["Categories"]=$this->adminmodel->showCategories(1);
		$this->load->view('main/view_product',$data);
	}
	public function Policy()
	{
		$data["CustomerID"]=$this->input->cookie('CustomerID',true);
		$Token=$this->input->cookie("Token",true);
		if($Token=="")
		{
			$this->input->set_cookie("Token",rand(11111111,99999999).time(),864000);
			$Token=$this->input->cookie("Token",true);
		}
		$ipaddress = $Token;
		$whereit="IPAddress='$ipaddress'";
		$data["Cart"]=$this->ordermodel->showCart($whereit);
		/*header*/
		
		$data["Categories"]=$this->adminmodel->showCategories(1);
		$this->load->view("main/policy",$data);
	}
	
	
   }
   ?>