@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			{{ Form::open(array('url' =>'/StudentLeave',"class"=>"row", "method" => "GET")) }}
				<div class="col-md-4">
					<div class="form-group">
						<label>Location</label>
						<select name="PlaceID" class="form-control" onchange="this.form.submit();">
							@if($UserType=="admin")
								@foreach($Locations as $Location)
								<option value="{{$Location->ID}}"
							@if($Location->ID==$PlaceID)
								selected
							@endif
							>{{$Location->LocationName}}</option>
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
				<div class="col-md-4">
					<div class="form-group">
						<br/>
						<a href="/NewStudentLeave?StudentID={{$StudentID}}&PlaceID={{$PlaceID}}" class="btn btn-success">Add New Leave</a>
					</div>
				</div>
			  {{ Form::close() }}
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Leave Date</th>
						<th>Reason</th>
						@if($UserType=="admin")
						<th>Delete</th>
						@endif
					</tr>
					</thead>
					<tbody>
					<!-- PlaceID	Code	Name	Address	Age	DOB	Sex	MobileNo	Designation	EmergencyPerson	EmergencyContactNo	JoiningDate	MaritalStatus	BloodGroup	AnyMedicalHistory -->
					@foreach($Leaves as $Leave)
					<tr>
						<td>{{$Leave->LeaveDate}}</td>
						<td>{{$Leave->Reason}}</td>
						@if($UserType=="admin")
						<td><a href="/DeleteStudentLeave?ID={{$Leave->ID}}">Delete Leave</a></td>
						@endif
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection