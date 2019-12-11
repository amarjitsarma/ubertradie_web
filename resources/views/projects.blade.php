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
						<th>Location Type</th>
						<th>Title</th>
						<th>Description</th>
						<th>Skills</th>
						<th>Payment Mode</th>
                        <th>Estimate Budget</th>
                        <th>Working Hour</th>
                        <th>Rating</th>
                        <th>Status</th>
						<th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $proj)
                    <tr>
                        <td>{{Category::getCategory($proj->category)->CategoryName}}</td>
						<td>{{SubCategory::getSubCategory($proj->sub_category)->SubCategoryName}}</td>
						<td>{{$proj->location_type}}</td>
						<td>{{$proj->title}}</td>
						<td>{{$proj->description}}</td>
						<td>{{$proj->skills}}</td>
                        <td>{{$proj->payment_mode}}</td>
                        <td>{{$proj->estimate_budget}}</td>
                        <td>{{$proj->working_hour}}</td>
                        <td>{{$proj->rating}}</td>
						<td>@if($proj->status==1)
							Active
							@else
							Inactive
							@endif
						</td>
						<td style="text-align: center;"><a href="/project-details/{{$proj->id}}" class="btn btn-xs btn-primary">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
    </section>
</section>
@endsection