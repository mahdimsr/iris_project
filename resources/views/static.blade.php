@extends('layout')
@section('content')

    <div class="container-fluid">
        <div class="row meeting-show">
            <div class="col-md-6 first">
                <h5>اخبار خوانده نشده</h5>
                @if (count($News))
                    <ul class="list-group">
                        @foreach($News as $New)
                            <li class="list-group-item"><a href="{{route('news-show', $New->id)}}">{{$New->title}}</a></li>
                        @endforeach
                    </ul>
                @else
                    <h6>هیچ اخبار خوانده نشده ای وجود ندارد.</h6>
                @endif
            </div>
            <div class="col-md-6">
                <h5>پیام های خوانده نشده</h5>

                @if (count($Messages))

                @endif
                @if (count($Messages))
                    <ul class="list-group">
                        @foreach($Messages as $Message)
                            <li class="list-group-item"><a href="{{route('news-show', $Message->id)}}">{{$Message->title}}</a></li>
                        @endforeach
                    </ul>
                @else
                    <h6 style="color: #4673ff;">هیچ پیام خوانده نشده ای وجود ندارد.</h6>
                @endif
            </div>

            <div class="col-md-4">
            </div>
        </div>

    </div>

@endsection