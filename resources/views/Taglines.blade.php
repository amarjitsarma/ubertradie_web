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
              {{ Form::open(array('url' => '/UpdateTagline?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveTagline',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-6">
					<div class="form-group">
						<label>Tagline: </label>
						<input type="text" name="tagline" class="form-control" value="{{$tagline}}" required>
					</div>
				</div>	
				<div class="col-md-6">
					<br/>
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close() }}<!--/row -->
			 
			  <table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Tagline</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Taglines as $Tagline)
					<tr>
						<td>{{$Tagline->tagline}}</td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteTagline?ID={{$Tagline->id}}">Delete</a></td>
						<td><a href="/Taglines?ID={{$Tagline->id}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
          </section>
      </section>
@endsection
@section("footer")

@endsection