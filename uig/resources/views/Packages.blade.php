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
              {{ Form::open(array('url' => '/UpdatePackage?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SavePackage',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-3">
					<div class="form-group">
						<label>Package Name: </label>
						<input type="text" name="PackageName" class="form-control" value="{{$PackageName}}">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Package Price: </label>
						<input type="text" name="Price" class="form-control" value="{{$Price}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Personal Trainer Fees Per Month: </label>
						<input type="text" name="PersonalTrainer" class="form-control" value="{{$PersonalTrainer}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Duration: </label>
						<select name="Duration" class="form-control">
							@for($i=1;$i<=12;$i++)
							<option value="{{$i}}"
							@if($i==$Duration)
								selected
							@endif
							>{{$i}} Month</option>
							@endfor
						</select>
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
						<th>PackageName</th>
						<th>Package Price</th>
						<th>Personal Trainer Fees(P/M)</th>
						<th>Duration</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Packages as $Package)
					<tr>
						<td>{{$Package->PackageName}}</td>
						<td>{{$Package->Price}}</td>
						<td>{{$Package->PersonalTrainer}}</td>
						<td>{{$Package->Duration}}</td>
						<td><a onclick="confirm('Are you sure?');" href="/DeletePackage?ID={{$Package->ID}}">Delete</a></td>
						<td><a href="/Packages?ID={{$Package->ID}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  </div>
          </section>
      </section>
@endsection