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
						<form method="post" action="{{action('Dashboard\\MeetingController@insert')}}">
							{{csrf_field()}}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group" {{$errors->has('meetingPlace') ? 'has-error' : ''}}>
										<label>مکان برگذاری</label>
										<input type="text" class="form-control" name="meetingPlace" value="{{old('meetingPlace')}}">
										<span class="help-block">{{ $errors->first('meetingPlace') }}</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group {{$errors->has('meetingTitle') ? 'has-error' : ''}}">
										<label>موضوع جلسه</label>
										<input type="text" class="form-control"
											   placeholder="عنوان یا موضوعی که قرار است مطرح شود" name="meetingTitle" value="{{old('meetingTitle')}}">
										<span class="help-block">{{ $errors->first('meetingTitle') }}</span>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group calendar-div" {{$errors->has('meetingDate') ? 'has-error' : ''}}>
										<label>تاریخ و زمان برگذاری</label>
										<input class="form-control calendar" name="meetingDate"/>
										<span class="help-block">{{ $errors->first('meetingDate') }}</span>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>افراد شرکت کننده</label>
										<div>
											<button onclick="addRow();" id="addUser" type="button"
													class="btn btn-info btn-fill add-btn" data-toggle="modal"
													data-target="#myModal">
												افزودن کاربر
											</button>
										</div>
									</div>
								</div>
							</div>

							<div class="row" id="userRow">
								{{--<div id="row1">
									<div class="col-md-1">
										<div class="form-group center">
											<button type="button" onclick="removeRow('row1');"
													class="form-control btn-sm btn-danger btn-fill remove-btn">حذف
											</button>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>زمان</label>
											<input name="time[]" type="number" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>کاربر</label>
											<select name="user[]" class="form-control">
												@foreach($users as $user)
													<option class="set-font" value="{{$user->id}}">{{$user->name . '   '.'('.$user->post->persianTitle.')'}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>عنوان دستور جلسه</label>
											<input name="title[]" class="form-control">
										</div>
									</div>
								</div>--}}
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

		var idCounter = 0;



		function addRow()
		{
			idCounter++;
			var id   = 'row' + idCounter + '';
			var body = "<div class=\"col-md-1\">\n" +
				"\t\t\t\t\t\t\t\t\t\t<div class=\"form-group center\">\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" onclick=\"removeRow('row1');\"\n" +
				"\t\t\t\t\t\t\t\t\t\t\t\t\tclass=\"form-control btn-sm btn-danger btn-fill remove-btn\">حذف\n" +
				"\t\t\t\t\t\t\t\t\t\t\t</button>\n" +
				"\t\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t<div class=\"col-md-3\">\n" +
				"\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<label>زمان</label>\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<input name=\"valueTime[]\" type=\"number\" class=\"form-control\">\n" +
				"\t\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">\n" +
				"\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<label>کاربر</label>\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<select name=\"user[]\" class=\"form-control\">\n" +
				"@foreach($users as $user)\n" +
				"\t\t\t\t\t\t\t\t\t\t\t\t\t<option class=\"set-font\" value=\"{{$user->id}}\">{{$user->name . '   '.'('.$user->post->persianTitle.')'}}</option>\n" +
				"@endforeach\n" +
				"\t\t\t\t\t\t\t\t\t\t\t</select>\n" +
				"\t\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">\n" +
				"\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<label>عنوان دستور جلسه</label>\n" +
				"\t\t\t\t\t\t\t\t\t\t\t<input name=\"title[]\" class=\"form-control\">\n" +
				"\t\t\t\t\t\t\t\t\t\t</div>\n" +
				"\t\t\t\t\t\t\t\t\t</div>";

			addTag('userRow', 'div', 'row' + idCounter, body);
		}



		function addTag(parentId, elementTag, elementId, body)
		{
			var parentElement = document.getElementById(parentId);
			var newElement    = document.createElement(elementTag);
			newElement.setAttribute('id', elementId);
			newElement.innerHTML = body;
			parentElement.appendChild(newElement);
		}



		function removeRow(elementId)
		{
			console.log(elementId);
			var element       = document.getElementById(elementId);
			var parentElement = document.getElementById('userRow');
			parentElement.removeChild(element);
		}

	</script>


@endsection