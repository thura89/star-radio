@extends('backend.layouts.master')

@section('title', 'Change Password')
@section('user-active', 'mm-active')

@section('content')
<div class="container-fluid page__heading-container">
    <div class="page__heading d-flex align-items-center">
        <div class="flex">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('user.change_pass')</li>
                </ol>
            </nav>
            <h1 class="m-0">@lang('user.change_pass')</h1>
        </div>
        <button class="btn btn-light back-btn"> <i class="material-icons">arrow_back</i>@lang('back_content.back')</button>
    </div>
</div>

<div class="container-fluid page__container">    
    <div class="card">
        <div class="card-form__body card-body">
            <form action="{{ route('admin.postChangePassword') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST')
                
                <div class="card card-form">
                    <div class="row no-gutters">
                        <div class="col-lg-4 card-body">
                            <p><strong class="headings-color">@lang('change_password.update_your_password')</strong></p>
                            <p class="text-muted">@lang('change_password.change_your_password')</p>
                            @if(Session::get('error_password') && Session::get('error_password') != null)
                            <div style="color:red">{{ Session::get('error_password') }}</div>
                            @php
                            Session::put('error_password', null)
                            @endphp
                            @endif
                            @if(Session::get('success_password') && Session::get('success_password') != null)
                            <div style="color:green">{{ Session::get('success_password') }}</div>
                            @php
                            Session::put('success_password', null)
                            @endphp
                            @endif
                        </div>
                        <div class="col-lg-8 card-form__body card-body">
                            <div class="form-group">
                                <label for="opass">@lang('change_password.old_password')</label>
                                <input name="old_password" style="width: 270px;" id="opass" type="password" class="form-control" placeholder="Old Password">
                            </div>
                            <div class="form-group">
                                <label for="npass">@lang('change_password.new_password')</label>
                                <input name="new_password" style="width: 270px;" id="npass" type="password" class="form-control" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="cpass">@lang('change_password.confirm_password')</label>
                                <input name="new_password_confirmation" style="width: 270px;" id="cpass" type="password" class="form-control" placeholder="Confirm password">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary inline-block">@lang('change_password.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\ChangePassword', '#create-form') !!}


@endsection