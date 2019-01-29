@extends('layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title set-font" style="margin-bottom: 15px;margin-right: 10px;">مشاهده جلسه</h3>
                        @if(session('userDuplicate'))

                            <div class="alert alert-danger set-font">
                                <strong>هشدار!</strong> <b>{{session('userDuplicate')}}</b> در زمان تعیین شده نمی تواند
                                در جلسه حضور داشته باشد.
                            </div>

                        @endif
                    </div>
                    <div class="content">
                        <div class="row meeting-show">
                            <div class="col-md-3 first">
                                <h3 style="margin-bottom: 15px;margin-right: 10px;">عنوان جلسه</h3>
                                <span>{{$Meeting->title}}</span>
                            </div>
                            <div class="col-md-3">
                                <h3>مکان جلسه</h3>
                                <span>{{$Meeting->place}}</span>
                            </div>
                            <div class="col-md-3">
                                <h3>وضعیت جلسه</h3>
                                <span>
                                    {{\App\Lib\Enum::meetingState($Meeting->state)}}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <h3>سازنده جلسه</h3>
                                <span>{{\App\Model\User::find($Meeting->creatorId)->name}}</span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row agenda-lists">
                            <h3 style="margin-bottom: 15px;margin-right: 10px;">دستور جلسات</h3>
                            <div class="agenda">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>عنوان دستور جلسه</th>
                                            <th>کاربر</th>
                                            <th>زمان</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($Meeting->agenda as $Agenda)
                                            <tr>
                                                <td>{{$Agenda->title}}</td>
                                                <td>{{$Agenda->user->name}}</td>
                                                <td>{{$Agenda->value_time}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        @if (count($FilesDoc))

                            <div class="row agenda-lists">
                                <h3>مستندات</h3>
                                <div class="agenda">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>نام مستند</th>
                                                <th>لینک دانلود</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($FilesDoc as $File)
                                                <tr>
                                                    <td>{{$File->name}}</td>
                                                    <td><a target="_blank"
                                                           href="{{route('download-file' , $File->id)}}">لینک دانلود</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        @endif

                        @if (count($FilesFinal))

                            <div class="row agenda-lists">
                                <h3>صورت جلسات</h3>
                                <div class="agenda">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>نام مستند</th>
                                                <th>لینک دانلود</th>
                                                <th>وضعیت</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($FilesFinal as $File)
                                                <?php
                                                $UserFileStatus = DB::table('user_file')->where([
                                                    ['user_id', auth()->user()->id],
                                                    ['file_id', $File->id],
                                                ])->first();
                                                ?>
                                                <tr>
                                                    <td>{{$File->name}}</td>
                                                    <td><a target="_blank"
                                                           href="{{route('download-file' , $File->id)}}">لینک دانلود</a>
                                                    </td>
                                                    <td>
                                                        @if ($File->is_approved == true)
                                                            تائید شده
                                                            @if ($UserFileStatus and $UserFileStatus->is_approved == true)
                                                                (شما تائید کرده اید)
                                                            @else
                                                                (شما تائید نکرده اید)
                                                            @endif
                                                        @else
                                                            تائید نشده
                                                            @if ($UserFileStatus and $UserFileStatus->is_approved == true)
                                                                (شما تائید کرده اید)
                                                            @else
                                                                (شما تائید نکرده اید)
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($UserFileStatus and $UserFileStatus->is_approved == true)
                                                            <a href="{{route('reject-file' , $File->id)}}"
                                                               class="btn-sm btn-fill btn-danger set-font">رد کردن</a>
                                                        @else
                                                            <a href="{{route('accept-file' , $File->id)}}"
                                                               class="btn-sm btn-fill btn-info set-font">تائید
                                                                کردن</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <h3 style="margin-bottom: 15px;margin-right: 10px;">ارسال مستندات</h3>
                            <form action="{{route('meetings-document' , $Meeting->id)}}" method="post"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <center>
                                    <div class="form-group">
                                        <label class="btn btn-fill btn-primary">
                                            فایل را انتخاب کنید
                                            <input required id="file-choose" type="file" style="display: none;"
                                                   name="docfile"
                                                   onChange="validateAndUpload(this);">
                                        </label>
                                    </div>
                                    <div id="file-name-input" style="display: none;" class="form-group">
                                        <label style="font-size: 18px; color: black">نام فایل</label>
                                        <div>
                                            <input style="font-size: 18px; color: black;width: 30%;border: 1px solid black"
                                                   required type="text" class="form-control" name="doc-name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="doc_final" style="color:#000;font-size: 18px">
                                            صورت جلسه
                                        </label>
                                        <input style="border: black" type="checkbox" value="true" id="doc_final"
                                               name="doc_final">
                                    </div>
                                    <div class="text-center form-group">
                                        <button id="file-send-btn" style="display: none;" type="submit"
                                                class="btn btn-info btn-fill">
                                            ارسال مستند
                                        </button>
                                    </div>
                                </center>
                            </form>
                        </div>


                        <div class="clearfix"></div>
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

        function validateAndUpload(input) {
            var file = input.files[0];

            if (file) {

                document.getElementById('file-choose').style.display = 'block';
                document.getElementById('file-send-btn').style.display = 'inline';
                document.getElementById('file-name-input').style.display = 'block';

            } else {
                document.getElementById('file-choose').style.display = 'none';
                document.getElementById('file-send-btn').style.display = 'none';
                document.getElementById('file-name-input').style.display = 'none';

            }
        };

    </script>


@endsection