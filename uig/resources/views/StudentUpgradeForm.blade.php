@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
				{{ Form::open(array('url' => '/StudentUpgradeSave?ID='.$ID.'&PlaceID='.$PlaceID,"class"=>"row","enctype"=>"multipart/form-data")) }}
				<div class="col-md-3">
					<div class="form-group">
						<label>Start Date: </label>
						<input type="text" name="StartDate" id="StartDate" class="form-control datepicker" value="{{$StartDate}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Program: </label>
						<select name="Program" class="form-control" id="Program" onchange="GetPackageDetail();">
						@foreach($Packages as $Package)
							<option value="{{$Package->ID}}">{{$Package->PackageName}}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Expiry Date: </label>
						<input type="text" name="ExpiryDate" id="ExpiryDate" class="form-control datepicker" readonly>
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Personal Trainer: </label>
						<select name="PersonalTrainer" class="form-control" id="PersonalTrainer">
							<option value="0">None</option>
							@foreach($Trainers as $Trainer)
							<option value="{{$Trainer->ID}}"
							@if($Trainer->ID==$PersonalTrainer)
							selected
							@endif
							>{{$Trainer->Name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Program Fees:</label>
						<input type="text" name="ProgramFees" id="ProgramFees" class="form-control" value="0" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Personal Trainer Fees: </label>
						<input type="text" name="PersonalTrainerFees" id="PersonalTrainerFees" class="form-control" value="0" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Discount:</label>
						<input type="text" name="Discount" id="Discount" class="form-control" value="0" onfocus="this.select();" onchange="GetPackageDetail();">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Total Fees:</label>
						<input type="text" name="TotalFees" id="TotalFees" class="form-control" value="" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Paid Amount:</label>
						<input type="text" name="PaidAmount" id="PaidAmount" class="form-control" value="">
					</div>
				</div>
				
				<div class="col-md-2">
					<div class="form-group">
						<label>Receipt No:</label>
						<input type="text" name="ReceiptNo" id="ReceiptNo" value="" class="form-control" value="" required>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close()}}<!--/row -->
          </section>
      </section>
@endsection
@section("footer")
<script type="text/javascript">
	$(document).ready(function(){
		GetPackageDetail();
	});
	function GetPackageDetail()
	{
		var Discount=parseFloat(document.getElementById("Discount").value);
		var StartDate=document.getElementById("StartDate").value;
		$.ajax({
			url: "/GetPackageDetail?ID="+document.getElementById("Program").value,
			dataType: "json",
			success: function(Data)
			{
				document.getElementById("ProgramFees").value=Data[0].Price;
				var PersonalTrainer=document.getElementById("PersonalTrainer").value;
				if(PersonalTrainer!="0")
				{
					document.getElementById("PersonalTrainerFees").value=Data[0].PersonalTrainer*Data[0].Duration;
				}
				else
				{
					document.getElementById("PersonalTrainerFees").value="0";
				}
				document.getElementById("TotalFees").value=parseFloat(document.getElementById("ProgramFees").value)+parseFloat(document.getElementById("PersonalTrainerFees").value)-Discount;
				document.getElementById("PaidAmount").value=document.getElementById("TotalFees").value;
				var Duration=Data[0].Duration;
				var Expiry=StartDate.split("-");
				var ExpiryDate = new Date(Expiry[0], Expiry[1] - 1, Expiry[2]);
				ExpiryDate=new Date(ExpiryDate.setMonth(ExpiryDate.getMonth()+Duration));
				var Year=ExpiryDate.getFullYear().toString();
				var Month=(ExpiryDate.getMonth()+1).toString();
				var Day=ExpiryDate.getDate().toString();
				if (Month.length < 2)
				{
					Month = "0" + Month.toString();
				}
				if (Day.length < 2)
				{
					Day = '0' + Day.toString();
				}
				document.getElementById("ExpiryDate").value=Year.toString()+"-"+Month.toString()+"-"+Day.toString();
			},
			error: function()
			{
				alert("fail");
			}
		});
	}
</script>
@endsection