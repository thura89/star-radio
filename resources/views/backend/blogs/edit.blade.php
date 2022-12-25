@extends('backend.layouts.master')

@if (!request()->route()->named('admin.contact'))
    @section('contact-active', 'mm-active')
    @section('title', 'Edit Contact')    
@endif

@if (!request()->route()->named('admin.about'))
    @section('title', 'Edit about')    
    @section('about-active', 'mm-active')
@endif

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @lang('blog.edit')
                        
                    </li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('blog.edit')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
                <form action="{{ route('admin.blog.store',$data->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                <div class="form-group">
                    <label for="title">@lang('blog.title')</label>
                    <input value="{{ $data->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Noble Title ..">
                </div>
                <div class="form-group">
                    <label for="Body">@lang('blog.body')</label>
                    <textarea class="ckeditor form-control" name="body" id="Body" cols="30" rows="10" placeholder="Enter your text ..">{!! $data->body !!}</textarea>
                </div>
              
                <button type="submit" class="btn btn-primary">@lang('blog.submit')</button>    
                
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
