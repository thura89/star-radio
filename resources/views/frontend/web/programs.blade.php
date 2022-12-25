@extends('frontend.layouts.master')
@section('title', 'programs')
@section('programs-active', 'mm-active')
@section('content')
    <!--=================================
    Albums Section
    =================================-->
    <section>

        <header class="style4">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2><span class="">@lang('front_index.program')</span></h2>
                    </div>
                </div>
            </div>
        </header><!--section header-->

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="album-grid-wrap style2">
                        <div class="album-grid text-uppercase clearfix">
                            @foreach ($categories as $category)
                                <a href="@if (count($category->programs) == 0) # @else {{ route('home.category_programs',$category->id)}} @endif" class="album-unit">
                                    <figure><img src="{{ $category->category_img_path()}}" width="265" height="265" alt=""/>
                                        <figcaption>
                                            <span>{{ $category->title }}</span>
                                            <h3>{{ Str::limit($category->descriptions, 50, '...') }}</h3>
                                            <span>series - {{ count($category->programs) }}</span>
                                        </figcaption>
                                    </figure>
                                </a>
                            @endforeach
                        </div><!--album-grid-->
                     </div><!--album-grid-wrap-->  
                     
                </div><!--column-->     
            </div><!--row-->
        </div><!--container-->

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <nav>
                      <ul class="pagination">
                        {{ $categories->links() }}
                      </ul>
                    </nav>
                </div>
            </div>
        </div><!--container-->
    </section>
@endsection
