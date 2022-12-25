@extends('backend.layouts.master')

@section('title', 'Create Category')
@section('category-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('category.create')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('category.create')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">@lang('category.title')</label>
                    <input type="title" name="title" class="form-control" id="title" placeholder="Enter your Title ..">
                </div>
                <div class="form-group">
                    <label for="descriptions">@lang('category.description')</label>
                    <textarea class="form-control" name="descriptions" id="descriptions" cols="20" rows="10" placeholder="Enter your text .."></textarea>
                </div>
                <div class="form-group">
                    <label>@lang('category.image')</label>
                    <div class="img_preview mb-1"></div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                <button type="submit" class="btn btn-primary">@lang('category.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CreateCategory', '#create-form') !!}
<script>
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
    });
</script>
@endsection