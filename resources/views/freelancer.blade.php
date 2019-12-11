@extends('layouts.app')
@section("content")
<section id="main-content">
    <section class="wrapper">
	   <div class="row" style="overflow:scroll;">
			<table id="dataTable" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
						<th>Category</th>
						<th>Sub Category</th>
						<th>Full Name</th>
						<th>Address</th>
                        <th>Postcode</th>
						<th>Longitude</th>
						<th>Latitude</th>
						<th>Radius</th>
                        <th>Status</th>
						<th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($freelancers as $fl)
                    <tr>
                        <td>{{Category::getCategory($fl->category)->CategoryName}}</td>
						<td>{{SubCategory::getSubCategory($fl->sub_category)->SubCategoryName}}</td>
						<td>{{$fl->fullname}}</td>
						<td>{{$fl->location}}, {{$fl->house_no}}, {{$fl->street_name}}, {{$fl->suburb}}, {{$fl->state}}, {{$fl->code}}.</td>
						<td>{{$fl->postcode}}</td>
						<td>{{$fl->longitude}}</td>
                        <td>{{$fl->latitude}}</td>
                        <td>{{$fl->radius}}</td>
						<td>@if($fl->status==1)
							Active
							@else
							Inactive
							@endif
						</td>
						<td style="text-align: center;"><a class="btn btn-xs btn-primary" href="/freelancer-details/{{$fl->id}}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
    </section>
</section>
@endsection