@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
    <a href="/freelancers" class="btn btn-xs btn-danger pull-right" style="margin-top: 5px;"><i class="fa fa-arrow-left"></i> Back</a>
	   <div class="row" style="padding: 15px;">
	   		<h2>Freelancer Details</h2>
			<div class="col-md-6" style="border: 1px solid rgba(255,255,255,0.9);padding: 5px;border-radius: 5px;">
				<div class="col-md-6">Name: <strong>{{$freelancerDtls->fullname}}</strong></div>
				<div class="col-md-6">Location: <strong>{{$freelancerDtls->location}}</strong></div>
				<div class="col-md-6">House: <strong>{{$freelancerDtls->house_no}}</strong></div>
				<div class="col-md-6">Street: <strong>{{$freelancerDtls->street_name}}</strong></div>
				<div class="col-md-6">Suburb: <strong>{{$freelancerDtls->suburb}}</strong></div>
				<div class="col-md-6">State: <strong>{{$freelancerDtls->state}}</strong></div>
				<div class="col-md-6">Code: <strong>{{$freelancerDtls->code}}</strong></div>
				<div class="col-md-6">PostCode: <strong>{{$freelancerDtls->postcode}}</strong></div>
				<div class="col-md-6">Longitute: <strong>{{$freelancerDtls->longitude}}</strong></div>
				<div class="col-md-6">Latitude: <strong>{{$freelancerDtls->latitude}}</strong></div>
				<div class="col-md-6">Radius: <strong>{{$freelancerDtls->radius}}</strong></div>
			</div>
			<div class="col-md-6" style="border: 1px solid rgba(255,255,255,0.9);padding: 5px;border-radius: 5px;">
				<div class="col-md-12">
					<img class="img-rounded" src="{{URL::asset('assets/img/ui-sherman.jpg')}}">
				</div>
				<div class="col-md-12">
					{{FlAbout::getFlAbout($freelancerDtls->id)->short_desc}}
				</div>
				<div class="col-md-12" style="text-align: justify;">
					{{FlAbout::getFlAbout($freelancerDtls->id)->about}}
				</div>
			</div>
			<div class="col-md-12">
				<h5>Contacts</h5>
				<table class="table" style="border: 1px solid #ddd;background: white;">
					<tr>
						<td>Phone: <strong>{{FlContact::getFlContact($freelancerDtls->id)->phone}}</strong></td>
						<td>Mobile: <strong>{{FlContact::getFlContact($freelancerDtls->id)->mobile}}</td>
						<td>Email: <strong>{{FlContact::getFlContact($freelancerDtls->id)->email}}</strong></td>
						<td>Website: <strong>{{FlContact::getFlContact($freelancerDtls->id)->website}}</strong></td>
					</tr>
				</table>
			</div>

			<div class="col-md-12">
				<h5>Keywords</h5>
				<table class="table table-bordered table-striped">
					<?php $i=1; ?>
					@foreach(FlKeyword::getFlKeyword($freelancerDtls->id) as $flkey)
					<tr>
						<td>{{$i}}</td>
						<td>{{$flkey->keyword}}</td>
					</tr>
					<?php $i++; ?>
					@endforeach
				</table>
			</div>
			<div class="col-md-12">
				<h5>Tagline</h5>
				<table class="table table-bordered" style="background: white;">
					<tr>
						<td>
							@foreach(FlTagline::getFlTagline($freelancerDtls->id) as $flTag)
								<label class="label label-warning">{{$flTag->tagline}}</label>
							@endforeach
						</td>
					</tr>					
				</table>
			</div>
			<div class="col-md-12">
				<h5>Service</h5>
				<table class="table" style="border: 1px solid #ddd;background: white;padding 3px;">
					<tr>
						<td><strong>{{FlService::getFlService($freelancerDtls->id)->services}}</td>
					</tr>
				</table>
			</div>
			<div class="col-md-12"  style="margin-top: 20px;">
				<h5>Working Hour</h5>
				<table class="table table-striped table-bordered" width="100%">
					<tr>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
					</tr>
					<tr>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->monday}}</td>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->tuesday}}</td>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->wednessday}}</td>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->thursday}}</td>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->friday}}</td>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->saturday}}</td>
						<td>{{FlWorkingHour::getFlWorkingHour($freelancerDtls->id)->sunday}}</td>
					</tr>
				</table>
			</div>
			<div class="col-md-12"  style="margin-top: 20px;">
				<h5>Working Profile</h5>
				@foreach(FlPhoto::getFlPhoto($freelancerDtls->id) as $flphoto)
					<div class="col-md-3"><img class="img-rounded" style="width: 100%" src="{{URL::asset($flphoto->Photo)}}"><p style="text-align: center;">{{$flphoto->title}}</p></div>
				@endforeach
			</div>
		</div>
    </section>
</section>
@endsection