@extends('frontend.layouts.master')
@section('title', 'Home Page')
@section('home-active', 'active')
@section('content')
    <!--=================================
                            Main Slider
                            =================================-->
    <section class="custom-slider">
        <div id="home-slider" class="xv_slider flexslider">
            <ul class="slides">

                @foreach ($sliders as $slider)
                    <li class="xv_slide" data-slidebg="url('{{ $slider->slider_background_img_path() }}')">
                        <div class="albumAction">
                            <div class="container">
                                <a class="btn btn-dark text-uppercase text-bold" href="{{ route('home.contact') }}">
                                    <i class="fa fa-phone"></i> @lang('front_index.contact')
                                </a>
                                <a class="btn btn-default text-uppercase text-bold" href="#">
                                    <i class="fa fa-cloud-download"></i> @lang('front_index.download')
                                </a>
                            </div>
                        </div>

                        <div class="flex-caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-3 slide-visual">
                                        <figure class="fadeInLeft animated">
                                            <img src="{{ $slider->slider_front_img_path() }}" alt="" />
                                        </figure>
                                    </div>
                                    <!--column-->
                                    <div class="col-xs-12 col-sm-6 col-md-6 about-album">
                                        <div class="animated fadeInRight">
                                            <h2>{{ $slider->title }}</h2>
                                            <h6>by </h6>
                                            <p>
                                                <strong>{{ Str::limit($slider->description, 100, '...') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <!--column-->
                                </div>
                                <!--row-->
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </section>
    <!--=================================
                          Albums Section
                          =================================-->
    <section>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <h2 class="text-uppercase">@lang('front_index.program').</h2>
                    </div>
                    {{-- <div class="col-xs-12 col-md-6">
                        <div class="multiSearchWrapper">
                            <div class="multiSearchWrapper-inner">
                                <div class="custome-select clearfix">
                                    <b class="fa fa-angle-down"></b>
                                    <span>Song Category</span>
                                    <select name="albumType">
                                        <option value="">Select a Category</option>
                                        <option value="01">Hip-Hop</option>
                                        <option value="02">Rock</option>
                                        <option value="03">Clasic</option>
                                    </select>
                                </div>
                                <input placeholder="Search album" type="text" />
                            </div>
                            <!--inner-->
                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div> --}}
                </div>
            </div>
        </header>
        <!--section header-->
        <div class="container">
            <div class="search-filters text-uppercase text-bold">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <div class="searched-for" data-before="Showing : ">
                            <span class="s-keyword">@lang('front_index.latest_program').</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--row-->
        </div>
        <!--container-->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="album-grid-wrap style2">
                        <div class="album-grid text-uppercase clearfix">
                            @foreach ($categories->take(10) as $category)
                                <a href="@if (count($category->programs) == 0) # @else {{ route('home.category_programs', $category->id) }} @endif"
                                    class="album-unit">
                                    <figure><img src="{{ $category->category_img_path() }}" width="265" height="265"
                                            alt="" />
                                        <figcaption>
                                            <span>{{ $category->title }}</span>
                                            <h3>{{ Str::limit($category->descriptions, 50, '...') }}</h3>
                                            <span>series - {{ count($category->programs) }}</span>
                                        </figcaption>
                                    </figure>
                                </a>
                            @endforeach

                        </div>
                        <!--album-grid-->
                    </div>
                    <!--album-grid-wrap-->
                </div>
                <!--column-->
            </div>
            <!--row-->
        </div>
        <!--container-->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a class="btn btn-wide btn-grey text-uppercase text-bold"
                        href="{{ route('home.programs') }}">@lang('front_index.show_all_program') ({{ count($categories) }})</a>
                </div>
            </div>
        </div>
    </section>
    <!--=================================================
                          TOP songs /Trendding This week / Featured Songs
                          ==================================================-->
    <section>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-uppercase">@lang('front_index.trending_program') .</h2>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->

        {{-- <div class="container">
            <div class="search-filters text-uppercase text-bold">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <a class="link link-grey" href="#">show All Trending (top 10)</a>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-7 text-right">
                        <div class="search-actions">
                            <ul>
                                <li class="active"><a href="#">Purchased</a></li>
                                <li><a href="#">Listen</a></li>
                            </ul>
                            <ul>
                                <li class="active"><a href="#">Week</a></li>
                                <li><a href="#">Month</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--row-->
            </div>
        </div> --}}
        <!--container-->

        <div class="container">
            <ul class="song-list text-uppercase text-bold clearfix">

                @foreach ($trending_programs as $key => $program)
                    <li id="singleSongPlayer-{{ $key + 1 }}" class="song-unit singleSongPlayer clearfix"
                        data-before="{{ $key + 1 }}">

                        <div id="singleSong-jplayer-{{ $key + 4 }}" class="singleSong-jplayer"
                            data-title="{{ Str::limit($program->title, 20, '...') }}"
                            data-mp3="{{ $program->program_audio_path() }}">
                        </div>

                        <figure><img src="{{ $program->program_img_path() }}" alt="" width="265"
                                height="265" /></figure>

                        <span class="playit controls jp-controls-holder">
                            <i class="jp-play pc-play"></i>
                            <i class="jp-pause pc-pause"></i>
                        </span>
                        <span class="song-title jp-title" data-before="title"></span>
                        <span class="song-author"
                            data-before="Description">{{ Str::limit($program->body, 15, '...') }}</span>
                        <span class="song-time jp-duration" data-before="Time"></span>
                        <a class="song-btn" href="{{ route('home.programs.show', $program->id) }}">@lang('front_index.view')</a>


                        <div class="audio-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar" style="width:20%;"></div>
                            </div>
                            <!--jp-seek-bar-->
                        </div>
                        <!--audio-progress-->
                    </li>
                    <!--song-->
                @endforeach


            </ul>
        </div>

    </section>
    <!--=================================================
                          Latest News
                          ==================================================-->
    <section class="mt-30">
        <header class="style2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-uppercase">@lang('front_index.latest_news') .</h2>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->

        <div class="container">
            <div class="clearfix masonry-container">
                @foreach ($all_news as $all_new)
                    <div class="ele-masonry">
                        <article>
                            <figure>
                                <img src="{{ $all_new->news_img_path() }}" alt="" width="509" height="252" />
                            </figure>
                            <div class="about-article text-center text-uppercase">
                                <h3 class="text-semibold"><a
                                        href="{{ route('home.news.show', $all_new->id) }}">{{ Str::limit($all_new->title, 20, '...') }}</a></h3>
                                <span>{{ \Carbon\Carbon::parse($all_new->updated_at)->format('M d') }}</span>
                            </div>

                            <p>{{ Str::limit($all_new->body, 200, '...') }}</p>
                            <a href="{{ route('home.news.show', $all_new->id) }}" class="btn btn-transparent text-uppercase text-semibold">@lang('front_index.read_more')</a>
                        </article>
                    </div>
                @endforeach



            </div>
            <!--row-->
            <a href="{{ route('home.all_news') }}"
                class="btn btn-wide btn-grey text-uppercase text-bold">@lang('front_index.go_all_news')</a>
            <div class="mb-40"></div>
        </div>
        <!--container-->

    </section>
    <!--=================================
                          Events/concerts
                          =================================-->
    <section>
        <header class="parallax parallax_two style3 text-center text-uppercase text-bold"
            data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>@lang('front_index.events')</h2>
                        <p>@lang('front_index.the_latest_events')</p>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="eventsSlider" data-nexttext="<i class='fa fa-arrow-right'></i> Next  Events"
                        data-prevtext="<i class='fa fa-arrow-left'></i> Previous  Events">
                        @forelse ($events as $event)
                            <div class="event-unit-slide">
                                <div class="event-unit text-uppercase text-bold">
                                    <div class="time-date">
                                        <span>{{ Carbon\Carbon::parse($event->updated_at)->format('d M') }}</span>
                                    </div>
                                    <div class="event-info">
                                        <figure><img src="{{ $event->event_photo_path() }}" alt=""
                                                width="265" height="265" /></figure>
                                        <span><a class="eventTitle" href="{{ route('home.event.show', $event->id) }}">
                                                {{ Str::limit($event->title, 20, '...') }}</a></span>
                                    </div>
                                    <div class="event-venue">
                                        <i class="fa fa-map-marker"></i>
                                        <div class="location">
                                            {{ $event->location }}
                                        </div>
                                    </div>
                                    <a href="{{ route('home.event.show', $event->id) }}"
                                        class="btn btn-yellow">@lang('front_index.view')</a>
                                </div>
                                <!--event-->
                            </div>
                        @empty
                            <p> No events yet</p>
                        @endforelse

                    </div>
                </div>
                <!--column-->
            </div>
            <!--row-->

            <div class="navigators text-bold text-uppercase text-center">
                <div class="row">
                    <div class="col-xs-6">
                        <div id="prevEvents" class="sliderControls"></div>
                    </div>
                    <div class="col-xs-6">
                        <div id="nextEvents" class="sliderControls"></div>
                    </div>
                </div>
            </div>

        </div>
        <!--container-->
    </section>

    <!--=================================================
                          daily_schedule
                          ==================================================-->
    <section class="mt-30">
        <header class="style2">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-uppercase">@lang('front_index.daily_schedule') .</h2>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->

        <div class="container">
            <div class="row mt-50">
                @foreach (($daily_schedules) ?? [] as $key => $daily_schedule)
                <div class="col-xs-6">
                    <div class="search-filters text-uppercase text-bold">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <div class="searched-for" data-before="Programs : ">
                                    <span class="s-keyword">{{ $key}}</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 text-right">
                                <div class="search-actions">
                                    
                                    <div class="searched-for" data-before="Time : ">
                                        <span class="s-keyword">{{ $daily_schedule}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                @endforeach
                
            </div>
        </div>
        <!--container-->

    </section>
    <!--=================================================
                          Contact
                          ==================================================-->
    <section class="mb-50">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-uppercase">@lang('front_index.song_request').</h2>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->
        <div class="container">
            {{-- <form action="{{ route('home.songRequest.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                @csrf
                @method('POST') --}}
            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
            <div class="col-xs-12 col-sm-6">
                <div class="field-wrap">
                    <label for="name">your Name</label>
                    <input name="name" id="name" type="text" required="required" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="field-wrap">
                    <label class="tranparent" for="email">you@example.com</label>
                    <input name="email" class="tranparent" id="email" type="email" required="required" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="field-wrap">
                    <label for="songname">your Song Name</label>
                    <input name="songname" id="songname" type="text" required="required" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="field-wrap">
                    <label class="tranparent" for="artist">Artist Name</label>
                    <input name="artist" class="tranparent" id="artist" type="text" required="required" />
                </div>
            </div>
            <div class="col-xs-12">
                <div class="field-wrap textarea-wrap">
                    <label for="message">Your Message</label>
                    <textarea name="message" id="message" required></textarea>
                </div>
            </div>
            <div class="col-xs-12 text-center">
                <button class="btn btn-default btn-md" id="butsave" type="submit">send message</button>
            </div>
            <div class="col-xs-12 text-center">
                <div class="validationError">
                    <div class="alert alert-danger" role="alert">
                        Oh snap! Change a few things up and try submitting again.
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="col-xs-12 text-center">
                    <div class="validationError">
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            {{-- </form> --}}

            <div class="messageSentSuccess">
                <div class="alert alert-success" role="alert">Message has been sent successfully, we will be in touch
                </div>
            </div>

        </div>
        <!--container-->

    </section>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#butsave').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var songname = $('#songname').val();
                var artist = $('#artist').val();
                var message = $('#message').val();
                if (name != "" && email != "" && songname != "" && artist != "" && message != "") {
                    /*  $("#butsave").attr("disabled", "disabled"); */
                    $.ajax({
                        url: "{{ route('home.songRequest.store') }}",
                        type: "POST",
                        data: {
                            _token: $("#csrf").val(),
                            type: 1,
                            name: name,
                            email: email,
                            songname: songname,
                            artist: artist,
                            message: message
                        },
                        cache: false,
                        success: function(dataResult) {
                            console.log(dataResult);
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                swal("Your Song Request! It has been sent!", {
                                    icon: "success",
                                });
                                $("#name").val('');
                                $('label[for=name]').css({
                                    display: 'block'
                                });
                                $("#email").val('');
                                $('label[for=email]').css({
                                    display: 'block'
                                });
                                $("#songname").val('');
                                $('label[for=songname]').css({
                                    display: 'block'
                                });
                                $("#artist").val('');
                                $('label[for=artist]').css({
                                    display: 'block'
                                });
                                $("#message").val('');
                                $('label[for=message]').css({
                                    display: 'block'
                                });


                            } else if (dataResult.statusCode == 201) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                })
                            }

                        }
                    });
                } else {
                    // alert('Please fill all the field !');
                    swal("Your Song Request! Not Complete!", {
                        icon: "error",
                    });
                }
            });


        });
    </script>
@endsection
