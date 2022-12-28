@extends('frontend.layouts.master')
@if (request()->route()->named('home.contact'))
    @section('contact-active', 'active')
    @section('title', 'Contact')
@endif

@if (request()->route()->named('home.about'))
    @section('title', 'About')
    @section('about-active', 'active')
@endif

@section('content')
    <!--=================================================
            gallery
            ==================================================-->

    <section>
        <header class="parallax parallax_two style3 text-center text-uppercase text-bold" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        @if (request()->route()->named('home.contact'))
                            <h2>@lang('front_index.contact')</h2>
                        @endif

                        @if (request()->route()->named('home.about'))
                            <h2>@lang('front_index.about')</h2>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->
        <section class="mt-100">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="blog-wrapper">
                            {!! $data->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if (request()->route()->named('home.contact'))
            <div>
                <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0"
                        src="https://maps.google.com/maps?width=100%25&amp;height=300&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                            href="https://www.maps.ie/distance-area-calculator.html">measure acres/hectares on
                            map</a></iframe></div>
            </div>
        @endif

    </section>
@endsection
