@extends('frontend.layouts.master')
@section('title', 'Events Show')
@section('events-active', 'mm-active')
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
@section('content')

    <!--=================================================
                                                                                            gallery
                                                                                            ==================================================-->

    <section>
        <header class="parallax parallax_two style3 text-center text-uppercase text-bold" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>{{ $data->title }}</h2>
                        <p>{{ Carbon\Carbon::parse($data->updated_at)->format('d M') }}</p>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->


        <header class="style4 mt-35">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2><span class="">{{ $data->title }}</span></h2>
                    </div>
                </div>
            </div>
        </header>
        <!--section header-->
        <!--=================================
                                                                                        Blog Section
                                                                                        =================================-->
        <div>
            <div class="container">
                <article class="articleSingle">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-lg-12 ">
                            <p class="text-justify">{{ $data->body }}</p>
                            <div class="text-center">
                                <span class="timeStamp"><i class="fa fa-clock-o"></i>
                                    {{ Carbon\Carbon::parse($data->updated_at)->format('d M') }}</span>
                            </div>
                        </div>
                        <!--column-->
                    </div>
                    <!--row-->
                </article>
            </div>
            <!--container-->
        </div>
        @if (Agent::isMobile())
            <div class="container">
                <div class="row">
                    @foreach ($images as $key => $image)
                        <div class="col mb-10">
                            <img class="" id=""
                            src="{{ config('const.event_image_path') . $image }}" alt="{{ $data->title }}" srcset="">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="photography mb-35">
                <div class="container">
                    <div class="xvPackeryItems">
                        @php
                            $key1 = [0, 6, 12, 18];
                            $key2 = [1, 2, 3, 7, 8, 9, 13, 14, 15, 19, 20, 21];
                            $key3 = [4, 5, 10, 11, 16, 17, 22, 23];
                        @endphp
                        @foreach ($images as $key => $image)
                            @if ($key1[$key] ?? null == $key)
                                <div class="xvPackeryItem featured w2"
                                    style="background-image:url('{{ config('const.event_image_path') . $image }}')">
                                    <a href="#" class="hover_click">
                                        <img class="img_{{ $key }}" id="myImg" style="display: none"
                                            src="{{ config('const.event_image_path') . $image }}"
                                            alt="{{ $data->title }}" srcset="">
                                        <div class="eventInfo">
                                            <h3>{{ $data->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @elseif ($key2[$key] ?? null == $key)
                                <div class="xvPackeryItem featured"
                                    style="background-image:url('{{ config('const.event_image_path') . $image }}')">
                                    <a href="#" class="hover_click">
                                        <img class="img_{{ $key }}" id="myImg" style="display: none"
                                            src="{{ config('const.event_image_path') . $image }}"
                                            alt="{{ $data->title }}" srcset="">
                                        <div class="eventInfo">
                                            <h3>{{ $data->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @elseif ($key3[$key] ?? null == $key)
                                <div class="xvPackeryItem"
                                    style="background-image:url('{{ config('const.event_image_path') . $image }}')">
                                    <a href="#" class="hover_click">
                                        <img class="img_{{ $key }}" id="myImg" style="display: none"
                                            src="{{ config('const.event_image_path') . $image }}"
                                            alt="{{ $data->title }}" srcset="">
                                        <div class="eventInfo">
                                            <h3>{{ $data->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <!--container-->
            </div>
        @endif
        <!--movies-->
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



        })
    </script>
@endsection
