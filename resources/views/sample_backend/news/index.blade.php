@extends('backend.layouts.app')
@section('title', 'News Management')
@section('news-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Want2 Buy & Rent Management
                    </div>
                </div>
            </div>

        </div>
        <div class="mb-3 d-flex align-items-end flex-column">
            <div class="d-inline-block dropdown">
                <a href="{{ route('admin.news.create') }}"
                    class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Create
                    News
                </a>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderd DataTables">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>category</th>
                            <th>Description</th>
                            <th>PostBy</th>
                            <th>Created At</th>
                            <th class="no-sort">Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('.DataTables').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [],
                ajax: "/admin/news/datatables/ssd",
                columns: [
                    {
                        data: 'images',
                        name: 'images',
                        sortable: false,
                        searchable: false,

                    },
                    {
                        data: 'post_title',
                        name: 'post_title',
                        sortable: false,
                    },
                    {
                        data: 'category',
                        name: 'category',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'post_letter',
                        name: 'post_letter',
                        sortable: false,
                    },
                    {
                        data: 'post_by',
                        name: 'post_by',
                        sortable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sortable: false,
                        searchable: false,
                    },

                ],
                columnDefs: [{
                    target: 'no-sort',
                    sortable: false,
                }],
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
                                table.ajax.reload();
                            }
                        });
                    }
                })
            });
        });
    </script>

@endsection