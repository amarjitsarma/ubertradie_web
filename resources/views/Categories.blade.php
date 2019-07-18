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
              {{ Form::open(array('url' => '/UpdateCategory?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveCategory',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-4">
					<div class="form-group">
						<label>Category Name: </label>
						<input type="text" name="CategoryName" class="form-control" value="{{$CategoryName}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Thumbnail: </label>
						<input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Cover Photo: </label>
						<input type="file" name="cover_photo" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Detail: </label>
						<textarea name="description" class="form-control" required>{{$description}}</textarea>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close() }}<!--/row -->
			 
			  <table id="dataTable" class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>CategoryName</th>
						<th>Description</th>
						<th>Thumbnail</th>
						<th>Cover Photo</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Categories as $Category)
					<tr>
						<td>{{$Category->CategoryName}}</td>
						<td>{{$Category->description}}</td>
						<td><img src="uploads/{{$Category->thumbnail}}" width="200px"></td>
						<td><img src="uploads/{{$Category->cover_photo}}" width="200px"></td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteCategory?ID={{$Category->ID}}">Delete</a></td>
						<td><a href="/Categories?ID={{$Category->ID}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
          </section>
      </section>
@endsection
@section("footer")
<script>
function CheckAll()
{
	var x=document.getElementsByClassName("chk");
	for(var i=0;i<x.length;i++)
	{
		x[i].checked=true;
	}
}
</script>
@endsection