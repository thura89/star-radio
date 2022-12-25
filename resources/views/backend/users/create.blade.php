@extends('backend.layouts.master')

@section('title', 'Create Users')
@section('user-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('user.create')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('user.create')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.users.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="form-group col">
                        <label for="name">@lang('user.name')</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your Name ..">
                    </div>
                    <div class="form-group col">
                        <label for="email">@lang('user.email')</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email ..">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="phone">@lang('user.phone')</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone ..">
                    </div>
                    <div class="form-group col">
                        <label for="user_type">@lang('user.user_type')</label><br>
                        <select id="user_type" class="custom-select" name="user_type" style="width: auto;">
                                <option value="">Select</option>
                            @foreach (config('const.user_type') as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="description">@lang('user.description')</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter your text .."></textarea>
                    </div>
                    <div class="form-group col">
                        <label for="address">@lang('user.address')</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Enter your text .."></textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col">
                        <label>@lang('user.profile_photo')</label>
                        <div class="profile_img_preview mb-2"></div>
                        <input type="file" class="form-control p-1" name="profile_photo[]" id="profile_photo">
                    </div>
                    <div class="form-group col">
                        <label>@lang('user.cover_photo')</label>
                        <div class="cover_img_preview mb-2"></div>
                        <input type="file" class="form-control p-1" name="cover_photo[]" id="cover_photo">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('user.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CreateUser', '#create-form') !!}


<script type="text/javascript">
    $(document).ready(function(){
        $('#profile_photo').on('change',function(){
            var file_length = document.getElementById('profile_photo').files.length;
            $('.profile_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.profile_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Image" class="avatar-img rounded">
                                            </div>`);
            }

        });
        $('#cover_photo').on('change',function(){
            var file_length = document.getElementById('cover_photo').files.length;
            $('.cover_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.cover_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Image" class="avatar-img rounded">
                                            </div>`);
            }

        });
    });
</script>

@endsection