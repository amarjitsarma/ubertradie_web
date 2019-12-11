@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
	   <div class="row" style="overflow:scroll;">
			<table id="dataTable" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
						<th>Quotation To</th>
						<th>Title</th>
						<th>Description</th>
						<th>Skills</th>
                        <th>Payment Mode</th>
						<th>Estimate Duration</th>
						<th>Status</th>
						<th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotations as $fl)
                    <tr>
                        <td>{{$fl->quote_to}}</td>
						<td>{{$fl->title}}</td>
						<td>{{$fl->description}}</td>
						<td>{{$fl->skills}}</td>
						<td>{{$fl->payment_mode}}</td>
						<td>{{$fl->estimate_duration}}</td>
						<td>@if($fl->status==1)
							Active
							@else
							Inactive
							@endif
						</td>
						<td style="text-align: center;"><a href="/quotation-details/{{$fl->id}}"  class="btn btn-xs btn-primary">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
    </section>
</section>
@endsection