@extends('frontend.layouts.master')
@section('title', 'Nobles')
@section('nobles-active', 'active')
@section('content')

    <!--=================================================
                  Nobles
                  ==================================================-->
    <section>
        <header class="style4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-8">
                        <h2 class="text-uppercase">
                            @if ($cate)
                                @if ($cate == 1)
                                    @lang('front_index.daily_news')    
                                @endif
                                @if ($cate == 2)
                                    @lang('front_index.book')    
                                @endif
                            @else
                                @lang('front_index.noble')    
                            @endif
                        </h2>
                    </div>
                    <div class="col-xs-4">
                        <div class="text-right mt-15">
                            {{ $nobles->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->

        <div class="container">
            <div class="row">

                {{-- <div class="masonry-container"> --}}
                @foreach ($nobles as $noble)
                    {{-- <div class="ele-masonry"> --}}
                    <div class="col-md-6">
                        <article>
                            <figure>
                                <img src="{{ $noble->nobles_img_path() }}" alt="" width="509" height="252" />
                            </figure>
                            <div class="about-article text-center text-uppercase">
                                <h3 class="text-semibold"><a
                                        href="{{ route('home.noble.show',$noble->id)}}">{{ Str::limit($noble->title, 20, '...') }}</a></h3>
                                <span>{{ \Carbon\Carbon::parse($noble->updated_at)->diffForHumans() }}</span>
                            </div>

                            <p>{{ Str::limit($noble->body, 200, '...') }}</p>
                            <a href="{{ route('home.noble.show',$noble->id)}}" class="btn btn-transparent text-uppercase text-semibold">@lang('front_index.read_more')</a>
                        </article>
                    </div>
                    {{-- </div> --}}
                @endforeach
                {{-- </div> --}}

            </div>
            <!--row-->
            <div class="text-center">
                {{ $nobles->links() }}
            </div>
            <div class="mb-40"></div>
        </div>
        <!--container-->

    </section>
@endsection
