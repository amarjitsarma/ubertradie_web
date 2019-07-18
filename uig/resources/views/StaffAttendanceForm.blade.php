@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			  
			  {{ Form::open(array('url' =>'/StaffAttendanceSave?PlaceID='.$PlaceID,"class"=>"row", "method" => "POST")) }}
				<table class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Mark</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Mobile No</th>
						<th>DOB</th>
						
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Attendances as $Attendance)
					<tr>
						<td><input type="checkbox" name="chkStaff[]" value="{{$Attendance->ID}}" 
						@if($Attendance->Status!=null)
							checked
						@endif
						></td>
						<td>{{$Attendance->BiometricCode}}</td>
						<td>{{$Attendance->Name}}</td>
						<td>{{$Attendance->MobileNo}}</td>
						<td>{{$Attendance->DOB}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
				{{ Form::submit('Enter Attendance',array('class'=>'btn btn-info')) }}
			  {{ Form::close() }}
          </section>
      </section>
@endsection