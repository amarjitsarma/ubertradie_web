@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<div class="col-md-12">
				{{ Form::open(array('url' =>'/StaffSalaryHistory',"class"=>"row", "method" => "GET")) }}
					<div class="col-md-3">
						<div class="form-group">
							<select name="PlaceID" class="form-control" id="PlaceID" onchange="this.form.submit();">
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
					<div class="col-md-3">
						<div class="form-group">
							<select name="StaffID" class="form-control" id="StaffID" onchange="this.form.submit();">
								@foreach($Staffs as $Staff)
								<option value="{{$Staff->ID}}"
								@if($Staff->ID==$StaffID)
									selected
								@endif
								>{{$Staff->Name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				{{ Form::close() }}
			</div>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Mobile No</th>
						<th>Designation</th>
						<th>Joining Date</th>
						<th>Marital Status</th>
						<th>Salary</th>
						<th>Work Days</th>
						<th>Month</th>
						<th>Year</th>
						<th>Monthly Salary</th>
						<th>Absent Penalty Per Day</th>
						<th>Working Days</th>
						<th>Absent Penalty</th>
						<th>Total Salary</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Salaries as $Salary)
					<tr>
						<td>{{$Salary->BiometricCode}}</td>
						<td>{{$Salary->Name}}</td>
						<td>{{$Salary->Age}}</td>
						<td>{{$Salary->DOB}}</td>
						<td>{{$Salary->Sex}}</td>
						<td>{{$Salary->MobileNo}}</td>
						<td>{{$Salary->Designation}}</td>
						<td>{{$Salary->JoiningDate}}</td>
						<td>{{$Salary->MaritalStatus}}</td>
						<td>{{$Salary->Salary}}</td>
						<td>{{$Salary->WorkDays}}</td>
						<td>{{$Salary->Month}}</td>
						<td>{{$Salary->Year}}</td>
						<td>{{$Salary->MonthlySalary}}</td>
						<td>{{$Salary->AbsentPenaltyPerDay}}</td>
						<td>{{$Salary->WorkingDays}}</td>
						<td>{{$Salary->AbsentPenalty}}</td>
						<td>{{$Salary->TotalSalary}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
</section>
@endsection