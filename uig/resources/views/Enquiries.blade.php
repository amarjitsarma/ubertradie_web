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
				<a href="/NewEnquiry" class="btn btn-success">Add New Enquiry</a>
			  </div>
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Place</th>
						<th>Name</th>
						<th>Contact No</th>
						<th>Email</th>
						<th>Enquiry Date</th>
						<th>Message</th>
						<th>Reminder On</th>				
						@if($UserType=="admin")
							<th>Delete</th>
						@endif
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Enquiries as $Enquiry)
					<tr>
						<td>{{$Enquiry->LocationName}}</td>
						<td>{{$Enquiry->Name}}</td>
						<td>{{$Enquiry->Email}}</td>
						<td>{{$Enquiry->ContactNo}}</td>
						<td>{{$Enquiry->EnquiryDate}}</td>
						<td>{{$Enquiry->Message}}</td>
						<td>{{$Enquiry->ReminderOn}}</td>
						@if($UserType=="admin")
						<td><a onclick="confirm('Are you sure?');" href="/DeleteEnquiry?ID={{$Enquiry->ID}}">Delete</a></td>
						@endif
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection