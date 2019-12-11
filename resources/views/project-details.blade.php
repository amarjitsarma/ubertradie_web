@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
    	<a href="/projects" class="btn btn-xs btn-danger pull-right" style="margin-top: 5px;"><i class="fa fa-arrow-left"></i> Back</a>
    	<div class="row" style="padding: 14px;border: 1px solid #ddd;background: rgba(255,255,255,0.9);">
    		<h2>Project Details</h2>
    		<div class="col-md-6" style="border: 1px solid #eee;padding: 10px;border-radius: 5px;">
	    		<div class="col-md-6">
		   				<label>Project ID: </label><strong>{{$projectDtls->id}}</strong>
		   		</div>
		   		<div class="col-md-6">
		   				<label>Category: </label><strong>{{Category::getCategory($projectDtls->category)->CategoryName}}</strong>
		   		</div> 
		   		<div class="col-md-6">
		   				<label>Sub Category: </label><strong>{{SubCategory::getSubCategory($projectDtls->sub_category)->SubCategoryName}}</strong>
		   		</div> 
		   		<div class="col-md-6">
		   				<label>Location Type: </label><strong>{{$projectDtls->location_type}}</strong>
		   		</div> 
		   		<div class="col-md-6">
		   				<label>Title: </label><strong>{{$projectDtls->title}}</strong>
		   		</div>

		   		<div class="col-md-6">
		   				<label>Skills: </label><strong>{{$projectDtls->skills}}</strong>
		   		</div>
		   		<div class="col-md-6">
		   				<label>Payment Mode: </label><strong>{{$projectDtls->payment_mode}}</strong>
		   		</div>
		   		<div class="col-md-6">
		   				<label>Estimated Budget: </label><strong>{{$projectDtls->estimate_budget}}</strong>
		   		</div>
		   		<div class="col-md-6">
		   				<label>Working Hours: </label><strong>{{$projectDtls->working_hour}}</strong>
		   		</div>
		   		<div class="col-md-6">
		   				<label>Project Allocated To: </label><strong>@if(isset($projectDtls->completed_by)){{Freelancer::getFreelancerByUserID($projectDtls->completed_by)->fullname}}@else N/A @endif</strong>
		   		</div>
		   		<div class="col-md-12">
		   				<label>Description: </label><strong><br>{{$projectDtls->description}}</strong>
		   		</div>
		   	</div>
			<div class="col-md-6"  style="border: 1px solid #eee;padding: 10px;border-radius: 5px;">
				<div class="col-md-12">Address:<br><strong>{{ProjectAddress::getProjectAddress($projectDtls->id)->house_no}}, {{ProjectAddress::getProjectAddress($projectDtls->id)->street}}, {{ProjectAddress::getProjectAddress($projectDtls->id)->suberb}}, {{ProjectAddress::getProjectAddress($projectDtls->id)->state}}, {{ProjectAddress::getProjectAddress($projectDtls->id)->code}}</strong>
				<br/>Location: <strong>{{ProjectAddress::getProjectAddress($projectDtls->id)->location}}</strong><br>Longitude: <strong>{{ProjectAddress::getProjectAddress($projectDtls->id)->longitude}}</strong><br>Latitude: <strong>{{ProjectAddress::getProjectAddress($projectDtls->id)->latitude}}</strong></div>
				<div class="col-md-12">Status: @if($projectDtls->status == 1)<label class="label label-success">Active</label>@else<label class="label label-danger">Inactive</label>@endif</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-12" style="padding: 10px;">
				Project related files. Please click <a href="">Here</a> to download.
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-12" style="margin-top: 10px;">
				@if($projectDtls->status == 0)<a href="/project/status/{{$projectDtls->id}}" class="btn btn-xs btn-success">Activate</a>@else<a href="/project/status/{{$projectDtls->id}}" class="btn btn-xs btn-danger">De-activate</a>@endif
				</div>
			</div>
    	</div>
	   	<div class="row">
	   		
			<h2 style="text-align: center;">Bids</h2>
			<div class="col-md-12" style="overflow:scroll;" >
				<table id="dataTable" class="table table-striped table-bordered" width="100%">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>Bidder Name</th>
							<th>Bid Amount</th>
							<th>Compeltion Time(in days)</th>
							<th>Description</th>
							<th>Status</th>
							<th>Operation</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach(Project::getProjectBids($projectDtls->id) as $bids)
						<tr>
							<td>{{$i}}</td>
							<td>{{Freelancer::getFreelancerByUserID($bids->user_id)->fullname}}</td>
							<td>{{$bids->bid_amount}}</td>
							<td>{{$bids->completion_time}}</td>
							<td>{{$bids->bid_desc}}</td>
							<td>@if($bids->status==1) Active @else Inactive @endif</td>
							<td>@if($bids->status == 0)<a href="/project-bid/status/{{$bids->id}}" class="btn btn-xs btn-success">Activate</a>@else<a href="/project-bid/status/{{$bids->id}}" class="btn btn-xs btn-danger">De-activate</a>@endif</td>
						</tr>
						<?php $i++; ?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
    </section>
</section>
@endsection