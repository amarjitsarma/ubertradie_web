@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
		<div class="row">
			<div class="col-md-12">
				{{ Form::open(array('url' =>'/PersonalTrainerHistory',"class"=>"row", "method" => "GET")) }}
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
				{{ Form::close() }}
			</div>
			<div class="col-md-12" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<td>Code</td>
						<td>Name</td>
						<td>Address</td>
						<td>Age</td>
						<td>DOB</td>
						<td>Sex</td>
						<td>Home Phone</td>
						<td>Mobile No</td>
					</tr>
					</thead>
					<tbody>
					@foreach($PersonalTrainers as $PersonalTrainer)
					<tr>
						<td>{{$PersonalTrainer->Code}}</td>
						<td>{{$PersonalTrainer->Name}}</td>
						<td>{{$PersonalTrainer->Address}}</td>
						<td>{{$PersonalTrainer->Age}}</td>
						<td>{{$PersonalTrainer->DOB}}</td>
						<td>{{$PersonalTrainer->Sex}}</td>
						<td>{{$PersonalTrainer->HomePhone}}</td>
						<td>{{$PersonalTrainer->MobileNo}}</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
</section>
@endsection