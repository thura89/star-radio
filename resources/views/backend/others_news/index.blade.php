@extends('backend.layouts.master')

@section('title', 'News')
@section('news-active', 'mm-active')
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
                    <li class="breadcrumb-item active" aria-current="page">@lang('news.others_news')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('news.others_news') </h1>
        </div>
        <a href="{{ route('admin.other_news.create')}}" class="btn btn-primary ml-3">@lang('back_content.create') <i class="material-icons">add</i></a>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
    <table class="table table-striped table-bordered DataTables" id="getdata" style="width:100%">
        <thead>
            <tr>
                <th class="no-sort">image</th>
                <th>Title</th>
                <th>Category</th>
                <th>body</th>
                <th>updated_at</th>
                <th style="width: 170px;">Action</th>
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
            ajax: '{!! route('admin.other_news.index') !!}',
            aaSorting: [],
            columns: [
                { 
                    data: 'image',
                    name: 'image',
                    sortable: false,

                },
                { 
                    data: 'title',
                    name: 'title' 
                },
                { 
                    data: 'news_category',
                    name: 'news_category',
                    sortable: false,
                },
                { 
                    data: 'body',
                    name: 'body',
                    sortable: false,
                },
                { 
                    data: 'updated_at',
                    name: 'updated_at',
                },
                { 
                    data: 'action',
                    name: 'action',
                    sortable: false,
                    searchable: false,
                },
            ],
            columnDefs:[
                {
                    "targets" : 'no-sort',
                    "orderable" : false,
                },
            ]
        });       

        $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Do you want to delete it?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/news/' + id,
                            type: 'DELETE',
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function() {
                                toastr.success('Successfully deleted');
                                table.ajax.reload();
                            }
                        });
                    }
                })
            });
    });

</script>
@endsection