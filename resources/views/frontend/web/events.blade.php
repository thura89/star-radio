@extends('frontend.layouts.master')
@section('title', 'Events')
@section('events-active', 'mm-active')
@section('content')
     
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
                                    <div class="time-date"><span>{{ Carbon\Carbon::parse($event->updated_at)->format('d M')}}</span></div>
                                    <div class="event-info">
                                        <figure><img src="{{ $event->event_photo_path() }}" alt="" width="265"
                                                height="265" /></figure>
                                        <span><a class="eventTitle" href="{{ route('home.event.show',$event->id)}}"> {{ Str::limit($event->title,20,'...')}}</a></span>
                                    </div>
                                    <div class="event-venue">
                                        <i class="fa fa-map-marker"></i>
                                        <div class="location">
                                            {{ $event->location }}
                                        </div>
                                    </div>
                                    <a href="{{ route('home.event.show',$event->id)}}" class="btn btn-yellow">@lang('front_index.view')</a>
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
       

@endsection
