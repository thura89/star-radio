@extends('backend.layouts.app')
@section('title', 'Slider Management')
@section('slider-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Create Slider
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary back-btn"><i class="fas fa-chevron-circle-left"></i> Back</button>
        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    @include('backend.layouts.flash')
                    <form action="{{ route('admin.slider.store') }}" method="POST" id="create"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- Property Type --}}
                        <div class="form-group">
                            <h5>Slider</h5>
                            <hr>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="post_title">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="image">
                                <label for="image">Slider Photo</label>
                                <input type="file" name="images" id="image" class="form-control"/>
                            </div>
                            <div class="preview_image mt-2">
                                
                            </div>
                        </div>
                        {{-- Publish --}}
                        <div class="row">
                            <div class="col-6 col-md-4 form-group">
                                <input name="status" value="1" type="checkbox">
                                <label for="status">Publish This Content</label>
                            </div>
                        </div>
                        {{-- Terms And Condition --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col form-group">
                                    <button class="btn btn-secondary back-btn">Back</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\SliderRequest', '#create') !!}
    @include('backend.property.script')
    <script>
        $(document).ready(function() {
            $('#image').on('change', function() {
                $('.preview_image').html('');
                var f_length = document.getElementById('image').files.length;

                for (let index = 0; index < f_length; index++) {
                    $('.preview_image').append(
                        `<img src="${URL.createObjectURL(event.target.files[index])}">`);
                }
            });
        });
    </script>
@endsection
