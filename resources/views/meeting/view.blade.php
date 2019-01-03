@extends('layout')

@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 ">
				<div class="card ">
					<div class="header">
						<h4 class="title set-font">جلسات</h4>
						<p class="category set-font" style="margin-bottom: 15px">لیست تمامی جلسات سازمان</p>
						<a class="btn-sm btn-info btn-fill set-font"
						   href="{{action('Dashboard\\MeetingController@insertView')}}">ثبت جلسه</a>
					</div>
					<div class="content">
						@if(count($meetings) > 0)
							<table class="table table-hover table-striped">
								<thead>
								<th scope="col">عنوان</th>
								<th scope="col">مکان</th>
								<th scope="col">تاریخ و زمان</th>
								<th scope="col">وضعیت</th>
								<th scope="col">عملیات</th>
								</thead>
								<tbody>
								@foreach($meetings as $meeting)
									<tr>
										<td class="set-font">{{$meeting->title}}</td>
										<td class="set-font">{{$meeting->place}}</td>
										<td class="set-font">{{$meeting->jalaliDate}}</td>
										<td class="set-font">{{\App\Lib\Enum::meetingState($meeting->state)}}</td>
										<td class="set-font">

											<a href="{{action('Dashboard\\MeetingController@editView',['id' => $meeting->id])}}"
											   class="btn-sm btn-fill btn-info set-font">ویرایش</a>
											<a href="{{action('Dashboard\\MeetingController@remove',['id' => $meeting->id])}}" class="btn-sm btn-fill btn-danger set-font">حذف</a>

										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
						@else
							<div class="inline-block align-middle ">
								<h1 class="font-weight-normal lead set-font" id="desc">هیچ جلسه ای وجود ندارد!!</h1>
								<a class="btn btn-info btn-fill set-font"
								   href="{{action('Dashboard\\MeetingController@insertView')}}">ثبت جلسه</a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

@stop