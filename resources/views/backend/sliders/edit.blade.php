@extends('backend.layouts.master')

@if (!request()->route()->named('admin.sliders.show'))
    @section('title', 'Show Slider')    
@else
    @section('title', 'Edit Slider')    
@endif


@section('slider-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (request()->route()->named('admin.sliders.show'))
                            @lang('slider.show')   
                        @else
                            @lang('slider.edit')   
                        @endif
                    </li>
                </ol>
            </nav>
            <h1 class="m-0">
                {{ $slider->title }}
            </h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            @if (request()->route()->named('admin.sliders.edit'))
                <form action="{{ route('admin.sliders.update',$slider->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">@lang('slider.noble_title')</label>
                    <input value="{{ $slider->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Slider Title ..">
                </div>
                <div class="form-group">
                    <label for="description">@lang('slider.description')</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Enter your text ..">{{ $slider->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>@lang('slider.front_image')</label>
                    <div class="front_img_preview mb-2">
                        @if ($slider->front_image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $slider->slider_front_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="front_image[]" id="front_image">
                </div>
                <div class="form-group">
                    <label>@lang('slider.background_image')</label>
                    <div class="background_img_preview mb-2">
                        @if ($slider->background_image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $slider->slider_background_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="background_image[]" id="background_image">
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input name="status" class="custom-control-input" type="checkbox" value="1" id="invalidCheck01" required="" @if($slider->status == 1) checked="checked" @endif >
                        <label class="custom-control-label" for="invalidCheck01">
                            @lang('ads.status')
                        </label>
                    </div>
                </div>

                @if (request()->route()->named('admin.sliders.edit'))
                    <button type="submit" class="btn btn-primary">@lang('noble.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateSlider', '#update-form') !!}

<script type="text/javascript">
    $(document).ready(function(){
        $('#front_image').on('change',function(){
            var file_length = document.getElementById('front_image').files.length;
            $('.front_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.front_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Avatar" class="avatar-img rounded">
                                            </div>`);
            }

        });
        $('#background_image').on('change',function(){
            var file_length = document.getElementById('background_image').files.length;
            $('.background_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.background_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Avatar" class="avatar-img rounded">
                                            </div>`);
            }

        });
    });
</script>

@endsection