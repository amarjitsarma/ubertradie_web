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
				{{ Form::open(array('url' => '/UpdateStudentReceipt',"class"=>"row","enctype"=>"multipart/form-data")) }}
				<!-- PlaceID	Name	Email	ContactNo	EnquiryDate	Message	ReminderOn -->
				<div class="col-md-12">
					<div class="col-md-3">
						<div class="form-group">
							<label>Program Fees: </label>
							<input type="text" name="ProgramFees" value="{{$ProgramFees}}" class="form-control" readonly>
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>Personal Trainer Fees: </label>
							<input type="text" name="PersonalTrainer" value="{{$PersonalTrainer}}" class="form-control" readonly>
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>Paid Amount: </label>
							<input type="text" name="PaidAmount" id="PaidAmount" value="{{$PaidAmount}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Balance: </label>
							<input type="text" name="Balance" id="Balance" value="{{$Balance}}" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Amount Paid Now: </label>
							<input type="text" name="AmountToPay" id="AmountToPay" value="0" class="form-control" onchange="Validate();" onfocus="this.select();">
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close() }}<!--/row -->
          </section>
      </section>
@endsection
@section("footer")
<script>
function Validate()
{
	var PaidAmount=parseFloat(document.getElementById("PaidAmount").value);
	var Balance=parseFloat(document.getElementById("Balance").value);
	var AmountToPay=parseFloat(document.getElementById("AmountToPay").value);
	if(AmountToPay>Balance)
	{
		alert("Amount to pay cannot be larger than balance");
		document.getElementById("AmountToPay").value=document.getElementById("Balance").value;
	}
}
</script>
@endsection