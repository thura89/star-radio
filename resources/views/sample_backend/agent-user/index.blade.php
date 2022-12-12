@extends('backend.layouts.app')
@section('title', 'Agent User Management')
@section('agent-user-active', 'mm-active')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Agent User Management
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 d-flex align-items-end flex-column">
        <a class="btn btn-primary" href="{{ route('admin.agent-user.create') }}"> <i class="fas fa-plus-circle"></i>
            Create
            Agent User
        </a>
    </div>
    <div class="card mb-2">
        <div class="card-body">
            <button type="button" class="btn mr-2 mb-2 btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                <i class="pe-7s-filter"></i> Advance Filter</button>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderd DataTables">
                    <thead>
                        <th>#</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Region</th>
                        <th>Agent Type</th>
                        <th>User Agent</th>
                        <th>Login At</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var table = $('.DataTables').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [],
                ajax: {
                    url: "/admin/agent-user/datatables/ssd",
                    type: 'GET',
                    data: function(d) {
                        d.keywords = $('#keywords').val();
                        d.agent_type = $('#agent_type').val();
                        d.region = $('#region').val();
                        d.township = $('#township').val();
                    }
                },
                columns: [
                    {
                        data: 'profile_photo',
                        name: 'profile_photo',
                        sortable: false,
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
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
                        data: 'region',
                        name: 'region',
                        sortable: false,
                    },
                    {
                        data: 'agent_type',
                        name: 'agent_type',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'user_agent',
                        name: 'user_agent',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'login_at',
                        name: 'login_at',
                        sortable: false,
                        searchable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        sortable: false,
                        orderable: false,
                        searchable: false,
                    },

                ]
                // order:[[]]
            });
            $('#btnFiterSubmitSearch').click(function() {
                $('.DataTables').DataTable().draw(true);
            });
            
            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Do you want to delete it?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/agent-user/' + id,
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

            $('#township').html('<option value="">Choose First Region</option>');
            $('#region').on('change', function() {
                
                var region_id = this.value;
                $("#township").html('');
                $.ajax({
                    url: "{{ url('/admin/township') }}",
                    type: "POST",
                    data: {
                        region_id: region_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#township').html('<option value="">Select Township</option>');
                        $.each(result.township, function(key, value) {
                            $("#township").append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });

                    }
                });
            });
        });

    </script>

@endsection
@section('modal')
{{-- Modal Box --}}
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Generel --}}
                <form>
                <div class="form-group">
                    <h5>Generel</h5>
                    <hr>
                    <div class="row">
                        <div class="col form-group">
                            <label for="region">Keywords</label>
                            <input type="text" class="form-control" name="keywords" id="keywords" >
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="agent_type">Agent Type</label>
                            <select name="agent_type" id="agent_type" class="form-control">
                                <option value="">Select</option>
                                @foreach (config('const.agent_type') as $key => $agent)
                                    <option value="{{$key}}">{{$agent}}</option>    
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="region">Region</label>
                            <select name="region" id="region" class="form-control">
                                <option value="">Select Region</option>
                                @foreach ($regions as $key => $region)
                                    <option value="{{ $region->id }}" @if (old('region') == $region->id) selected="selected" @endif>
                                        {{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col pl-0 form-group">
                            <label for="township">Township</label>
                            <select name="township" id="township" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <input type="reset" value="Clear" class="btn btn-secondary">
                <button type="text" id="btnFiterSubmitSearch" class="btn btn-primary" data-dismiss="modal">
                    <i class="pe-7s-filter"></i> Advance Filter</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection