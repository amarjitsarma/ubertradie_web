@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			@if($UserType!="admin")
			  {{ Form::open(array('url' =>'/StudentAttendanceSheet',"class"=>"row", "method" => "GET")) }}
				<div class="col-md-4">
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
				<div class="col-md-8">
					{{ Form::submit('Enter Attendance',array('class'=>'btn btn-info')) }}
				</div>
			  {{ Form::close() }}
			@endif
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Location Name</th>
						<th>Code</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>DOB</th>
						<th>Entry Date</th>
						<th>Entry Time</th>
						<th>Exit Time</th>
						<th>Attended Duration</th>
						<th>Status</th>
						
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Attendances as $Attendance)
					<tr>
						<td>{{$Attendance->LocationName}}</td>
						<td>{{$Attendance->Code}}</td>
						<td>{{$Attendance->Name}}</td>
						<td>{{$Attendance->MobileNo}}</td>
						<td>{{$Attendance->DOB}}</td>
						<td>{{$Attendance->EntryDate}}</td>
						<td>{{$Attendance->EntryTime}}</td>
						<td>{{$Attendance->ExitTime}}</td>
						<td>{{$Attendance->AttendedDuration}}</td>
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