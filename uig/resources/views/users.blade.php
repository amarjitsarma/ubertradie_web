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
                            {{ Form::label('FullName','Full Name',array('id'=>'','class'=>'')) }} {{ Form::text('fullname','',array('id'=>'FullName','class'=>'form-control','placeholder'=>'Full Name')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('DOB','Date Of Birth',array('id'=>'','class'=>'')) }} {{ Form::text('dob','',array('id'=>'DOB','class'=>'form-control datepicker','placeholder'=>'DOB')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('MobileNo','Mobile Number',array('id'=>'','class'=>'')) }} {{ Form::text('phone','',array('id'=>'phone','class'=>'form-control','placeholder'=>'Mobile Number')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('EmailID','Email ID',array('id'=>'','class'=>'')) }} {{ Form::text('email','',array('id'=>'EmailID','class'=>'form-control','placeholder'=>'Email ID')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('UserID','User ID',array('id'=>'','class'=>'')) }} {{ Form::text('username','',array('id'=>'UserID','class'=>'form-control','placeholder'=>'User ID')) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('Password','Password',array('id'=>'','class'=>'')) }}
                            <input type="password" name="password" id="Password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('ConPassword','ConPassword',array('id'=>'','class'=>'')) }}
                            <input type="password" name="password_confirmation" id="_confirmation" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
					<div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('Location','Location',array('id'=>'','class'=>'')) }}
                            <select name="location" class="form-control">
						@foreach($Locations as $Location)
							<option value="{{$Location->ID}}" 
							
							>{{$Location->LocationName}}</option>
						@endforeach
						</select>
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
                                <th>Full Name</th>
                                <th>DOB</th>
                                <th>Mobile No</th>
                                <th>Email ID</th>
                                <th>User ID</th>
                                <th>Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Users as $User)
                            <tr>
                                <td>{{$User->fullname}}</td>
                                <td>{{$User->dob}}</td>
                                <td>{{$User->phone}}</td>
                                <td>{{$User->email}}</td>
                                <td>{{$User->username}}</td>
                                <td><a onclick="return confirm('Are you sure');" href="/User/DeleteUser?ID={{$User->id}}">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
			  </div>
          </section>
      </section>
@endsection