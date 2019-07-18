@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<div class="col-md-12">
				{{ Form::open(array('url' =>'/StudentPaymentHistory',"class"=>"row", "method" => "GET")) }}
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
							<select name="StudentID" class="form-control" id="StudentID" onchange="this.form.submit();">
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
			</div>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Payment Date</th>
						<th>Biometric Code</th>
						<th>Name</th>
						<th>Age</th>
						<th>DOB</th>
						<th>Sex</th>
						<th>Mobile No</th>
						<th>Work Place</th>
						<th>Designation</th>
						<th>Start Date</th>
						<th>Expiry Date</th>
						<th>Marital Status</th>
						<th>Package Name</th>
						<th>Duration</th>
						<th>Personal Trainer</th>
						<th>Program Fees</th>
						<th>PaidAmount</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Receipts as $Receipt)
					<tr>
						<td>{{$Receipt->PaymentDate}}</td>
						<td>{{$Receipt->BiometricCode}}</td>
						<td>{{$Receipt->Name}}</td>
						<td>{{$Receipt->Age}}</td>
						<td>{{$Receipt->DOB}}</td>
						<td>{{$Receipt->Sex}}</td>
						<td>{{$Receipt->MobileNo}}</td>
						<td>{{$Receipt->WorkPlace}}</td>
						<td>{{$Receipt->Designation}}</td>
						<td>{{$Receipt->StartDate}}</td>
						<td>{{$Receipt->ExpiryDate}}</td>
						<td>{{$Receipt->MaritalStatus}}</td>
						<td>{{$Receipt->PackageName}}</td>
						<td>{{$Receipt->Duration}}</td>
						<td>{{$Receipt->PersonalTrainer}}</td>
						<td>{{$Receipt->ProgramFees}}</td>
						<td>{{$Receipt->PaidAmount}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
</section>
@endsection