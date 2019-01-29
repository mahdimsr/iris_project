@extends('layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title set-font" style="margin-bottom: 15px">ویرایش جلسه</h4>
                        @if(session('userDuplicate'))

                            <div class="alert alert-danger set-font">
                                <strong>هشدار!</strong> <b>{{session('userDuplicate')}}</b> در زمان تعیین شده نمی تواند
                                در جلسه حضور داشته باشد.
                            </div>

                        @endif

                        @if(session('agenda_error'))

                            <div class="alert alert-danger set-font">
                                <strong>هشدار!</strong> {{session('agenda_error')}}
                            </div>

                        @endif
                    </div>
                    <div class="content">
                        <form method="post" action="{{route('meetings-edit-post')}}">
                            {{csrf_field()}}
                            <input type="text" name="meeting_id" value="{{$Meeting->id}}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('meetingTitle') ? 'has-error' : ''}}">
                                        <label>موضوع جلسه</label>
                                        <input required type="text" class="form-control"
                                               placeholder="عنوان یا موضوعی که قرار است مطرح شود" name="meetingTitle"
                                               value="{{$Meeting->title}}">
                                        <span class="help-block">{{ $errors->first('meetingTitle') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" {{$errors->has('meetingPlace') ? 'has-error' : ''}}>
                                        <label>مکان برگذاری</label>
                                        <input required type="text" class="form-control" name="meetingPlace"
                                               value="{{$Meeting->place}}">
                                        <span class="help-block">{{ $errors->first('meetingPlace') }}</span>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group calendar-div" {{$errors->has('meetingDate') ? 'has-error' : ''}}>
                                        <label>تاریخ و زمان برگذاری</label>
                                        <input required class="form-control calendar" name="meetingDate"
                                               value="{{$Meeting->date}}"/>
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
                                <?php $i=1?>
                                @foreach($Agendas as $Agenda)
                                    <div id="row{{$i++}}">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>عنوان دستور جلسه</label>
                                                <input required name="title[]" class="form-control" value="{{$Agenda->title}}">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>کاربر</label>
                                                <select name="user[]" class="form-control">
                                                    @foreach($Users as $User)
                                                        <option class="set-font"
                                                                <?php if ($User->id == $Agenda->userId){echo 'selected';}?>
                                                                value="{{$User->id}}">{{$User->name . '   '.'('.$User->post->persianTitle.')'}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>زمان</label>
                                                <input required name="time[]" type="number" class="form-control" value="{{$Agenda->value_time}}">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group center">
                                                <button type="button" onclick="removeRow('row{{$i - 1}}');"
                                                        class="form-control btn-sm btn-danger btn-fill remove-btn">حذف
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            <button type="submit" class="btn btn-info btn-fill pull-right">ویرایش جلسه</button>
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

        idCounter = {{$i = $i - 1}};
        function addRow() {
            idCounter++;
            var id = 'row' + idCounter + '';
            var body = "<div class=\"col-md-4\">" +
                "<div class=\"form-group\">" +
                "<label>عنوان دستور جلسه</label>" +
                "<input required name=\"title[]\" class=\"form-control\">" +
                "</div>" +
                "</div>" +
                "<div class=\"col-md-4\">" +
                "<div class=\"form-group\">" +
                "<label>کاربر</label>" +
                "<select name=\"user[]\" class=\"form-control\">" +
                "@foreach($Users as $user)" +
                "<option class=\"set-font\" value=\"{{$user->id}}\">{{$user->name . '   '.'('.$user->post->persianTitle.')'}}</option>" +
                "@endforeach" +
                "</select>" +
                "</div>" +
                "</div>" +
                "<div class=\"col-md-3\">" +
                "<div class=\"form-group\">" +
                "<label>زمان</label>" +
                "<input required name=\"time[]\" type=\"number\" class=\"form-control\">" +
                "</div>" +
                "</div>" +

                "<div class=\"col-md-1\">" +
                "<div class=\"form-group center\">" +
                `<button type=\"button\" onclick=\"removeRow('row${idCounter}');\"` +
                "class=\"form-control btn-sm btn-danger btn-fill remove-btn\">حذف" +
                "</button>" +
                "</div>" +
                "</div>";

            addTag('userRow', 'div', 'row' + idCounter, body);
        }

    </script>


@endsection