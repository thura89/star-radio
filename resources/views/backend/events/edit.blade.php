@extends('backend.layouts.master')

@section('title', 'Events')
@section('events-active', 'mm-active')

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('event.edit_event')</li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('event.edit_event')</h1>
            </div>
            <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            <div class="card-form__body card-body">
                @if (!request()->route()->named('admin.events.show'))
                    <form action="{{ route('admin.events.update', $data->id) }}" method="POST" id="update-form"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                @endif

                <div class="form-group">
                    <label for="title">@lang('event.event_title')</label>
                    <input value="{{ $data->title }}" type="text" name="title" class="form-control" id="title"
                        placeholder="Enter your Events Title ..">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="localtion">@lang('event.location')</label>
                            <input value="{{ $data->location }}" type="text" name="location" class="form-control" id="location"
                                placeholder="Enter Event Location ..">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="text-label" for="event_date">@lang('event.event_date')</label>
                            <input name="event_date" id="event_date" type="text" class="form-control"
                                placeholder="Event Date" data-toggle="flatpickr" value="{{ $data->event_date }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>@lang('event.event_photo')</label>
                    <div class="event_photo_preview mb-2">
                        @if ($data->event_photo)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $data->event_photo_path() }}" alt="" class="avatar-img rounded">
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="event_photo[]" id="event_photo">


                </div>
                <div class="form-group">
                    <label for="Body">@lang('event.body')</label>
                    <textarea class="form-control" name="body" id="Body" cols="30" rows="10"
                        placeholder="Enter your text ..">{{ $data->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>@lang('event.image')</label>
                    <div class="input-field">
                        <div class="input-images-2" style="padding-top: .5rem;"></div>
                    </div>
                </div>
                {{-- sample --}}
                
                @if (!request()->route()->named('admin.events.show'))
                    <button type="submit" class="btn btn-primary">@lang('event.submit')</button>
                @endif

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateEvent', '#update-form') !!}
    @include('backend.layouts.image_upload_edit_script')
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
