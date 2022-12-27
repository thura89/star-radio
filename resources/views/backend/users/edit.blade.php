@extends('backend.layouts.master')

@if (!request()->route()->named('admin.users.show'))
    @section('title', 'Show User')    
@else
    @section('title', 'Edit User')    
@endif


@section('user-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if (request()->route()->named('admin.users.show'))
                            @lang('user.show')   
                        @else
                            @lang('user.edit')   
                        @endif
                    </li>
                </ol>
            </nav>
            <h1 class="m-0">
                {{ $user->name }}
            </h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            @if (request()->route()->named('admin.users.edit'))
            {{-- <div class="flex"></div> --}}
                <form action="{{ route('admin.users.update',$user->id) }}" method="POST" id="update-form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
            @endif
                <div class="row">
                    <div class="form-group col">
                        <label for="name">@lang('user.name')</label>
                        <input value="{{ $user->name }}" type="text" name="name" class="form-control" id="name" placeholder="Enter your Name ..">
                    </div>
                    <div class="form-group col">
                        <label for="email">@lang('user.email')</label>
                        <input value="{{ $user->email }}" type="email" name="email" class="form-control" id="email" placeholder="Enter your email ..">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <label for="phone">@lang('user.phone')</label>
                        <input value="{{ $user->phone }}" type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone ..">
                    </div>
                    <div class="form-group col">
                        <label for="user_type">@lang('user.user_type')</label><br>
                        <select id="user_type" class="custom-select" name="user_type" style="width: auto;">
                                <option value="">Select</option>
                                
                            @foreach (config('const.user_type') as $key => $type)
                                <option value="{{ $key }}" @if($key == $user->user_type ) selected @endif>{{ $type }}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col">
                        <label for="description">@lang('user.description')</label>
                        <textarea class="form-control" name="description" id="description" placeholder="Enter your description ..">{{ $user->description }}</textarea>
                    </div>
                    <div class="form-group col">
                        <label for="address">@lang('user.address')</label>
                        <textarea class="form-control" name="address" id="address" placeholder="Enter your address ..">{{ $user->address }}</textarea>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col">
                        <label>@lang('user.profile_photo')</label>
                        <div class="profile_img_preview mb-2">
                            @if ($user->profile_photo)
                                <div class="avatar avatar-xxl">
                                    <img src="{{ $user->profile_img_path() }}" alt="Avatar" class="avatar-img rounded-circle">
                                </div>
                            @endif
                        </div>
                        <input type="file" class="form-control p-1" name="profile_photo[]" id="profile_photo">
                    </div>
                    <div class="form-group col">
                        <label>@lang('user.cover_photo')</label>
                        <div class="cover_img_preview mb-2">
                            @if ($user->cover_photo)
                                <div class="avatar avatar-xxl">
                                    <img src="{{ $user->cover_img_path() }}" alt="Avatar" class="avatar-img rounded">
                                </div>
                            @endif
                        </div>
                        <input type="file" class="form-control p-1" name="cover_photo[]" id="cover_photo">
                    </div>
                </div>
                
                @if (request()->route()->named('admin.users.edit'))
                    @if(Auth::user()->user_type == config('const.administrator'))
                        <div class="form-group">
                            <a href="#" class="btn btn-light reset" data-id="{{ $user->id }}"><i class="material-icons">build</i>Reset Password</a>  <span>DefaultPassword - starfm@changeme</span>  
                        </div>
                    @endif
                @endif
                @if (request()->route()->named('admin.users.edit'))
                    <button type="submit" class="btn btn-primary">@lang('user.submit')</button>    
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{!! JsValidator::formRequest('App\Http\Requests\UpdateUser', '#update-form') !!}

<script type="text/javascript">
    $(document).ready(function(){
        $('#profile_photo').on('change',function(){
            var file_length = document.getElementById('profile_photo').files.length;
            $('.profile_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.profile_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Image" class="avatar-img rounded-circle">
                                            </div>`);
            }

        });
        $('#cover_photo').on('change',function(){
            var file_length = document.getElementById('cover_photo').files.length;
            $('.cover_img_preview').html('');
            for (let i = 0; i < file_length; i++) {
                $('.cover_img_preview').append(`<div class="avatar avatar-xxl avatar-4by3">
                                                <img src="${URL.createObjectURL(event.target.files[i])}" alt="Image" class="avatar-img rounded">
                                            </div>`);
            }

        });

        @if(Auth::user()->user_type == config('const.administrator'))
            $('.reset').on('click',function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    console.log(id);
                    swal({
                        title: "Are you sure?",
                        text: "Once reset, you will not be able to recover this account!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((result) => {
                        if (result) {
                            console.log('/admin/users/' + id +'/reset');
                            $.ajax({
                                url: '/admin/users/' + id +'/reset',
                                type: 'GET',
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                },
                                success: function(data) {
                                    swal("Poof! Your account has been reseted!", {
                                        icon: "success",
                                    });
                                }
                            }); 
                        } else {
                            swal("Your account is safe! No change");
                        }
                    });
                });
        @endif
    });
    
        
</script>

@endsection