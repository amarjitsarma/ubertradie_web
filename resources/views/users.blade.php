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
			{{ Form::open(array('url' => '/add/user','class'=>'row')) }}
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('email','Email ID',array('id'=>'','class'=>'')) }} {{ Form::text('email','',array('id'=>'email','class'=>'form-control','placeholder'=>'Email ID')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('first_name','First Name',array('id'=>'','class'=>'')) }} {{ Form::text('first_name','',array('id'=>'first_name','class'=>'form-control','placeholder'=>'First Name')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('last_name','Last Name',array('id'=>'','class'=>'')) }} {{ Form::text('last_name','',array('id'=>'last_name','class'=>'form-control','placeholder'=>'Last Name')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('dob','Date Of Birth',array('id'=>'','class'=>'')) }} {{ Form::text('dob','',array('id'=>'dob','class'=>'form-control datepicker','placeholder'=>'YYYY-MM-DD')) }}
                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('phone','Phone No',array('id'=>'','class'=>'')) }} {{ Form::text('phone','',array('id'=>'phone','class'=>'form-control','placeholder'=>'Phone No')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('username','User Name',array('id'=>'','class'=>'')) }} {{ Form::text('username','',array('id'=>'username','class'=>'form-control','placeholder'=>'User Name')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('password','Password',array('id'=>'','class'=>'')) }}
                            <input type="password" name="password" id="Password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('ConPassword','ConPassword',array('id'=>'','class'=>'')) }}
                            <input type="password" name="password_confirmation" id="_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-bottom: 15px;">
					<br>
                    {{ Form::submit('Submit',array('class'=>'btn btn-info')) }}
					<br>
                    </div>
                    {{ Form::close() }}<!--/row -->
			  <div class="row" style="overflow:scroll;">
				<table id="dataTable" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
								<th>Email</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>DOB</th>
								<th>Phone</th>
								<th>User Name</th>
								<th>Status</th>
								<th colspan="2" style="text-align: center;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Users as $User)
                            <tr>
                                <td>{{$User->email}}</td>
								<td>{{$User->first_name}}</td>
								<td>{{$User->last_name}}</td>
								<td>{{$User->dob}}</td>
								<td>{{$User->phone}}</td>
								<td>{{$User->username}}</td>
								<td>@if($User->status==1)
									Active
									@else
									Inactive
									@endif
								</td>
                                <td><a onclick="return confirm('Are you sure');" href="/User/DeleteUser?ID={{$User->id}}">Delete</a></td>
								<td><a onclick="return confirm('Are you sure');" href="/User/ChangeStatus?ID={{$User->id}}">Change Status</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
			  </div>
          </section>
      </section>
@endsection