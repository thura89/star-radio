<!DOCTYPE html>
<!--[if lte IE 9]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>StarFM - @yield('title')</title>

    <!--=================================
Favicon
=================================-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('starfm_favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('starfm_favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('starfm_favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('starfm_favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('starfm_favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('starfm_favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('starfm_favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('starfm_favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('starfm_favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('starfm_favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('starfm_favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('starfm_favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('starfm_favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('starfm_favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('starfm_favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!--=================================
Meta tags
=================================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta name="viewport" content="minimum-scale=1.0, width=device-width, maximum-scale=1, user-scalable=no" />
    <!--=================================
Style Sheets
=================================-->
    <link href="http://fonts.googleapis.com/css?family=Lato:400,900,700,400italic,300,700italic" rel="stylesheet"
        type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700' rel='stylesheet'
        type='text/css'>


    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/flexslider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/animations.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/dl-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/jquery.datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('starfm/assets/css/jquery.bxslider.css') }}">
    <link rel="stylesheet" href="{{ asset('starfm/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('starfm/assets/css/style.css') }}">

    <!-- Toastr -->
    <link type="text/css" href="{{ asset('flowdesh_theme/vendor/toastr.min.css') }}" rel="stylesheet">

    @yield('css')
    <!--=================================
    Place color files here ( right after main.css ) for example
    <link rel="stylesheet" type="text/css" href="assets/css/colors/color-name.css">
    ===================================-->

    <script src="{{ asset('starfm/assets/js/modernizr-2.6.2-respond-1.1.0.min.js') }}"></script>

</head>

<body>
    <!--===============================
    Preloading Splash Screen
    ===================================-->
    <div class="pageLoader"></div>

    <div class="majorWrap">
        <!--========================================
        Header Content
        ===========================================-->
        <header id="sticktop" class="doc-header">

            <!--========================================
        Radio Stream
        ===========================================-->
            @include('frontend.layouts.radio_bar')


            <!--========================================
        Nav
        ===========================================-->
            @include('frontend.layouts.nav')
        </header>

        <div id="ajaxArea">

            @yield('content')

        </div>

        <!--=================================
        Footer
        =================================-->
        @include('frontend.layouts.footer')

    </div>


    <!--=================================
    Script Source
    =================================-->

    <script src="{{ asset('starfm/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/ajaxify.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.downCount.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jplayer/jquery.jplayer.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jplayer/jplayer.playlist.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.flexslider-min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.waitforimages.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/packery.pkgd.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/tweetie.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('starfm/assets/js/main.js') }}"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @yield('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btnBackto').on('click', function() {
                window.history.go(-1);
                return false;
            });

            @if (session('create'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('create') }}'
                })
            @endif


            $(".lang").click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "you want to change language, It will be reload page",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: '/home/locale/' + id,
                            type: 'GET',
                            data: {
                                '_token': "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                swal("Successfully Changed Language", {
                                    icon: "success",
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    } else {
                        swal("Your content is safe!");
                    }
                });
            });

        });
    </script>

</body>

</html>
