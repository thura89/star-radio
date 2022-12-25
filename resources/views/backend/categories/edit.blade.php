@extends('backend.layouts.master')

@if (!request()->route()->named('admin.categories.show'))
    @section('title', 'Show Category')    
@else
    @section('title', 'Edit Category')    
@endif


@section('category-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (request()->route()->named('admin.categories.show'))
                            @lang('category.show')   
                        @else
                            @lang('category.edit')   
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
            @if (request()->route()->named('admin.categories.edit'))
                <form action="{{ route('admin.categories.update',$data->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">@lang('category.title')</label>
                    <input value="{{ $data->title }}" type="title" name="title" class="form-control" id="title" placeholder="Enter your Noble Title ..">
                </div>
                <div class="form-group">
                    <label for="descriptions">@lang('category.description')</label>
                    <textarea class="form-control" name="descriptions" id="descriptions" cols="30" rows="10" placeholder="Enter your text ..">{{ $data->descriptions }}</textarea>
                </div>
                <div class="form-group">
                    <label>@lang('program.image')</label>
                    <div class="img_preview mb-1">
                        @if ($data->image)
                            <div class="avatar avatar-xxl avatar-4by3">
                                <img src="{{ $data->category_img_path() }}" alt="" class="avatar-img rounded">    
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control p-1" name="image[]" id="image">
                </div>
                @if (request()->route()->named('admin.categories.edit'))
                    <button type="submit" class="btn btn-primary">@lang('category.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! JsValidator::formRequest('App\Http\Requests\UpdateCategory', '#update-form') !!}

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