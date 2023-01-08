@extends('backend.layouts.master')
@section('styles')
<!-- Flatpickr -->
<link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-flatpickr.css') }}" rel="stylesheet">
{{-- <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-flatpickr.rtl.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-flatpickr-airbnb.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-flatpickr-airbnb.rtl.css') }}" rel="stylesheet"> --}}
    <style>
        .remove-field i {
            font-size: 24px;
            color: red;
        }

        .remove-field i:hover {
            font-size: 24px;
            color: #000fff33;
        }

        .add-field i {
            font-size: 24px;
        }

        .add-field i:hover {
            font-size: 24px;
            color: #000fff33;
        }

        .multi-fields span {
            display: contents !important;
        }

        p.add {
            line-height: 37px;
        }
    </style>
@endsection
@if (request()->route()->named('admin.contact'))
    @section('contact-active', 'mm-active')
    @section('title', 'Edit Contact')
@endif
@if (request()->route()->named('admin.about'))
    @section('title', 'Edit about')
    @section('about-active', 'mm-active')
@endif
@if (request()->route()->named('admin.daily_schedule'))
    @section('title', 'Edit daily_schedule')
    @section('daily_schedule-active', 'mm-active')
@endif

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @lang('blog.edit')

                        </li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('blog.edit')</h1>
            </div>
            <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            <div class="card-form__body card-body">
                <form action="{{ route('admin.blog.store', $data->id) }}" method="POST" id="update-form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">@lang('blog.title')</label>
                        <input value="{{ $data->title }}" type="title" name="title" class="form-control" id="title"
                            placeholder="Enter your Noble Title .." disabled>
                    </div>

                    @if (request()->route()->named('admin.daily_schedule'))
                        <div class="form-group">
                            <label for="Body">Program</label>
                            
                            @foreach (json_decode($data->body) ?? [] as $key => $body)
                            @php $random = Str::random(30); @endphp
                            <div class="row data_{{$random}}">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="program_name" name="program_name[]"
                                            value="{{$key}}" placeholder="Program Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="time" name="time[]"
                                            value="{{$body}}" placeholder="time" required>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                    <button class="btn btn-danger" type="button" onclick="fromdata_remove_education_fields('{{$random}}');"> <i class="material-icons">close</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            @endforeach
                            <div id="education_fields">

                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="program_name" name="program_name[]"
                                            value="" placeholder="Program Name" >
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="time" name="time[]"
                                            value="" placeholder="time" >
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-btn">
                                                <button class="btn btn-info" type="button" onclick="education_fields();"> <i class="material-icons">add</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label for="Body">@lang('blog.body')</label>
                            <textarea class="ckeditor form-control" name="body" id="Body" cols="30" rows="10"
                                placeholder="Enter your text ..">{!! $data->body !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>@lang('blog.image')</label>
                            <div class="input-field">
                                <div class="input-images-2" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">@lang('blog.submit')</button>

                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
@if ($data->id != 3)
    @include('backend.layouts.image_upload_edit_script')
@endif
    
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    <!-- Flatpickr -->
    <script src="{{ asset('flowdesh_theme/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/flatpickr.js') }}"></script>



    <script type="text/javascript">
        $(document).ready(function() {

            $('.multi-field-wrapper').each(function() {
                var $wrapper = $('.multi-fields', this);
                $(".add-field", $(this)).click(function(e) {
                    $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find(
                        'input').val('').focus();
                });
                $('.multi-field .remove-field', $wrapper).click(function() {
                    if ($('.multi-field', $wrapper).length > 1)
                        $(this).parent('.multi-field').remove();
                });
            });

            $('.ckeditor').ckeditor();

            $('#event_photo').on('change', function() {
                var file_length = document.getElementById('event_photo').files.length;
                $('.event_photo_preview').html('');
                for (let i = 0; i < file_length; i++) {
                    $('.event_photo_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Avatar" class="avatar-img rounded">
                                            </div>`);
                }

            });



        });
        var room = 1;

        function education_fields() {

            room++;
            var objTo = document.getElementById('education_fields')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML =
                '<div class="row"><div class="col-sm-4 nopadding"><div class="form-group"> <input required type="text" class="form-control" id="program_name" name="program_name[]" value="" placeholder="Program Name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><input required type="text" class="form-control" id="time" name="time[]" value="" placeholder="time"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' +
                room +
                ');"> <i class="material-icons">close</i></button></div></div></div></div><div class="clear"></div></div>';

            objTo.appendChild(divtest)
        }

        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
        }
        function fromdata_remove_education_fields(rid) {
            $('.data_' + rid).remove();
        }
    </script>
@endsection
