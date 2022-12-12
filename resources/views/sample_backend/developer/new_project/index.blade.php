@extends('backend.developer.layouts.app')
@section('title', 'Newproject Management')
@section('newproject-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>New Project Management
                    </div>
                </div>
            </div>

        </div>
        <div class="mb-3 d-flex align-items-end flex-column">
            <div class="d-inline-block dropdown">
                <a href="{{ route('developer.new_project.create') }}"
                    class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Create
                    New Project
                </a>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderd DataTables">
                        <thead>
                            <th>#</th>
                            <th>Region</th>
                            <th>Township</th>
                            <th>Sale Type</th>
                            <th>Price</th>
                            <th>Start Year</th>
                            <th>End Year</th>
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
                ajax: "/developer/new_project/datatables/ssd",
                columns: [
                    {
                        data: 'images',
                        name: 'images',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'region',
                        name: 'region'
                    },
                    {
                        data: 'township',
                        name: 'township'
                    },
                    {
                        data: 'new_project_sale_type',
                        name: 'new_project_sale_type',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'price',
                        name: 'price',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'start_at',
                        name: 'start_at',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'end_at',
                        name: 'end_at',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
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
                            url: '/developer/new_project/' + id,
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