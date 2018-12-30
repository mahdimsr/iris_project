@extends('layout')
@section('content')

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title set-font">درج جلسه</h4>
					</div>
					<div class="content">

						<!-- Modal -->
						<div class="modal fade" id="myModal" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Modal Header</h4>
									</div>
									<div class="modal-body">
										<p>Some text in the modal.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>

							</div>
						</div>

						<form method="post" action="{{action('Dashboard\\MeetingController@insert')}}">
							{{csrf_field()}}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="exampleInputEmail1">مکان برگذاری</label>
										<input type="text" class="form-control" name="place">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>موضوع جلسه</label>
										<input type="text" class="form-control"
											   placeholder="عنوان یا موضوعی که قرار است مطرح شود" name="title">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group calendar-div">
										<label>تاریخ و زمان برگذاری</label>
										<input class="form-control calendar" name="meetingDate"/>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>افراد شرکت کننده</label>
										<div>
											<button id="addUser" type="button" class="btn btn-info btn-fill add-btn" data-toggle="modal" data-target="#myModal">
												افزودن کاربر
											</button>
										</div>
									</div>
								</div>
							</div>

							<div class="row" >
								<div class="col-md-12">
									<div class="form-group" id="userRow">
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-info btn-fill pull-right">درج جلسه</button>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

	<script>

		$('.calendar').persianDatepicker({

			autoClose: true,
			initialValueType: 'gregorian',
			format: 'YYYY/MM/DD HH:mm:ss',
			altFormat: 'YYYY/MM/DD HH:mm:ss',
			timePicker: {
				enabled: true,
			},
			minDate: new persianDate().unix(),

		});

		function addRow()
		{
			$("#userRow").append("<li>Appended item</li>");
		}

		$(document).ready(function(){
			$("#addUser").click(function(){
				$("#myModal").modal();
			})});
	</script>


@endsection