@extends('backend.agent.layouts.app')
@section('title', 'want2buyrent Management')
@section('want2buyrent-active', 'mm-active')
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
                <a href="{{ route('agent.want2buyrent.create') }}"
                    class="btn-shadow btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-business-time fa-w-20"></i>
                    </span>
                    Create
                    Want2BuyRent
                </a>
            </div>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderd DataTables">
                        <thead>
                            <th>Title</th>
                            <th>Region</th>
                            <th>Township</th>
                            <th>Budget</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Broker</th>
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
                ajax: "/agent/want2buyrent/datatables/ssd",
                columns: [{
                        data: 'title',
                        name: 'title'
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
                        data: 'budget',
                        name: 'budget',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'properties_type',
                        name: 'properties_type',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'properties_category',
                        name: 'properties_category',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'co_broke',
                        name: 'co_broke',
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
                            url: '/agent/want2buyrent/' + id,
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