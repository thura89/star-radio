@extends('backend.layouts.master')

@section('title', 'Users')
@section('user-active', 'mm-active')
@section('styles')

@endsection
@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('user.user')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('user.user') </h1>
        </div>
        <a href="{{ route('admin.users.create')}}" class="btn btn-primary ml-3">@lang('back_content.create') <i class="material-icons">add</i></a>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
    <table class="table table-striped table-bordered DataTables" id="getdata" style="width:100%">
        <thead>
            <tr>
                <th class="no-sort">image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>User Type</th>
                <th>Login At</th>
                <th>User Agent</th>
                <th>Updated At</th>
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
            ajax: '{!! route('admin.users.index') !!}',
            aaSorting: [],
            columns: [
                { 
                    data: 'profile_photo',
                    name: 'profile_photo',
                    sortable: false,
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
                    data: 'phone',
                    name: 'phone' 
                },
                { 
                    data: 'user_type',
                    name: 'user_type' 
                },
                { 
                    data: 'login_at',
                    name: 'login_at' 
                },
                { 
                    data: 'user_agent',
                    name: 'user_agent' 
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
            swal({
                title: "Are you sure?",
                text: "Once Delete, you will not be able to recover this account!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: '/admin/users/' + id,
                        type: 'DELETE',
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            swal("Poof! Your account has been Deleted!", {
                                icon: "success",
                            }).then(() => {
                                location.reload();
                            });
                        }
                    }); 
                } else {
                    swal("Your account is safe!");
                }
            });
        });
    });

</script>
@endsection