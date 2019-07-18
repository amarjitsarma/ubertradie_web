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
              {{ Form::open(array('url' => '/UpdateContact?ID='.$_GET['ID'],"class"=>"row","enctype"=>"multipart/form-data")) }}
			@else
				{{ Form::open(array('url' => '/SaveContact',"class"=>"row","enctype"=>"multipart/form-data")) }}
			@endif
				<div class="col-md-3">
					<div class="form-group">
						<label>Full Name: </label>
						<input type="text" name="FullName" class="form-control" value="{{$FullName}}">
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label>Contact No: </label>
						<input type="text" name="ContactNo" class="form-control" value="{{$ContactNo}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Email ID: </label>
						<input type="text" name="EmailID" class="form-control" value="{{$EmailID}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Detail: </label>
						<textarea name="Detail" class="form-control">{{$Detail}}</textarea>
					</div>
				</div>
				
				<div class="clearfix"></div>
				<div class="col-md-12">
					{{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
				</div>
              {{ Form::close() }}<!--/row -->
			  {{ Form::open(array('url' => '/SendMessageToContact',"class"=>"row", "style"=>"overflow:scroll;")) }}
			  <div class="col-md-6">
				<div class="form-group">
					<label>Message</label>
					<textarea name="Message" class="form-control"></textarea>
				</div>
				</div>
			<div class="col-md-6">
				<br/>
				<a class="btn btn-danger" onclick="CheckAll();">Check All</a><br/><br/>
				<button type="submit" class="btn btn-info">Send Message To Selected</button>
			  </div>
			  <table class="table table-striped table-bordered table-responsive" width="100%">
					<thead>
					<tr>
						<th>Check</th>
						<th>Full Name</th>
						<th>Contact No</th>
						<th>Email ID</th>
						<th>Detail</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					</thead>
					<tbody>
					@foreach($Contacts as $Contact)
					<tr>
						<td><input type="checkbox" class="chk" name="chkContact[]" id="chkContact[]" value="{{$Contact->ContactNo}}"></td>
						<td>{{$Contact->FullName}}</td>
						<td>{{$Contact->ContactNo}}</td>
						<td>{{$Contact->EmailID}}</td>
						<td>{{$Contact->Detail}}</td>
						<td><a onclick="return confirm('Are you sure?');" href="/DeleteContact?ID={{$Contact->ID}}">Delete</a></td>
						<td><a href="/Contacts?ID={{$Contact->ID}}">Edit</a></td>
					</tr>
					@endforeach
					</tbody>
				</table>
			  {{ Form::close() }}<!--/row -->
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
		alert("test1");
		x[i].checked=true;
		alert("test2");
	}
}
</script>
@endsection