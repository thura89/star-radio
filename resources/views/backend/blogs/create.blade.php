@extends('backend.layouts.master')

@section('title', 'Edit Blogs')
@section('blog-active', 'mm-active')



@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Blog</li>
                </ol>
            </nav>
            <h1 class="m-0">News & Blogs</h1>
        </div>
        <a href="{{ route('admin.blogs.index')}}" class="btn btn-light"> <i class="material-icons">arrow_back</i>Back</a>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.blogs.store') }}" method="POST" id="create-form">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="email" class="form-control" id="title" placeholder="Enter your Blog Title ..">
                </div>
                <div class="form-group">
                    <label for="Body">Enter Textbody</label>
                    <textarea class="form-control" name="body" id="Body" cols="30" rows="10" placeholder="Enter your text .."></textarea>
                </div>
                <div class="form-group">
                    <label>Blog Image</label>
                    <div class="dz-clickable media align-items-center"
                         data-toggle="dropzone"
                         data-dropzone-url="http://"
                         data-dropzone-clickable=".dz-clickable"
                         data-dropzone-files='["{{ asset('flowdesh_theme/images/account-add-photo.svg') }}"]'>
                        <div class="dz-preview dz-file-preview dz-clickable mr-3">
                            <div class="avatar"
                                 style="width: 80px; height: 80px;">
                                <img src="{{ asset('flowdesh_theme/images/account-add-photo.svg') }}"
                                     class="avatar-img rounded"
                                     alt="..."
                                     data-dz-thumbnail>
                            </div>
                        </div>
                        <div class="media-body">
                            <a class="btn btn-sm btn-primary dz-clickable">Choose photo</a>
                        </div>
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
