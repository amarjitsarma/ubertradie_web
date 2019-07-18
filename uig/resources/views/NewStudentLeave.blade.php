@extends('layouts.app')
@section("content")
<section id="main-content">
          <section class="wrapper">
		  @if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			<hr/>
			<div class="row">
				<div class="col-md-3">
					Name: {{$Student[0]->Name}}
				</div>
				<div class="col-md-3">
					Code: {{$Student[0]->Code}}
				</div>
				<div class="col-md-3">
					Mobile No: {{$Student[0]->MobileNo}}
				</div>
				<div class="col-md-3">
					Date Of Birth: {{$Student[0]->DOB}}
				</div>
			</div>
			<hr/>
			{{ Form::open(array('url' =>'/SaveStudentLeave?PlaceID='.$PlaceID."&StudentID=".$StudentID,"class"=>"row", "method" => "POST")) }}
				<div class="col-md-6">
					<div class="form-group">
						<label>From Date:</label>
						<input type="text" class="datepicker form-control" name="FromDate" required>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>To Date:</label>
						<input type="text" class="datepicker form-control" name="ToDate" required>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Reason:</label>
						<textarea class="form-control" name="Reason" required></textarea>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
			  {{ Form::close() }}
          </section>
      </section>
@endsection