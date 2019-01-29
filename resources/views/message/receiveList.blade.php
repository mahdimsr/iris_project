@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="card ">
                    <div class="header">
                        <h4 class="title set-font">پیام ها</h4>
                        <p class="category set-font" style="margin-bottom: 15px">لیست تمامی پیام های دریافتی</p>
                    </div>
                    <div class="content">
                        @if(count($messages) > 0)
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th scope="col">عنوان</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">ارسال کننده</th>
                                    <th scope="col">وضعیت</th>
                                    <th scope="col">عملیات</th>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        @if ($message->is_read == true)
                                            <?php $class = 'table-success'?>
                                        @else

                                            <?php $class = 'table-info'?>

                                        @endif
                                        <tr class="{{$class}}">
                                            <td class="set-font">{{$message->title}}</td>
                                            <td class="set-font">{{$message->content}}</td>
                                            <td class="set-font">{{$message->sender->name}}</td>
                                            <td class="set-font">
                                                @if ($message->is_read == true)
                                                    خوانده شده
                                                @else
                                                    خوانده نشده
                                                @endif
                                            </td>
                                            <td class="set-font">
                                                <div class="row">
                                                    <a href="{{route('message-show' , $message->id)}}"
                                                       class="btn-sm btn-fill btn-success set-font">نمایش</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                    {{ $messages->links() }}

                </div>
            </div>
        </div>
    </div>


@stop