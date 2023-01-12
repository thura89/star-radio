@extends('backend.layouts.master')

@section('title', 'Program')
@section('program-active', 'mm-active')
@section('styles')

@endsection
@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('program.program')</li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('program.program') </h1>
            </div>
            <a href="{{ route('admin.programs.create') }}" class="btn btn-primary ml-3">@lang('back_content.create') <i
                    class="material-icons">add</i></a>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            <div class="card-form__body card-body">
                <table class="table table-striped table-bordered DataTables" id="getdata" style="width:100%">
                    <thead>
                        <tr>
                            <th><button type="button" name="bulk_delete" id="bulk_delete"
                                class="btn btn-sm btn-danger btn-rounded"><i
                                    class="material-icons icon-20pt">delete_sweep</i></button></th>
                            <th class="no-sort">Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Body</th>
                            <th>Audio</th>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function pauseOthers(el) {
            $("audio").not(el).each(function(index, audio) {
                audio.pause();
            });
        }
        $(document).ready(function() {
            var table = $('#getdata').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.programs.index') !!}',
                aaSorting: [],
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'body',
                        name: 'body',
                        sortable: false,
                    },
                    {
                        data: 'files',
                        name: 'files'
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
                columnDefs: [{
                    orderable: false,
                    className: 'text-center',
                    targets: 0,
                }]
            });

            $(document).on('click', '#bulk_delete', function() {
                var id = [];

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    customClass: 'sssss'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $('.users_checkbox:checked').each(function() {
                            id.push($(this).val());
                        });
                        if (id.length > 0) {
                            $.ajax({
                                url: "{{ route('admin.programs.removeall') }}",
                                headers: {
                                    'contentType': 'application/json; charset=utf-8',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content'),
                                    '_token': "{{ csrf_token() }}",
                                },
                                method: "POST",
                                type: 'POST',
                                data: {
                                    id: id,
                                    '_token': "{{ csrf_token() }}",
                                },
                                dataType: 'json',
                                success: function(data) {
                                    console.log(data);
                                    toastr.success('Successfully deleted');
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                    table.ajax.reload();
                                },
                                error: function(data) {
                                    var errors = data.responseJSON;
                                    console.log(errors);
                                    toastr.warning(errors);
                                }
                            });
                        } else {
                            Swal.fire(
                                'Sorry!',
                                'Please select atleast one checkbox!',
                                'warning'
                            )
                        }
                    }
                })


            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "Once Delete, you will not be able to recover this content!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: '/admin/programs/' + id,
                            type: 'DELETE',
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                swal("Poof! It has been Deleted!", {
                                    icon: "success",
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        swal("Your content is safe!");
                    }
                });
            });


        });
    </script>
@endsection
