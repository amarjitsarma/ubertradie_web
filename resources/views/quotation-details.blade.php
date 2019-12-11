@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
    	<a href="/quotations" class="btn btn-xs btn-danger pull-right" style="margin-top: 5px;"><i class="fa fa-arrow-left"></i> Back</a>
	   	<div class="row" style="padding: 15px;">
	   		<h3>Quotation Details</h3>
			<div class="col-md-6" style="border: 1px solid rgba(255,255,255,0.9);padding: 10px;border-radius: 5px;">
				<div class="col-md-6">
					Title: <strong>{{$quotationDtls->title}}</strong>
				</div>
				<div class="col-md-6">
					Skills: <strong>{{$quotationDtls->skills}}</strong>
				</div>
				<div class="col-md-6">
					Payment Mode: <strong>{{$quotationDtls->payment_mode}}</strong>
				</div>
				<div class="col-md-6">
					Estimate Duration: <strong>{{$quotationDtls->estimate_duration}}</strong>
				</div>
				<div class="col-md-6">
					Quote To: <strong>{{Freelancer::getFreelancerByUserID($quotationDtls->quote_to)->fullname}}</strong>
				</div>
				<div class="col-md-12">
					Description: <br><strong>{{$quotationDtls->description}}</strong>
				</div>

			</div>
			<div class="col-md-12">
				<h5>Files</h5>
				<div class="col-md-12">
					@foreach(Quote::getQuotationFiles($quotationDtls->id) as $qut)
					<a href="#">{{$qut->quote_description}}</a><br/>
					@endforeach
				</div>
			</div>
		</div>
    </section>
</section>
@endsection