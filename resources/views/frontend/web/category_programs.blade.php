@extends('frontend.layouts.master')
@section('title', 'news')
@section('programs-active', 'active')
@section('content')
<!--=================================
    Albums
    =================================-->

    <section class="album-header">
        <figure class="album-cover-wrap">
            <div class="album-cover_overlay"></div>
            <img class="album-cover" src="{{ asset('starfm/assets/images/demo-cover.jpg') }}" alt="" data-stellar-ratio="0.5">
        </figure>
        <div class="container">
            <div class="cover-content">
                <a href="{{ route('home.programs')}}" class="btn btn-default text-bold btn-lg text-uppercase backStore"><i class="icon-angle-circled-left"></i> @lang('front_index.back_to_program')</a>
                <hr>
                <div class="clearfix text-uppercase album_overview">
                    <figure class="album-thumb">
                        <img src="{{ $category->category_img_path() }}" alt="">
                    </figure>
                    <h1>{{ $category->title }} <span class="price-tag pull-right">{{ count($category->programs)}} - @lang('front_index.items')</span></h1>
                    <cite class="album-author mb-20">{{ $category->descriptions }}</cite>
                    <a class="btn btn-transparent-2 btn-tag" href="{{ route('home.songRequest') }}">@lang('front_index.request')</a>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-100 mb-50">

        <div class="container">
            <ul class="song-list text-uppercase text-bold clearfix">
                
                @foreach ($category_programs as $key => $program)
                <li id="singleSongPlayer-{{ $key+1 }}" class="song-unit singleSongPlayer clearfix" data-before="{{ $key+1 }}">

                    <div id="singleSong-jplayer-{{ $key+4 }}" class="singleSong-jplayer" data-title="{{ Str::limit($program->title, 20,'...') }}" data-mp3="{{ $program->program_audio_path() }}">
                    </div>

                    <figure><img src="{{ $program->program_img_path()}}" alt="" width="265" height="265"/></figure>

                    <span class="playit controls jp-controls-holder">
                        <i class="jp-play pc-play"></i> 
                        <i class="jp-pause pc-pause"></i>
                    </span>
                    <span class="song-title jp-title" data-before="title"></span>
                    <span class="song-author" data-before="Description">{{ Str::limit($program->body, 15,'...') }}</span>
                    <span class="song-time jp-duration" data-before="Time"></span>
                    <a class="song-btn" href="{{ route('home.programs.show', $program->id)}}">@lang('front_index.view')</a>


                        <div class="audio-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar" style="width:20%;"></div>
                            </div><!--jp-seek-bar--> 
                        </div><!--audio-progress--> 
                </li><!--song-->
                @endforeach
                
            </ul>
        </div>

    </div>

@endsection