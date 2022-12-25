@extends('backend.layouts.master')

@section('title', 'Create Song Request')
@section('song_request-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('song_request.create')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('song_request.create')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.song_requests.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">@lang('song_request.name')</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name ..">
                </div>
                <div class="form-group">
                    <label for="email">@lang('song_request.email')</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email ..">
                </div>
                <div class="form-group">
                    <label for="songname">@lang('song_request.songname')</label>
                    <input type="text" name="songname" class="form-control" id="songname" placeholder="Enter your songname ..">
                </div>
                <div class="form-group">
                    <label for="artist">@lang('song_request.artist')</label>
                    <input type="text" name="artist" class="form-control" id="artist" placeholder="Enter your artist ..">
                </div>
                <div class="form-group">
                    <label for="message">@lang('song_request.message')</label>
                    <textarea class="form-control" name="message" id="message" cols="20" rows="10" placeholder="Enter your text .."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">@lang('song_request.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CreateSongRequest', '#create-form') !!}
@endsection