@extends('backend.layouts.master')

@section('title', 'Song Request')
@section('song_request-active', 'mm-active')
@section('styles')

@endsection
@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('song_request.song_request')</li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('song_request.song_request') </h1>
            </div>
            {{-- <a href="{{ route('admin.song_requests.create') }}" class="btn btn-primary ml-3">@lang('back_content.create') <i
                    class="material-icons">add</i></a> --}}
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Song Name</th>
                            <th>Artist</th>
                            <th>Message</th>
                            <th>Upated At</th>
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
        $(document).ready(function() {
            var table = $('#getdata').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.song_requests.index') !!}',
                aaSorting: [],
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'songname',
                        name: 'songname'
                    },
                    {
                        data: 'artist',
                        name: 'artist'
                    },
                    {
                        data: 'message',
                        name: 'message'
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
                }, ]
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
                                url: "{{ route('admin.song_requests.removeall') }}",
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
                Swal.fire({
                    title: 'Do you want to delete it?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.song_requests.remove') }}",
                            headers: {
                                'contentType': 'application/json; charset=utf-8',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                                '_token': "{{ csrf_token() }}",
                            },
                            method: "POST",
                            type: 'POST',
                            data: {
                                rid: id,
                                '_token': "{{ csrf_token() }}",
                            },
                            dataType: 'json',
                            success: function(data) {
                                console.log(data);
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
