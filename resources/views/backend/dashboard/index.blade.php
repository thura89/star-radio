@extends('backend.layouts.master')

@section('title', 'Dashboard')
@section('dashboard-active', 'mm-active')
@section('content')

    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-center">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Quick Access</li>
                    </ol>
                </nav>
                <h1 class="m-0">Quick Access</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="row card-group-row">
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-primary">
                                <i class="material-icons text-white icon-18pt">account_circle</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.users.index')}}" class="text-dark">
                            <strong>@lang('sidebar.users') - ({{$user}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center">
                                <i class="material-icons text-white icon-18pt">receipt</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.news.index') }}" class="text-dark">
                            <strong>@lang('sidebar.news') - ({{$news}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-success">
                                <i class="material-icons text-white icon-18pt">receipt</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.other_news.index')}}" class="text-dark">
                            <strong>@lang('sidebar.other_news') - ({{$other_news}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-info">
                                <i class="material-icons text-white icon-18pt">event_available</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.events.index')}}" class="text-dark">
                            <strong>@lang('sidebar.events') - ({{$event}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-blue">
                                <i class="material-icons text-white icon-18pt">library_books</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.nobles.index')}}" class="text-dark">
                            <strong>@lang('sidebar.noble') - ({{$noble}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-warning">
                                <i class="material-icons text-white icon-18pt">account_balance</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.programs.index')}}" class="text-dark">
                            <strong>@lang('sidebar.program') - ({{$program}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-primary">
                                <i class="material-icons text-white icon-18pt">book</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.ads.index')}}" class="text-dark">
                            <strong>@lang('sidebar.ads') - ({{$ads}})</strong>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="p-2 d-flex flex-row align-items-center">
                        <div class="avatar avatar-xs mr-2">
                            <span class="avatar-title rounded-circle text-center bg-danger">
                                <i class="material-icons text-white icon-18pt">burst_mode</i>
                            </span>
                        </div>
                        <a href="{{ route('admin.sliders.index')}}" class="text-dark">
                            <strong>@lang('sidebar.slider') - ({{$slider}})</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header card-header-large bg-white">
                        <h4 class="card-header__title"><i
                            class="material-icons icon-20pt mr-1">audiotrack</i> @lang('sidebar.song_request')</h4>
                    </div>

                    <table class="table table-striped border-bottom mb-0">
                        @foreach ($song_requests->take(5) as $index => $song_request )
                            <tr>
                                <td style="width: 40px;">{{$index+1}}.</td>
                                <td>
                                    <div>
                                        <a href="{{ route('admin.song_requests.show',$song_request->id)}}" class="text-15pt d-flex align-items-center"><i
                                                class="material-icons icon-16pt mr-1">audiotrack</i>
                                            <strong>{{ $song_request->name}}</strong></a>
                                    </div>
                                    <small class="text-muted">({{ $song_request->songname}})</small>
                                </td>
                                <td>

                                </td>
                                <td class="" style="width: 300px">
                                    <i class="material-icons icon-16pt text-success">question_answer</i> {{ Str::limit($song_request->message, 100, '...')}} 
                                </td>
                                <td class="text-right" style="width: 60px">
                                    <div class="badge badge-soft-success">{{ $song_request->email }}</div>
                                </td>
                                <td class="text-right" style="width: 200px">
                                    {{ $song_request->updated_at->diffForHumans() }}
                                </td>
                            </tr>
                        @endforeach

                    </table>

                    <div class="card-footer text-center border-0">
                        <a class="text-muted" href="{{ route('admin.song_requests.index') }}">View All ({{ count($song_requests)}})</a>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection
