@extends('backend.layouts.master')

@section('title', 'Create Slider')
@section('slider-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('slider.creat')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('slider.creat')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.sliders.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">@lang('slider.title')</label>
                    <input type="title" name="title" class="form-control" id="title" placeholder="Enter your Slider Title ..">
                </div>
                <div class="form-group">
                    <label for="description">@lang('slider.description')</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Enter your text .."></textarea>
                </div>
                <div class="form-group">
                    <label>@lang('slider.front_image')</label>
                    <div class="front_img_preview mb-1"></div>
                    <input type="file" class="form-control p-1" name="front_image[]" id="front_image">
                </div>
                <div class="form-group">
                    <label>@lang('slider.background_image')</label>
                    <div class="background_img_preview mb-1"></div>
                    <input type="file" class="form-control p-1" name="background_image[]" id="background_image">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input name="status" class="custom-control-input" type="checkbox" value="1" id="invalidCheck01" required="" checked="">
                        <label class="custom-control-label" for="invalidCheck01">
                            @lang('slider.status')
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('slider.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CreateSlider', '#create-form') !!}


<script type="text/javascript">
    $(document).ready(function(){
        $('#front_image').on('change',function(){
            var file_length = document.getElementById('front_image').files.length;
            $('.front_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.front_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="front_image" class="avatar-img rounded">
                                            </div>`);
            }

        });

        $('#background_image').on('change',function(){
            var file_length = document.getElementById('background_image').files.length;
            $('.background_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.background_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="background_image" class="avatar-img rounded">
                                            </div>`);
            }

        });
       
    });
</script>

@endsection