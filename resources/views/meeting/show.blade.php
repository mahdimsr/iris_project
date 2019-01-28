@extends('layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title set-font" style="margin-bottom: 15px">مشاهده جلسه</h4>
                        @if(session('userDuplicate'))

                            <div class="alert alert-danger set-font">
                                <strong>هشدار!</strong> <b>{{session('userDuplicate')}}</b> در زمان تعیین شده نمی تواند
                                در جلسه حضور داشته باشد.
                            </div>

                        @endif
                    </div>
                    <div class="content">
                        <div class="row meeting-show">
                            <div class="col-md-4 first">
                                <h3>عنوان جلسه</h3>
                                <span>{{$Meeting->title}}</span>
                            </div>
                            <div class="col-md-4">
                                <h3>مکان جلسه</h3>
                                <span>{{$Meeting->place}}</span>
                            </div>
                            <div class="col-md-4">
                                <h3>وضعیت جلسه</h3>
                                <span>
                                    {{\App\Lib\Enum::meetingState($Meeting->state)}}
                                </span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div>
                            <h3>دستور جلسات</h3>
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

                        <div class="row">
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


    </script>


@endsection