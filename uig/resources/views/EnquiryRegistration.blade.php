@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
				{{ Form::open(array('url' => '/SaveEnquiry',"class"=>"row","enctype"=>"multipart/form-data")) }}
				<!-- PlaceID	Name	Email	ContactNo	EnquiryDate	Message	ReminderOn -->
				<div class="col-md-6">
					<div class="col-md-6">
						<div class="form-group">
							<label>Location: </label>
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
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name: </label>
							<input type="text" name="Name" class="form-control">
						</div>
					</div>	
					<div class="col-md-6">
						<div class="form-group">
							<label>Email: </label>
							<input type="text" name="Email" class="form-control">
						</div>
					</div>	
					<div class="col-md-3">
						<div class="form-group">
							<label>ContactNo: </label>
							<input type="text" name="ContactNo" class="form-control">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Reminder On: </label>
							<input type="text" name="ReminderOn" class="form-control datepicker">
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Message: </label>
						<textarea class="form-control" name="Message"></textarea>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close() }}<!--/row -->
          </section>
      </section>
@endsection