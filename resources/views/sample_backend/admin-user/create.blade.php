@extends('backend.layouts.app')
@section('title', 'Create Admin User')
@section('admin-user-active', 'mm-active')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Create Admin User
                    <div class="page-title-subheading">This is an example dashboard created using build-in elements and
                        components.
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                @include('backend.layouts.flash')
                <form action="{{ route('admin.admin-user.store')}}" method="POST" id="create" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="col-md-6 col form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col form-group">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6 col form-group">
                            <label for="user_type">Role Level</label>
                            <select name="user_type" class="form-control">
                                <option value="">Select</option>
                                @foreach (config('const.role_level') as $key => $role)
                                    <option value="{{$key}}">{{$role}}</option>    
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
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea name="address" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="profile_photo">
                            <label for="profile_photo">Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo" class="form-control"/>
                        </div>
                        <div class="preview_profile_photo mt-2">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="cover_photo">
                            <label for="cover_photo">Cover Photo</label>
                            <input type="file" name="cover_photo" id="cover_photo" class="form-control"/>
                        </div>
                        <div class="preview_cover_photo mt-2">
                            
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
{!! JsValidator::formRequest('App\Http\Requests\CreateAdminUserRequest','#create') !!}
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
