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
              {{ Form::open(array('url' => '/UpdateStaff?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveStaff',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div id="my_camera"></div>
					<a onclick="take_snapshot()" class="btn btn-success">Take Snapshot</a>
					OR
					<input type="file" id="file" accept="image/*" onchange="LoadPhoto();" class="btn btn-danger">
				</div>
				<div class="col-sm-6" id="results">
				
				</div>
				<input type="hidden" value="" name="Photo" id="Photo">
				<script type="text/javascript" src="/js/webcam.js"></script>
				<script language="JavaScript">
					Webcam.set({
						width: 320,
						height: 240,
						image_format: 'jpeg',
						jpeg_quality: 90
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
						<label>Mobile No: </label>
						<input type="text" name="MobileNo" class="form-control" value="{{$MobileNo}}" required maxLength="10" minLength="10">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Designation: </label>
						<select name="Designation" class="form-control">
							<option value="Staff"
							@if($Designation=="Staff")
							selected
							@endif
							>Staff</option>
							<option value="Trainer"
							@if($Designation=="Trainer")
							selected
							@endif
							>Trainer</option>
							<option value="Other"
							@if($Designation=="Other")
							selected
							@endif
							>Others</option>
						</select>
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
						<input type="text" name="EmergencyContactNo" class="form-control" value="{{$EmergencyContactNo}}" required maxLength="10" minLength="10">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Joining Date: </label>
						<input type="text" name="JoiningDate" class="form-control datepicker" value="{{$JoiningDate}}" required>
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
						<label>Blood Group: </label>
						<input type="text" name="BloodGroup" class="form-control" value="{{$BloodGroup}}" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Salary: </label>
						<input type="text" name="Salary" class="form-control" value="{{$Salary}}" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Absent Penalty: </label>
						<input type="text" name="AbsentPenalty" class="form-control" value="{{$AbsentPenalty}}" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Total Work Days: </label>
						<input type="text" name="WorkDays" class="form-control" value="{{$WorkDays}}" required>
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