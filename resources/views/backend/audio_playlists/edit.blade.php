@extends('backend.layouts.master')

@if (!request()->route()->named('admin.audios.show'))
    @section('title', 'Show Audio')    
@else
    @section('title', 'Edit Audio')    
@endif

@section('audio-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (request()->route()->named('admin.audios.show'))
                            @lang('audio.show')   
                        @else
                            @lang('audio.edit')   
                        @endif
                    </li>
                </ol>
            </nav>
            <h1 class="m-0">{{ $data->title }}</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            @if (request()->route()->named('admin.audios.edit'))
                <form action="{{ route('admin.audios.update',$data->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">@lang('audio.title')</label>
                    <input value="{{ $data->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Title ..">
                </div>
                <div class="form-group">
                    <label for="descriptions">@lang('audio.descriptions')</label>
                    <textarea class="form-control" name="descriptions" id="descriptions" cols="30" rows="10" placeholder="Enter your text ..">{{ $data->descriptions }}</textarea>
                </div>
                <div class="form-group">
                    <label>@lang('audio.image')</label>
                    <div class="img_preview mb-1">
                        @if ($data->image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $data->audio_playlist_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                <div class="form-group">
                    <label>@lang('audio.audio_file')</label>
                    <div class="file_preview mb-1">
                        <audio controls onplay="pauseOthers(this)">
                            <source src="{{$data->audio_playlist_file_path()}}" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                    <input type="file" class="form-control p-1" name="files[]" id="files">
                </div>

                @if (request()->route()->named('admin.audios.edit'))
                    <button type="submit" class="btn btn-primary">@lang('audio.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateAudio', '#update-form') !!}

<script type="text/javascript">

    $(document).ready(function(){

        $('#image').on('change',function(){
            var file_length = document.getElementById('image').files.length;
            $('.img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Avatar" class="avatar-img rounded">
                                            </div>`);
            }

        });
        $('#files').on('change',function(){
            var file_length = document.getElementById('files').files.length;
            $('.file_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.file_preview').append(`<div class="">
                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons avatar-img rounded" style="font-size:60px">audiotrack</i>
                                            </div>`);
            }

        });
    });
</script>

@endsection