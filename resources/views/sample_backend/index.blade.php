@extends('backend.layouts.app')
@section('title', 'Analytic Dashboard')
@section('dashboard-active', 'mm-active')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-wallet icon-gradient bg-plum-plate">
                    </i>
                </div>
                <div>Dashboard Boxes
                    <div class="page-title-subheading">Highly configurable boxes best used for showing numbers in an user friendly way.
                    </div>
                </div>
            </div>
        </div>
    </div>            
    <div class="">
        <div class="row">
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-night-fade">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Properties</div>
                            <div class="widget-subheading">Total Last Update Count</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ count($properties)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">New Project</div>
                            <div class="widget-subheading">Total New Project count</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span>{{ count($newprojects) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-3 widget-content bg-premium-dark">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Want To Buy & Rent</div>
                            <div class="widget-subheading">Total Want To Buy & Rent Count</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-warning"><span>{{ count($WantToBuyRents)}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="divider mt-0" style="margin-bottom: 30px;"></div>
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-danger">{{ count($users->whereIn('user_type',[1,2,3])) }}</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="{{count($users->whereIn('user_type',[1,2,3]))}}" aria-valuemin="0" aria-valuemax="100" style="width: {{ count($users->whereIn('user_type',[1,2,3])) }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Admin User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-success mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-success">{{ count($users->where('user_type',config('const.Agent'))) }}</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ count($users->where('user_type',config('const.Agent'))) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ count($users->where('user_type',config('const.Agent'))) }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Agent User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-warning mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-warning">{{ count($users->where('user_type',config('const.Developer'))) }}</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{ count($users->where('user_type',config('const.Developer'))) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ count($users->where('user_type',config('const.Developer'))) }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Develper User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-shadow-info mb-3 widget-chart widget-chart2 text-left card">
                    <div class="widget-content">
                        <div class="widget-content-outer">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left pr-2 fsize-1">
                                    <div class="widget-numbers mt-0 fsize-3 text-info">{{ count($users->where('user_type',config('const.User'))) }}</div>
                                </div>
                                <div class="widget-content-right w-100">
                                    <div class="progress-bar-xs progress">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="{{ count($users->where('user_type',config('const.User'))) }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ count($users->where('user_type',config('const.User'))) }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left fsize-1">
                                <div class="text-muted opacity-6">Normal User</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider mt-0" style="margin-bottom: 30px;"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    <div class="card-header">Total News Counts - {{ count($news)}}
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <a href="{{ route('admin.news.index') }}" class="active btn btn-focus">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">View</th>
                                    <th class="text-left">Title</th>
                                    <th class="text-center">PostBy</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $new)
                                <tr>
                                    <td class="text-center text-muted">{{ $new->view_count ?? '0' }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="100" class="img-thumbnail" src="{{  asset(config('const.news_img_path')) . '/' . $new->images  }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{$new->post_title ?? '-' }}</div>
                                                    <div class="widget-subheading opacity-7">{{ Str::words($new->post_letter,'4','...') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" src="{{  $new->user->profile_photo }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{$new->user->name ?? '-' }}</div>
                                                    <div class="widget-subheading opacity-7">{{ $new->user->user_type ? config('const.role_level')[$new->user->user_type] : '-' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="badge badge-success">{{ config('const.news_category')[$new->category] }}</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.news.edit', $new->id) }}" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            
                </div>
            </div>
            <div class="col-md-4">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        Total Slider Counts - {{ count($sliders)}}
                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <a href="{{ route('admin.slider.index')}}" class="active btn btn-focus">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($sliders->take(6) as $slider)
                                <li class="list-group-item">
                                    <div class="widget-content p-0">
                                        <div class="widget-content-outer">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">{{ Str::ucfirst($slider->title)}}</div>
                                                    <div class="widget-subheading">
                                                        @if ($slider->status == 1)
                                                            <span class="badge badge-pill badge-success">
                                                                {{ config('const.slider_status')[$slider->status]}}
                                                            </span>    
                                                       @else
                                                            <span class="badge badge-pill badge-danger">
                                                                {{ config('const.slider_status')[$slider->status]}}
                                                            </span>    
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="widget-numbers text-warning">
                                                        <img width="100" class="img-thumbnail" src="{{  asset(config('const.sliders_img_path')) . '/' . $slider->images }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
            </div>
        </div>

        

        
        
    </div>
</div>
@endsection