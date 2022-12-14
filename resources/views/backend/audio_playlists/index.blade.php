@extends('backend.layouts.master')

@section('title', 'Play Audio')
@section('audio-active', 'mm-active')
@section('styles')

@endsection
@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('audio.play_audio')</li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('audio.play_audio') </h1>
            </div>
            <a href="{{ route('admin.audios.create') }}" class="btn btn-primary ml-3">@lang('back_content.create') <i
                    class="material-icons">add</i></a>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            <div class="card-form__body card-body">
                <table class="table table-striped table-bordered DataTables" id="getdata" style="width:100%">
                    <thead>
                        <tr>
                            <th class="no-sort">Image</th>
                            <th>Title</th>
                            <th>Descriptions</th>
                            <th>Audio</th>
                            <th>Live Radio</th>
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
                ajax: '{!! route('admin.audios.index') !!}',
                aaSorting: [],
                columns: [{
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'descriptions',
                        name: 'descriptions',
                        sortable: false,
                    },
                    {
                        data: 'files',
                        name: 'files',
                    },
                    {
                        data: 'live-active',
                        name: 'live-active',
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
                    "targets": 'no-sort',
                    "orderable": false,
                }, ]
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
                            url: '/admin/audios/' + id,
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

            
            $(document).on('click', '.liveradio', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "you want to live this audio, It will be automative change",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: '/admin/audios/live/' + id,
                            type: 'Get',
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                swal("Successfully changed Live", {
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
