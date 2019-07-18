@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
		@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
		@endif
		<div class="row">
			<h2>Balance to be cleared</h2>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable1" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
						<th>ID No</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Start Date</th>
						<th>Expiry Date</th>
						<th>Location Name</th>
						<th>Program Fees</th>
						<th>Personal Trainer</th>
						<th>Paid Amount</th>
						<th>Balance</th>
						<th>Operation</th>
					</thead>
					<tbody>
						@foreach($Balances as $Balance)
						<td>{{$Balance->IDNo}}</th>
						<td>{{$Balance->BiometricCode}}</th>
						<td>{{$Balance->Name}}</th>
						<td>{{$Balance->StartDate}}</th>
						<td>{{$Balance->ExpiryDate}}</th>
						<td>{{$Balance->LocationName}}</th>
						<td>{{$Balance->ProgramFees}}</th>
						<td>{{$Balance->PersonalTrainer}}</th>
						<td>{{$Balance->PaidAmount}}</th>
						<td>{{$Balance->Balance}}</th>
						<th><a href="/EditStudentReceipt?ID={{$Balance->ID}}">Edit Receipt</a></th>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<a href="/SendBalance" class="btn btn-danger">Send Bulk SMS about Balance</a>
			</div>
		</div>
		<div class="row">
			<h2>About to expire</h2>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Location Name</th>
						<th>ID No</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Mobile No</th>
						<th>Start Date</th>
						<th>Expiry Date</th>
						<th>Marital Status</th>
						<th>Blood Group</th>
						<th>Personal Trainer</th>
						<th>Program Fees</th>
						<th>Personal Trainer Fees</th>
						<th>Package Name</th>
						<th>Status</th>							
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Expiries as $Expiry)
					<tr>
						<td>{{$Expiry->LocationName}}</td>
						<td>{{$Expiry->IDNo}}</td>
						<td>{{$Expiry->BiometricCode}}</td>
						<td>{{$Expiry->Name}}</td>
						<td>{{$Expiry->Address}}</td>
						<td>{{$Expiry->Age}}</td>
						<td>{{$Expiry->DOB}}</td>
						<td>{{$Expiry->Sex}}</td>
						<td>{{$Expiry->MobileNo}}</td>
						<td>{{$Expiry->StartDate}}</td>
						<td>{{$Expiry->ExpiryDate}}</td>
						<td>{{$Expiry->MaritalStatus}}</td>
						<td>{{$Expiry->BloodGroup}}</td>
						<td>{{$Expiry->PersonalTrainer}}</td>
						<td>{{$Expiry->ProgramFees}}</td>
						<td>{{$Expiry->PersonalTrainerFees}}</td>
						<td>{{$Expiry->PackageName}}</td>
						<td>@if(date("Y-m-d")>$Expiry->ExpiryDate)
							Expired
							@else
							About to expire	
							@endif</td>							
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<a href="/SendExpiry" class="btn btn-danger">Send Bulk SMS about Expiry</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				{{ Form::open(array('url' =>'/GetStaffSalary',"class"=>"row", "method" => "GET")) }}
					Staff Salary:<hr/>
					<div class="col-md-3">
						<div class="form-group">
							<select name="Year" class="form-control">
								@foreach($Years as $Year)
								<option value="{{$Year}}">{{$Year}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="Month" class="form-control">
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="PlaceID" class="form-control" id="PlaceID" onchange="GetStaffs();">
							@if($UserType=="admin")
								@foreach($Locations as $Location)
								<option value="{{$Location->ID}}">{{$Location->LocationName}}</option>
								@endforeach
							@else
								@foreach($Locations as $Location)
									@if($Location->ID==$LocationID)
									<option value="{{$Location->ID}}">{{$Location->LocationName}}</option>
									@endif
								@endforeach
							@endif
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="StaffID" class="form-control" id="StaffID">
							
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						{{ Form::submit('Download Salary Slip',array('class'=>'btn btn-info')) }}
					</div>
				{{ Form::close() }}
			</div>
			<div class="col-md-12">
				{{ Form::open(array('url' =>'/GetStudentReceipt',"class"=>"row", "method" => "GET")) }}
					Student Payment:<hr/>
					<div class="col-md-3">
						<div class="form-group">
							<select name="StudentID" class="form-control" id="StudentID">
							
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12">
						{{ Form::submit('Download Admission Receipt',array('class'=>'btn btn-info')) }}
					</div>
				{{ Form::close() }}
			</div>
		</div>
    </section>
</section>
@endsection
@section("footer")
<script>
$(document).ready(function(){
	GetStudents();
	GetStaffs();
});
function GetStudents()
{
	$.ajax({
		url:"/GetStudentsByPlaceJSON",
		data:{"PlaceID":document.getElementById("PlaceID").value},
		dataType:"JSON",
		success:function(data)
		{
			var ddl=document.getElementById("StudentID");
			ddl.options.length = 0;
			for(var i=0;i<data.length;i++)
			{
				var val=data[i].ID;
				var title=data[i].Name;
				ddl.options[ddl.options.length] = new Option(title, val);
			}
		},
		error:function()
		{
			
		}
	});
}
function GetStaffs()
{
	$.ajax({
		url:"/GetStaffByPlaceJSON",
		data:{"PlaceID":document.getElementById("PlaceID").value},
		dataType:"JSON",
		success:function(data)
		{
			var ddl=document.getElementById("StaffID");
			ddl.options.length = 0;
			for(var i=0;i<data.length;i++)
			{
				var val=data[i].ID;
				var title=data[i].Name;
				ddl.options[ddl.options.length] = new Option(title, val);
			}
		},
		error:function()
		{
			
		}
	});
}
</script>
@endsection