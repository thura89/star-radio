@extends('backend.layouts.master')

@section('title', 'Create Events')
@section('events-active', 'mm-active')

@section('styles')
    <!-- Flatpickr -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-flatpickr.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-flatpickr-airbnb.css') }}" rel="stylesheet">

@endsection
@section('content')

    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('event.creat_event')</li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('event.creat_event')</h1>
            </div>
            <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            <div class="card-form__body card-body">
                <form action="{{ route('admin.events.store') }}" method="POST" id="create-form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">@lang('event.event_title')</label>
                        <input type="text" name="title" class="form-control" id="title"
                            placeholder="Enter your Events Title ..">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="localtion">@lang('event.location')</label>
                                <input type="text" name="location" class="form-control" id="location"
                                    placeholder="Enter Event Location ..">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="text-label" for="event_date">@lang('event.event_date')</label>
                                <input name="event_date" id="event_date" type="text" class="form-control"
                                    placeholder="Event Date" data-toggle="flatpickr" value="today">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@lang('event.event_photo')</label>
                        <div class="event_photo_preview mb-1"></div>
                        <input type="file" class="form-control p-1" name="event_photo[]" id="event_photo">
                    </div>
                    <div class="form-group">
                        <label for="Body">@lang('event.body')</label>
                        <textarea class="form-control" name="body" id="Body" cols="30" rows="10"
                            placeholder="Enter your text .."></textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('event.image')</label>
                        <div class="input-field">
                            <div class="input-images-1" style="padding-top: .5rem;"></div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">@lang('event.submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Flatpickr -->
    <script src="{{ asset('flowdesh_theme/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/flatpickr.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\StoreEvent', '#create-form') !!}

    @include('backend.layouts.image_upload_create_script')
    <script type="text/javascript">
        $(document).ready(function() {
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
    </script>

@endsection
