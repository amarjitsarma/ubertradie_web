@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
			  <div class="row">
				<a href="/StaffRegistration" class="btn btn-success">Add New Staff</a>
			  </div>
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Place ID</th>
						<th>Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Mobile No</th>
						<th>Designation</th>
						<th>Emergency Person</th>
						<th>Emergency Contact No</th>	
						<th>Joining Date</th>	
						<th>Marital Status</th>
						<th>Blood Group</th>
						<th>Any Medical History</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Staffs as $Staff)
					<tr>
						<td>{{$Staff->PlaceID}}</td>
						<td>{{$Staff->Code}}</td>
						<td>{{$Staff->Name}}</td>
						<td>{{$Staff->Address}}</td>
						<td>{{$Staff->Age}}</td>
						<td>{{$Staff->DOB}}</td>
						<td>{{$Staff->Sex}}</td>
						<td>{{$Staff->MobileNo}}</td>
						<td>{{$Staff->Designation}}</td>
						<td>{{$Staff->EmergencyPerson}}</td>
						<td>{{$Staff->EmergencyContactNo}}</td>
						<td>{{$Staff->JoiningDate}}</td>
						<td>{{$Staff->MaritalStatus}}</td>
						<td>{{$Staff->BloodGroup}}</td>
						<td>{{$Staff->AnyMedicalHistory}}</td>
						<td><a onclick="confirm('Are you sure?');" href="/DeleteStaff?ID={{$Staff->ID}}">Delete</a></td>
						<td><a href="/StaffRegistration?ID={{$Staff->ID}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection