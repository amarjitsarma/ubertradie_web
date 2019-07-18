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
              {{ Form::open(array('url' => '/UpdateKeyword?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveKeyword',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-6">
					<div class="form-group">
						<label>Keyword: </label>
						<input type="text" name="keyword" class="form-control" value="{{$keyword}}" required>
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
						<th>Keyword</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Keywords as $Keyword)
					<tr>
						<td>{{$Keyword->keyword}}</td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteKeyword?ID={{$Keyword->id}}">Delete</a></td>
						<td><a href="/Keywords?ID={{$Keyword->id}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
          </section>
      </section>
@endsection
@section("footer")

@endsection