@extends('backend.layouts.master')

@if (!request()->route()->named('admin.nobles.show'))
    @section('title', 'Show Noble')    
@else
    @section('title', 'Edit Noble')    
@endif


@section('noble-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('noble.edit_noble')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('noble.edit_noble')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            @if (request()->route()->named('admin.nobles.edit'))
                <form action="{{ route('admin.nobles.update',$noble->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">@lang('noble.noble_title')</label>
                    <input value="{{ $noble->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Noble Title ..">
                </div>
                <div class="form-group">
                    <label for="noble_category">@lang('noble.noble_type')</label><br>
                    <select id="noble_category" class="custom-select" name="noble_category" style="width: auto;">
                        @foreach (config('const.noble_category') as $key => $noble_cate)
                            <option value="{{ $key }}" @if ($key == $noble->noble_category ) selected @endif>{{ $noble_cate }}</option>    
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="Body">@lang('noble.body')</label>
                    <textarea class="form-control" name="body" id="Body" cols="30" rows="10" placeholder="Enter your text ..">{{ $noble->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>@lang('noble.image')</label>
                    <div class="img_preview mb-1">
                        @if ($noble->image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $noble->nobles_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                <div class="form-group">
                    <label>@lang('noble.download_file')</label>
                    <div class="file_preview mb-2">
                        @if ($noble->download_file)
                            <div class="">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons avatar-img rounded" style="font-size:50px">library_books</i>
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="download_file[]" id="download_file">
                </div>

                
                @if (request()->route()->named('admin.nobles.edit'))
                    <button type="submit" class="btn btn-primary">@lang('noble.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateNoble', '#update-form') !!}

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
        $('#download_file').on('change',function(){
            var file_length = document.getElementById('download_file').files.length;
            $('.file_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.file_preview').append(`<div class="">
                    <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons avatar-img rounded" style="font-size:60px">library_books</i>
                                            </div>`);
            }

        });
    });
</script>

@endsection