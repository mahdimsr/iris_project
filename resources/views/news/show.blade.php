@extends('layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h3 class="title set-font" style="margin-bottom: 15px;margin-right: 10px;">مشاهده خبر</h3>

                    </div>
                    <div class="content">
                        <div class="row meeting-show">
                            <div class="col-md-6 first">
                                <h3 style="margin-bottom: 15px;margin-right: 10px;">عنوان خبر</h3>
                                <span>{{$Message->title}}</span>
                            </div>
                            <div class="col-md-6">
                                <h3>ارسال کننده</h3>
                                <span>{{$Message->sender->name}}</span>
                            </div>
                        </div>

                        <div class="row" style="text-align: center">
                            <div class="col-md-12">
                                <h3>متن خبر</h3>
                                <span>{{$Message->content}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection