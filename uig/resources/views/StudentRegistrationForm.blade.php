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
			@if(isset($_GET["ID"]))
              {{ Form::open(array('url' => '/UpdateStudent?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveStudent',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div id="my_camera"></div>
					<a onclick="take_snapshot()" class="btn btn-success">Take Snapshot</a>
					OR
					<input type="file" id="file" accept="image/*" onchange="LoadPhoto();" class="btn btn-danger">
				</div>
				<div class="col-sm-6" id="results">
					@if($Photo!="")
					<img src="{{$Photo}}" width="320px" height="240px"/>
					@endif
				</div>
				<input type="hidden" value="" name="Photo" id="Photo">
				<script type="text/javascript" src="/js/webcam.js"></script>
				<script language="JavaScript">
					Webcam.set({
						width: 320,
						height: 240,
						image_format: 'jpeg',
						jpeg_quality: 90,
						force_flash: true
					});
					Webcam.attach( '#my_camera' );
				</script>
				<div class="clearfix"></div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Location: </label>
						<select name="PlaceID" class="form-control">
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
				<div class="col-md-4">
					<div class="form-group">
						<label>ID No: </label>
						<input type="text" name="IDNo" class="form-control" value="{{$IDNo}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Biometric Code: </label>
						<input type="text" name="BiometricCode" class="form-control" value="{{$BiometricCode}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Name: </label>
						<input type="text" name="Name" class="form-control" value="{{$Name}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Age: </label>
						<input type="text" name="Age" class="form-control" value="{{$Age}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Date Of Birth: </label>
						<input type="text" name="DOB" class="form-control datepicker" value="{{$DOB}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Sex: </label>
						<select name="Sex" class="form-control">
							<option value="Male"
							@if($Sex=="Male")
							selected
							@endif
							>Male</option>
							<option value="Female"
							@if($Sex=="Female")
							selected
							@endif
							>Female</option>
							<option value="Other"
							@if($Sex=="Other")
							selected
							@endif
							>Others</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Address: </label>
						<textarea class="form-control" name="Address" required>{{$Address}}</textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Home Phone: </label>
						<input type="text" name="HomePhone" class="form-control" value="{{$HomePhone}}" required minLength="10" maxLength="10" >
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Mobile No: </label>
						<input type="text" name="MobileNo" class="form-control" value="{{$MobileNo}}" required minLength="10" maxLength="10" >
					</div>
				</div>
				
				<div class="col-md-4">
					<div class="form-group">
						<label>Work Place: </label>
						<input type="text" name="WorkPlace" class="form-control" value="{{$WorkPlace}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Designation: </label>
						<input type="text" name="Designation" class="form-control" value="{{$Designation}}" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Emergency Person Name: </label>
						<input type="text" name="EmergencyPerson" class="form-control" value="{{$EmergencyPerson}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Emergency Contact No: </label>
						<input type="text" name="EmergencyContactNo" class="form-control" value="{{$EmergencyContactNo}}" required minLength="10" maxLength="10" >
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>How You Know: </label>
						<input type="text" name="HowYouKnow" class="form-control" value="{{$HowYouKnow}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Start Date: </label>
						<input type="text" name="StartDate" id="StartDate" class="form-control datepicker" value="{{$StartDate}}" onchange="GetPackageDetail();" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Program: </label>
						<select name="Program" class="form-control" id="Program" onchange="GetPackageDetail();">
						@foreach($Packages as $Package)
							<option value="{{$Package->ID}}"
							@if($Package->ID==$Program)
							selected
							@endif
							>{{$Package->PackageName}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Expiry Date: </label>
						<input type="text" name="ExpiryDate" id="ExpiryDate" class="form-control datepicker" value="{{$ExpiryDate}}" required readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Marital Status: </label>
						<select name="MaritalStatus" class="form-control">
							<option value="Married"
							@if($MaritalStatus=="Married")
							selected
							@endif
							>Married</option>
							<option value="Unmarried"
							@if($MaritalStatus=="Unmarried")
							selected
							@endif
							>Unmarried</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Any Medical History:</label>
						<textarea class="form-control" name="AnyMedicalHistory" required>{{$AnyMedicalHistory}}</textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Blood Group: </label>
						<input type="text" name="BloodGroup" class="form-control" value="{{$BloodGroup}}" required>
					</div>
				</div>
				
				<div class="col-md-4">
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
				<div class="col-md-4">
					<div class="form-group">
						<label>ID Proof Copy:</label>
						<input type="file" name="IDProof" id="IDProof" class="form-control"/>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row"
				@if(isset($_GET["ID"]))
					style="display:none;"
				@endif
				>
					<div class="col-md-2">
						<div class="form-group">
							<label>Program Fees:</label>
							<input type="text" name="ProgramFees" id="ProgramFees" class="form-control" value="{{$ProgramFees}}" readonly>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Personal Trainer Fees: </label>
							<input type="text" name="PersonalTrainerFees" id="PersonalTrainerFees" class="form-control" value="{{$PersonalTrainerFees}}" readonly>
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
							<input type="text" name="PaidAmount" id="PaidAmount" class="form-control" value="" onfocus="this.select();">
						</div>
					</div>
					
					<div class="col-md-2">
						<div class="form-group">
							<label>Receipt No:</label>
							<input type="text" name="ReceiptNo" id="ReceiptNo" value="{{$ReceiptNo}}" class="form-control" value="" required>
						</div>
					</div>
				</div>
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
<script language="JavaScript">
	function take_snapshot() {
		// take snapshot and get image data
		Webcam.snap( function(data_uri) {
			// display results in page
			document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
			document.getElementById('Photo').value=data_uri;
		} );
	}
	function LoadPhoto()
	{
		var file=document.getElementById("file");
		if(file.files)
		{
			var FR= new FileReader();
    
			FR.addEventListener("load", function(e) {
				document.getElementById('results').innerHTML = '<img src="'+e.target.result+'" height="240px" width="320px"/>';
				document.getElementById('Photo').value=e.target.result;
			}); 
			
			FR.readAsDataURL( file.files[0] );
		}
	}
</script>
@endsection