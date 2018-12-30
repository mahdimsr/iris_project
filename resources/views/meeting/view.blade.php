@extends('layout')

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 ">
				<div class="card ">
					<div class="header">
						<h4 class="title set-font">جلسات</h4>
						<p class="category set-font">لیست تمامی جلسات سازمان</p>
					</div>
					<div class="content">
						@if(count($meetings) > 0)
							<table class="table table-hover table-striped">
								<thead>
								<th scope="col">عنوان</th>
								<th scope="col">مکان</th>
								<th scope="col">تاریخ و زمان</th>
								<th scope="col">وضعیت</th>
								</thead>
								<tbody>
								@foreach($meetings as $meeting)
									<tr>
										<td>{{$meeting->title}}</td>
										<td>{{$meeting->place}}</td>
										<td>{{$meeting->start}}</td>
										<td>{{$meeting->state}}</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						@else
							<div class="inline-block align-middle ">
								<h1 class="font-weight-normal lead set-font" id="desc">هیچ جلسه ای وجود ندارد!!</h1>
								<a class="btn btn-info btn-fill set-font" href="{{action('Dashboard\\MeetingController@insertView')}}">ثبت جلسه</a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@stop