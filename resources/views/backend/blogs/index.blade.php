@extends('backend.layouts.master')

@section('title', 'Blogs')
@section('blog-active', 'mm-active')
@section('styles')
<!-- Dropzone -->

<link type="text/css" href="{{ asset('css/vendor-dropzone.css') }}" rel="stylesheet">

@endsection
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">News & Blogs</li>
                </ol>
            </nav>
            <h1 class="m-0">News & Blogs</h1>
        </div>
        <a href="{{ route('admin.blogs.create')}}" class="btn btn-success ml-3">Create <i class="material-icons">add</i></a>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
    <table class="table table-striped table-bordered DataTables" id="getdata" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>image</th>
                <th>body</th>
                <th>updated_at</th>
                <th style="width: 140px;">Action</th>
            </tr>
        </thead>
    </table>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $('#getdata').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('admin.blogs.index') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'image', name: 'image' },
                { data: 'body', name: 'body' },
                { data: 'updated_at', name: 'updated_at' },
                { data: 'action', name: 'action' },
            ]
        });       
    });
</script>
@endsection