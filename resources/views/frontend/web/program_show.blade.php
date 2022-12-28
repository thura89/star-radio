@extends('frontend.layouts.master')
@section('title', 'programs show')
@section('programs-active', 'active')
@section('content')
   


    <!--=================================
                Search and navigator
                =================================-->
    <header class="style ">
        <div class="container mt-5">
            <div class="row mt-5">
                <div class="col-xs-12 col-sm-6 col-md-5">
                    <h2 class="text-uppercase">{{ $program->category->title }}</h2>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="blogNavigator clearfix">
                    <a class="btn btn-default btnBackto" href="#"><i class="fa fa-chevron-circle-left"></i> @lang('front_index.back') </a>
                </div>
                <!--blogNavigator-->
            </div>
            <!--column-->
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
                            <h2 class="text-semibold">{{ $program->title }}</h2>
                            <span class="timeStamp"><i class="fa fa-clock-o"></i>
                                {{ Carbon\Carbon::parse($program->updated_at)->format('M d') }}</span>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                        <article>
                            <div id="post-jplayer-wrap-1" class="post-audio-player">

                                <div id="player-instanc-1" class="jp-jplayer post-jplayer"
                                    data-title="{{ $program->title }}"
                                    data-mp3="{{ $program->program_audio_path() }}">
                                </div>
                                <h5 class="audio-title jp-title">&empty;</h5>
                                <span class="jp-duration"></span>
                                <div class="controls jp-controls-holder">
                                    <div class="play-pause jp-play pc-play"></div>
                                    <div class="play-pause jp-pause pc-pause" style=" display:none"></div>
                                </div>
                                <div class="jp-volume-controls">
                                    <button class="sound-trigger icon-music_volume_up"></button>
                                    <div class="jp-volume-bar" style="display: block;">
                                        <div class="jp-volume-bar-value" style="width: 1.4737%;"></div>
                                    </div>
                                </div>

                                <div class="player-status">
                                    <div class="audio-progress">
                                        <div class="jp-seek-bar">
                                            <div class="audio-play-bar jp-play-bar" style="width:20%;">
                                                <div class="jpcTimeWrap">
                                                    <span class="jp-current-time"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--jp-seek-bar-->
                                    </div>
                                    <!--audio-progress-->
                                </div>

                            </div>
                        </article>
                        <figure>
                            <img src="{{ $program->program_img_path() }}" alt="" width="509" height="252" />
                        </figure>

                        <p>{{ $program->body }} </p>

                        <!--tags-->
                    </div>
                    <!--column-->
                </div>
                <!--row-->
            </article>
        </div>
        <!--container-->
    </div>

@endsection
