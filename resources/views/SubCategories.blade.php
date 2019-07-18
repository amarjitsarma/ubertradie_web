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
              {{ Form::open(array('url' => '/UpdateSubCategory?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveSubCategory',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-4">
					<div class="form-group">
						<label>Category: </label>
						<select name="CategoryID" class="form-control">
						@foreach($Categories as $Category)
							<option value="{{$Category->ID}}"
							@if($CategoryID==$Category->ID)
								selected
							@endif
							>{{$Category->CategoryName}}</option>
						@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Sub Category Name: </label>
						<input type="text" name="SubCategoryName" class="form-control" value="{{$SubCategoryName}}" required>
					</div>
				</div>	
				<div class="col-md-4">
					<div class="form-group">
						<label>Icon: </label>
						<input type="file" name="Icon" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label>Cover Photo: </label>
						<input type="file" name="cover_photo" class="form-control" accept=".jpg,.jpeg,.png">
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Short Description: </label>
						<textarea name="short_desc" class="form-control" required>{{$short_desc}}</textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Description: </label>
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
						<th>Sub Category Name</th>
						<th>Icon</th>
						<th>Cover Photo</th>
						<th>Short Desc</th>
						<th>Description</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($SubCategories as $SubCategory)
					<tr>
						<td>{{$SubCategory->SubCategoryName}}</td>
						<td><img src="uploads/{{$SubCategory->Icon}}" width="200px"></td>
						<td><img src="uploads/{{$SubCategory->cover_photo}}" width="200px"></td>
						<td>{{$SubCategory->short_desc}}</td>
						<td>{{$SubCategory->description}}</td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteCategory?ID={{$SubCategory->ID}}">Delete</a></td>
						<td><a href="/Categories?ID={{$SubCategory->ID}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
          </section>
      </section>
@endsection
@section("footer")

@endsection