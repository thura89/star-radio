@extends('frontend.layouts.master')
@section('title', 'news')
@section('news-active', 'active')
@section('content')
        <!--=================================
        Search and navigator
        =================================-->  
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="blogNavigator clearfix">
                        <a class="btn btn-default btnBackto" href="#"><i class="fa fa-chevron-circle-left"></i> @lang('front_index.back')</a>
                    </div><!--blogNavigator-->
                </div><!--column-->
            </div>
        </div>
        <!--=================================
        Blog Section
        =================================-->
        <div>
            <div class="container">
                <article class="articleSingle">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="about-article text-center text-uppercase">
                                <h2 class="text-semibold">{{ $data->title}}</h2>
                                <span class="timeStamp"><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($data->updated_at)->format('d M')}}</span>
                            </div>
                         </div>
                         <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">   
                            <figure>
                                <img src="{{ $data->news_img_path() }}" alt=""/>
                            </figure>

                            <p>{{ $data->body }}</p>
                            <div class="text-center">
                                <span class="timeStamp"><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($data->updated_at)->format('d M')}}</span>
                            </div>
                        </div><!--column-->
                    </div><!--row-->
                </article>
            </div><!--container-->
        </div>

@endsection
