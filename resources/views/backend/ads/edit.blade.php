@extends('backend.layouts.master')

@if (!request()->route()->named('admin.ads.show'))
    @section('title', 'Show Ads')    
@else
    @section('title', 'Edit Ads')    
@endif


@section('ads-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('ads.edit_ads')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('ads.edit_ads')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            @if (request()->route()->named('admin.ads.edit'))
                <form action="{{ route('admin.ads.update',$ads->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">@lang('ads.ads_title')</label>
                    <input value="{{ $ads->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Noble Title ..">
                </div>
                <div class="form-group">
                    <label>@lang('ads.image')</label>
                    <div class="img_preview mb-1">
                        @if ($ads->image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $ads->ads_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input name="status" class="custom-control-input" type="checkbox" value="1" id="invalidCheck01" required="" @if($ads->status == 1) checked="checked" @endif >
                        <label class="custom-control-label" for="invalidCheck01">
                            @lang('ads.status')
                        </label>
                    </div>
                </div>
                
                @if (request()->route()->named('admin.ads.edit'))
                    <button type="submit" class="btn btn-primary">@lang('ads.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateAds', '#update-form') !!}

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
    });
</script>

@endsection