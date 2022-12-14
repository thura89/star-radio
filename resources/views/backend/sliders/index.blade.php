@extends('backend.layouts.master')

@section('title', 'Slider')
@section('slider-active', 'mm-active')
@section('styles')

@endsection
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('slider.slider')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('slider.slider') </h1>
        </div>
        <a href="{{ route('admin.sliders.create')}}" class="btn btn-primary ml-3">@lang('back_content.create') <i class="material-icons">add</i></a>
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
                <th>Description</th>
                <th>Status</th>
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
            ajax: '{!! route('admin.sliders.index') !!}',
            aaSorting: [],
            columns: [
                { 
                    data: 'front_image',
                    name: 'front_image',
                    sortable: false,
                },
                { 
                    data: 'title',
                    name: 'title' 
                },
                { 
                    data: 'description',
                    name: 'description',
                    sortable: false,
                },
                { 
                    data: 'status',
                    name: 'status',
                    sortable: false,
                },
                { 
                    data: 'updated_at',
                    name: 'updated_at',
                    sortable: false,
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
                            url: '/admin/sliders/' + id,
                            type: 'DELETE',
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function(data) {
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