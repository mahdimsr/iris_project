@extends('layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title set-font" style="margin-bottom: 15px">ارسال خبر</h4>
                        @if(session('success'))

                            <div class="alert alert-success set-font">
                                {{session('success')}}
                            </div>

                        @endif
                    </div>
                    <div class="content">
                        <form method="post" action="{{route('news-send-post')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                                        <label>عنوان</label>
                                        <input required type="text" class="form-control"
                                               placeholder="عنوان خبر" name="title">
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">متن خبر</label>
                                        <textarea class="form-control rounded-0" id="content" name="content" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-info btn-fill pull-right">ارسال پیام</button>
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


    </script>

    <script>
        function formatRepo(repo) {
            if (repo == undefined) {
                var markup = "اطلاعاتی وجود ندارد";
            } else {
                var markup = '<span style="text-align:right">' + repo.name + '</span>';
            }

            // var markup = "<div class='select2-result-repository clearfix'>" +
            //     "<div class='select2-result-repository__avatar inline'></div>" +
            //     "<div class='select2-result-repository__meta inline'>" +
            //     "<div class='select2-result-repository__title inline'>" + repo.name + "</div>"+
            //     " - <div class='select2-result-repository__title inline'>" + repo.website + "</div>"+
            //     " - <div class='select2-result-repository__title inline'>قیمت اصلی:" + repo.price + "</div>"+
            //     " - <div class='select2-result-repository__title inline'>قیمت تخفیف:" + repo.off_price + "</div>";


            return markup;

        }

        function formatRepoSelection(repo) {
            return repo.name;
        }

        jQuery(document).ready(function ($) {
            var select2 = $("#receiver").select2({
                ajax: {
                    url: '/getUsers',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term // search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data,
                        };
                    },
                    cache: true
                },
                placeholder: 'نام کاربر را جستجو کنید.',
                minimumInputLength: 1,
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                templateResult: formatRepo,
                templateSelection: formatRepoSelection

            });

            $("#receiver").on('select2:selecting', function (e) {
                console.log(e.params.args.originalEvent.target.className);
                if (e.params.args.originalEvent.target.className === 'link') {
                    e.preventDefault();
                }

            });

        });
    </script>
@endsection