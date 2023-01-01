@extends('frontend.layouts.master')
@section('title', 'news')
@section('news-active', 'active')
@section('content')
    <!--=================================
        Blog Section
            =================================-->
    <section>

        <header class="style4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>
                            @if (isset($id))
                                    @if($id == 1)
                                        @lang('front_index.local_news')
                                    @endif

                                    @if($id == 2)
                                        @lang('front_index.internationl_news')
                                    @endif

                                    @if($id == 3)
                                        @lang('front_index.economic')
                                    @endif

                                    @if($id == 4)
                                        @lang('front_index.social')
                                    @endif

                                    @if($id == 5)
                                        @lang('front_index.health')
                                    @endif

                                    @if($id == 6)
                                        @lang('front_index.tutayata')
                                    @endif

                                    @if($id == 7)
                                        @lang('front_index.sports')
                                    @endif
                                {{-- {{ config('const.all_news_cat.' . $id . '') }} --}}
                            @else
                                @lang('front_index.news')
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->

        <div class="container">
            <div class="row">
                <div class="blog-wrapper">
                    <div class="text-right">
                        {{ $news->links() }}
                    </div>
                    @forelse ($news as $new)
                        <article>
                            <figure>
                                <img src="{{ $new->news_img_path() }}" alt="" width="509" height="252" />
                            </figure>
                            <div class="about-article text-center text-uppercase">
                                <h2 class="text-semibold"><a
                                        href="{{ route('home.news.show', $new->id) }}">{{ Str::limit($new->title, 20, '...') }}</a>
                                </h2>
                                <span><i class="fa fa-clock-o"></i>
                                    {{ Carbon\Carbon::parse($new->updated_at)->format('d M') }}</span>
                            </div>
                            <p>{{ Str::limit($new->body, 50, '...') }}</p>
                            <a href="{{ route('home.news.show', $new->id) }}"
                                class="btn btn-transparent text-uppercase text-semibold">@lang('front_index.read_more')</a>
                        </article>
                    @empty
                        <p>No Data</p>
                    @endforelse

                    <div class="text-center">
                        {{ $news->links() }}
                    </div>

                </div>
                <!--blog-wrapper-->
            </div>
            <!--row-->
        </div>
        <!--container-->

    </section>
@endsection
