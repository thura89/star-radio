@extends('backend.layouts.master')

@section('title', 'Create Ads')
@section('ads-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('ads.creat_ads')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('ads.creat_ads')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.ads.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">@lang('ads.ads_title')</label>
                    <input type="title" name="title" class="form-control" id="title" placeholder="Enter your Ads Title ..">
                </div>
                
                <div class="form-group">
                    <label>@lang('ads.image')</label>
                    <div class="img_preview mb-1"></div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input name="status" class="custom-control-input" type="checkbox" value="1" id="invalidCheck01" required="" checked="">
                        <label class="custom-control-label" for="invalidCheck01">
                            @lang('ads.status')
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('ads.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\CreateAds', '#create-form') !!}


<script type="text/javascript">
    $(document).ready(function(){
        $('#image').on('change',function(){
            var file_length = document.getElementById('image').files.length;
            $('.img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Image" class="avatar-img rounded">
                                            </div>`);
            }

        });
    });
</script>

@endsection