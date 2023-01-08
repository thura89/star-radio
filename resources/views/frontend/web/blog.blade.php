@extends('frontend.layouts.master')
@section('css')
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 150px;
            right: 35px;
            color: #ffffff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }

            /* The Close Button */
            .close {
                /* position: relative; */
                margin: auto;
                display: block;
                width: 80%;
                max-width: 700px;
                text-align: center;
                color: #fff;
                padding: 10px 0;
                height: 150px;
            }
        }
    </style>
@endsection
@if (request()->route()->named('home.contact'))
    @section('contact-active', 'active')
    @section('title', 'Contact')
@endif

@if (request()->route()->named('home.about'))
    @section('title', 'About')
    @section('about-active', 'active')
@endif

@if (request()->route()->named('home.about'))
    @section('title', 'About')
    @section('daily_schedule-active', 'active')
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

                        @if (request()->route()->named('home.daily_schedule'))
                            <h2>@lang('front_index.daily_schedule')</h2>
                        @endif
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->
        <section class="mt-100">
            <div class="container">
                {{-- <div class="clearfix masonry-container" id="reloader"> --}}
                <div class="row">
                    @foreach ($images as $image)
                        <div class="col-xs-4">
                            <img class="img-thumbnail col-md-20" id=""
                                src="{{ config('const.blog_image_path') . $image }}" alt="{{ $data->title }}"
                                srcset="">
                        </div>
                    @endforeach
                </div>

                {{-- </div> --}}
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
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <img class="modal-content" id="img01">
        <div id="caption"></div>
        <span class="close">&times;</span>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("myImg");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");


            $('.hover_click').on('click', function(e) {
                e.preventDefault();
                var src = $("> img", this).attr('src');
                var alt = $("> img", this).attr('alt');
                modal.style.display = "block";
                modalImg.src = src;
                captionText.innerHTML = alt;
            });


            document.addEventListener("click", function(event) {
                    // If user either clicks X button OR clicks outside the modal window, then close modal by calling closeModal()
                    if (event.target.matches(".close") || $(event.target).has('.modal-content').length) {
                        closeModal()
                    }

                },
                false
            )

            function closeModal() {
                modal.style.display = "none";
            }


            // alert("An individual AJAX call has completed successfully");
            // document.getElementById("reloader").load();
            // console.log('hoho');
            // $('#reloader').load('#reloader');


        })
    </script>
@endsection
