@extends('backend.layouts.app')
@section('title', 'Edit Developer User')
@section('developer-user-active', 'mm-active')
@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-users icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Edit Developer User
                    </div>
                </div>
            </div>

        </div>
        <div class="content">
            <div class="card">
                <div class="card-body">
                    @include('backend.layouts.flash')
                    <form action="{{ route('admin.developer-user.update', $developerUser->id) }}" method="POST" id="update" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ $developerUser->company_name }}">
                            </div>
                            <div class="col-md-6 col form-group">
                                <label for="name">Name</label>
                                <input type="name" name="name" class="form-control" value="{{ $developerUser->name }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $developerUser->email }}">
                            </div>
                            <div class="col-md-6 col form-group">
                                <label for="phone">Phone</label>
                                <input type="number" name="phone" class="form-control" value="{{ $developerUser->phone }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" class="form-control" cols="30" rows="10">{{ $developerUser->address}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $developerUser->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="profile_photo">
                                <label for="profile_photo">Profile Photo</label>
                                <input type="file" name="profile_photo" id="profile_photo" class="form-control"/>
                            </div>
                            <div class="preview_profile_photo mt-2">
                                @if ($developerUser->profile_photo)
                                        <img src="{{ $developerUser->profile_photo}}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="cover_photo">
                                <label for="cover_photo">Cover Photo</label>
                                <input type="file" name="cover_photo" id="cover_photo" class="form-control"/>
                            </div>
                            <div class="preview_cover_photo mt-2">
                                @if ($developerUser->cover_photo)
                                        <img src="{{ $developerUser->cover_photo}}" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary back-btn">Back</button>
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateDeveloperUserRequest', '#update') !!}
    <script>
        $(document).ready(function() {
            $('#cover_photo').on('change', function() {
                $('.preview_cover_photo').html('');
                var f_length = document.getElementById('cover_photo').files.length;
    
                for (let index = 0; index < f_length; index++) {
                    $('.preview_cover_photo').append(
                        `<img src="${URL.createObjectURL(event.target.files[index])}">`);
                }
            });
            $('#profile_photo').on('change', function() {
                $('.preview_profile_photo').html('');
                var f_length = document.getElementById('profile_photo').files.length;
    
                for (let index = 0; index < f_length; index++) {
                    $('.preview_profile_photo').append(
                        `<img src="${URL.createObjectURL(event.target.files[index])}">`);
                }
            });
        });
    </script>

@endsection
