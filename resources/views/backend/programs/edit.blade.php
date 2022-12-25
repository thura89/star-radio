@extends('backend.layouts.master')

@if (!request()->route()->named('admin.programs.show'))
    @section('title', 'Show Program')    
@else
    @section('title', 'Edit Program')    
@endif

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('program-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (request()->route()->named('admin.programs.show'))
                            @lang('program.show')   
                        @else
                            @lang('program.edit')   
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
            @if (request()->route()->named('admin.programs.edit'))
                <form action="{{ route('admin.programs.update',$data->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">@lang('program.title')</label>
                    <input value="{{ $data->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Noble Title ..">
                </div>
                <div class="form-group">
                    <label for="category_id">@lang('program.category')</label><br>
                    <select id="category_id"
                            data-toggle="select"
                            class="form-control custom-select" 
                            name="category_id" 
                            style="width: auto;">
                            @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}" @if ($category->id == $data->id) selected @endif>{{ $category->title }}</option>    
                            @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="body">@lang('program.body')</label>
                    <textarea class="form-control" name="body" id="body" cols="30" rows="10" placeholder="Enter your text ..">{{ $data->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>@lang('program.image')</label>
                    <div class="img_preview mb-1">
                        @if ($data->image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $data->program_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                <div class="form-group">
                    <label>@lang('program.audio_file')</label>
                    <div class="file_preview mb-1">
                        <audio controls onplay="pauseOthers(this)">
                            <source src="{{$data->program_audio_path()}}" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                    <input type="file" class="form-control p-1" name="files[]" id="files">
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input name="trending" class="custom-control-input" type="checkbox" required="" @if($data->trending == 1) checked="checked" @endif  value="1" id="invalidCheck01" >
                        <label class="custom-control-label" for="invalidCheck01">
                            @lang('program.trending')
                        </label>
                    </div>
                </div>
                @if (request()->route()->named('admin.programs.edit'))
                    <button type="submit" class="btn btn-primary">@lang('program.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateProgram', '#update-form') !!}
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $('#category_id').select2({
                placeholder: "Choose Category",
                allowClear: true,
                theme: "classic"
        });

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