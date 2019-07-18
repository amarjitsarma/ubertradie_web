@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
			@if(@UserType!="admin")
			  <div class="row">
				<a href="/StudentRegistration" class="btn btn-success">Add New Student</a>
			  </div>
			@endif
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Location</th>
						<th>ID No</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Address</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Home Phone</th>
						<th>Mobile No</th>
						<th>Work Place</th>
						<th>Designation</th>
						<th>Emergency Person</th>
						<th>Emergency Contact No</th>	
						<th>How You Know</th>
						<th>Program</th>
						<th>StartDate</th>	
						<th>Expiry Date</th>
						<th>Marital Status</th>
						<th>Blood Group</th>
						<th>Any Medical History</th>
						<th>Personal Trainer</th>
						<th>Program Fees</th>
						<th>Personal Trainer Fees</th>
						<th>Photo</th>
						@if($UserType=="admin")
						<th>Delete</th>
						<th>Edit</th>
						@endif
						<th>Upgrade</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Students as $Student)
					<tr>
						<td>{{$Student->LocationName}}</td>
						<td>{{$Student->IDNo}}</td>
						<td>{{$Student->BiometricCode}}</td>
						<td>{{$Student->Name}}</td>
						<td>{{$Student->Address}}</td>
						<td>{{$Student->Age}}</td>
						<td>{{$Student->DOB}}</td>
						<td>{{$Student->Sex}}</td>
						<td>{{$Student->HomePhone}}</td>
						<td>{{$Student->MobileNo}}</td>
						<td>{{$Student->WorkPlace}}</td>
						<td>{{$Student->Designation}}</td>
						<td>{{$Student->EmergencyPerson}}</td>
						<td>{{$Student->EmergencyContactNo}}</td>
						<td>{{$Student->HowYouKnow}}</td>
						<td>{{$Student->PackageName}}</td>
						<td>{{$Student->StartDate}}</td>
						<td>{{$Student->ExpiryDate}}</td>
						<td>{{$Student->MaritalStatus}}</td>
						<td>{{$Student->BloodGroup}}</td>
						<td>{{$Student->AnyMedicalHistory}}</td>
						<td>{{$Student->PersonalTrainer}}</td>
						<td>{{$Student->ProgramFees}}</td>
						<td>{{$Student->PersonalTrainerFees}}</td>
						<td><img src="{{$Student->Photo}}" width="100px"></td>
						@if($UserType=="admin")
						<td><a onclick="confirm('Are you sure?');" href="/DeleteStudent?ID={{$Student->ID}}">Delete</a></td>
						<td><a href="/StudentRegistration?ID={{$Student->ID}}">Edit</a></td>
						@endif
						<td><a href="/StudentUpgrade?ID={{$Student->ID}}&PlaceID={{$Student->PlaceID}}">Upgrade</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection