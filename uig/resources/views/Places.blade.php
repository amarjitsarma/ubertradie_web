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
			@if(isset($_GET["ID"]))
              {{ Form::open(array('url' => '/UpdateLocation?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveLocation',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-4">
					<div class="form-group">
						<label>Location Name: </label>
						<input type="text" onfocus="this.select();" name="LocationName" class="form-control" value="{{$LocationName}}">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Full Address: </label>
						<textarea class="form-control" onfocus="this.select();" name="FullAddress">{{$FullAddress}}</textarea>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Contact No: </label>
						<input type="text" name="ContactNo" onfocus="this.select();" class="form-control" value="{{$ContactNo}}">
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Email ID: </label>
						<input type="text" name="EmailID" onfocus="this.select();" class="form-control" value="{{$EmailID}}">
					</div>
				</div>	
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close() }}<!--/row -->
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>	
						<th>Location Name</th>
						<th>Full Address</th>
						<th>Contact No</th>
						<th>Email ID</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Locations as $Location)
					<tr>
						<td>{{$Location->LocationName}}</td>
						<td>{{$Location->FullAddress}}</td>
						<td>{{$Location->ContactNo}}</td>
						<td>{{$Location->EmailID}}</td>
						<td><a onclick="confirm('Are you sure?');" href="/DeleteLocation?ID={{$Location->ID}}">Delete</a></td>
						<td><a href="/Places?ID={{$Location->ID}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection