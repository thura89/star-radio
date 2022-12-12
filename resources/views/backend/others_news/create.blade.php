@extends('backend.layouts.master')

@section('title', 'Create News')
@section('news-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('news.creat_news')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('news.creat_news')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.other_news.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="title">@lang('news.news_title')</label>
                    <input type="title" name="title" class="form-control" id="title" placeholder="Enter your News Title ..">
                </div>
                <div class="form-group">
                    <label for="news_category">@lang('news.news_type')</label><br>
                    <select id="news_category" class="custom-select" name="news_category" style="width: auto;">
                        @foreach (config('const.others_news') as $key => $news)
                            <option value="{{ $key }}">{{ $news }}</option>    
                        @endforeach
                        
                        
                    </select>
                    <small class="form-text text-muted">@lang('news.news_type_desc')</small>
                </div>
                <div class="form-group">
                    <label for="Body">@lang('news.body')</label>
                    <textarea class="form-control" name="body" id="Body" cols="30" rows="10" placeholder="Enter your text .."></textarea>
                </div>
                <div class="form-group">
                    <label>@lang('news.image')</label>
                    <div class="img_preview mb-1"></div>
                    <input type="file" class="form-control p-1" name="image[]" id="news_img">
                </div>
                
                <button type="submit" class="btn btn-primary">@lang('news.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\StoreNews', '#create-form') !!}


<script type="text/javascript">
    $(document).ready(function(){
        $('#news_img').on('change',function(){
            var file_length = document.getElementById('news_img').files.length;
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