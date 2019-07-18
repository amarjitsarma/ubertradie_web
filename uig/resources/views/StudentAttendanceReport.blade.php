@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			  {{ Form::open(array('url' =>'/StudentAttendanceReport',"class"=>"row", "method" => "GET")) }}
				<div class="col-md-3">
					<div class="form-group">
						<label>From Date:</label>
						<input type="text" name="FromDate" value="{{$FromDate}}" class="form-control datepicker" onchange="this.form.submit();">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>To Date:</label>
						<input type="text" name="ToDate" value="{{$ToDate}}" class="form-control datepicker" onchange="this.form.submit();">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Location</label>
						<select name="PlaceID" class="form-control" onchange="this.form.submit();">
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
						<label>Students</label>
						<select name="StudentID" class="form-control" onchange="this.form.submit();">
							<option value="0">All</option>
							@foreach($Students as $Student)
							<option value="{{$Student->ID}}"
							@if($Student->ID==$StudentID)
								selected
							@endif
							>{{$Student->Name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			  {{ Form::close() }}
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Entry Date</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>DOB</th>
						<th>Status</th>
						
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Attendances as $Attendance)
					<tr>
						<td>{{$Attendance->EntryDate}}</td>
						<td>{{$Attendance->BiometricCode}}</td>
						<td>{{$Attendance->Name}}</td>
						<td>{{$Attendance->MobileNo}}</td>
						<td>{{$Attendance->DOB}}</td>
						<td>
							@if($Attendance->Status==1)
							Present
							@else
							Absent
							@endif
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection