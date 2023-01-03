@extends('backend.layouts.master')

@section('title', 'Create Program')
@section('program-active', 'mm-active')
@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('program.create')</li>
                    </ol>
                </nav>
                <h1 class="m-0">@lang('program.create')</h1>
            </div>
            <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            <div class="card-form__body card-body">
                <form action="{{ route('admin.programs.store') }}" method="POST" id="create-form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="title">@lang('program.title')</label>
                        <input type="text" name="title" class="form-control" id="title"
                            placeholder="Enter your Title ..">
                    </div>
                    <div class="form-group">
                        <label for="category_id">@lang('program.category')</label><br>
                        <select id="category_id" data-toggle="select" class="form-control custom-select" name="category_id"
                            style="width: auto;">
                            @foreach ($categories as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body">@lang('program.body')</label>
                        <textarea class="form-control" name="body" id="body" cols="20" rows="10"
                            placeholder="Enter your text .."></textarea>
                    </div>
                    <div class="form-group">
                        <label>@lang('program.image')</label>
                        <div class="img_preview mb-1"></div>
                        <input type="file" class="form-control p-1" name="image[]" id="image">
                    </div>
                    {{-- Hidden --}}
                    <input type="hidden" name="audio_file" id="audiofiles">

                    <div id="upload-container" class="text-left">
                        <a id="browseFile" class="btn btn-primary">@lang('program.audio_file')</a>
                    </div>
                    <div class="progress mt-3" style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%; height: 100%">75%</div>
                    </div>
                    <div class="audioholder mt-3">
                        <audio id="audio" controls>
                            <source id="audioPreview" src="" type="audio/mpeg">
                          Your browser does not support the audio element.
                          </audio>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox mt-3">
                            <input name="trending" class="custom-control-input" type="checkbox" value="1"
                                id="invalidCheck01">
                            <label class="custom-control-label" for="invalidCheck01">
                                @lang('program.trending')
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('program.submit')</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\CreateProgram', '#create-form') !!}

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#category_id').select2({
                placeholder: "Choose Category",
                allowClear: true,
                theme: "classic"
            });
            $('#image').on('change', function() {
                var file_length = document.getElementById('image').files.length;
                $('.img_preview').html('');
                for (let i = 0; i < file_length; i++) {
                    $('.img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Avatar" class="avatar-img rounded">
                                            </div>`);
                }

            });

            // $('#files').on('change', function() {
            //     var file_length = document.getElementById('files').files.length;
            //     $('.file_preview').html('');
            //     for (let i = 0; i < file_length; i++) {
            //         $('.file_preview').append(`<div class="">
            //         <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons avatar-img rounded" style="font-size:60px">audiotrack</i>
            //                                 </div>`);
            //     }

            // });


            $('.audioholder').hide();
            $('.progress').hide();
            let browseFile = $('#browseFile');
            let resumable = new Resumable({
                target: '{{ route('admin.audiofiles.upload.large') }}',
                query: {
                    _token: '{{ csrf_token() }}'
                }, // CSRF token
                fileType: ['mp3'],
                chunkSize: 10 * 1024 *
                1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                throttleProgressCallbacks: 1,
            });

            resumable.assignBrowse(browseFile[0]);

            resumable.on('fileAdded', function(file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function(file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
                response = JSON.parse(response)
                $('#audioPreview').attr('src', response.path);
                document.getElementById("audio").load();
                $('#audiofiles').val(response.filename)
                $('.audioholder').show();
            });

            resumable.on('fileError', function(file, response) { // trigger when there is any error
                alert('file uploading error.')
            });


            let progress = $('.progress');

            function showProgress() {
                progress.find('.progress-bar').css('width', '0%');
                progress.find('.progress-bar').html('0%');
                progress.find('.progress-bar').removeClass('bg-success');
                progress.show();
            }

            function updateProgress(value) {
                progress.find('.progress-bar').css('width', `${value}%`)
                progress.find('.progress-bar').html(`${value}%`)
            }

            function hideProgress() {
                progress.hide();
            }
        });
    </script>

@endsection
