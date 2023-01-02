<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!--=================================
        Favicon
        =================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg" color="#5bbad5') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('flowdesh_theme/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/app.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-material-icons.css') }}" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-fontawesome-free.css') }}" rel="stylesheet">

    <!-- DATATABLE CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Dropzone -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-dropzone.css') }}" rel="stylesheet">

    <!-- ImageUploader -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/image-uploader.css') }}" rel="stylesheet">

    <!-- Toastr -->
    <link type="text/css" href="{{ asset('flowdesh_theme/vendor/toastr.min.css') }}" rel="stylesheet">

    <!-- Custom Style -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/style.css') }}" rel="stylesheet">

    @yield('styles')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-133433427-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-133433427-1');
    </script>

</head>

<body class="layout-default">

    <div class="preloader"><img src="{{ asset('flowdesh_theme/images/bars.gif') }}" alt="" srcset="">
    </div>

    <!-- Header Layout -->
    <div class="mdk-header-layout js-mdk-header-layout">

        <!-- Header -->

        @include('backend.layouts.header')

        <!-- // END Header -->

        <!-- Header Layout Content -->
        <div class="mdk-header-layout__content">

            <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
                <div class="mdk-drawer-layout__content page">

                    @yield('content')

                </div>
                <!-- // END drawer-layout__content -->

                {{-- Side Bar --}}
                @include('backend.layouts.sidebar')
                {{-- end side bar --}}
            </div>
            <!-- // END drawer-layout -->

        </div>
        <!-- // END header-layout__content -->

    </div>
    <!-- // END header-layout -->

    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default"
            :layout-location="{
                'default': 'dashboard-quick-access.html',
                'fixed': 'fixed-dashboard-quick-access.html',
                'fluid': 'fluid-dashboard-quick-access.html',
                'mini': 'mini-dashboard-quick-access.html'
            }">
        </app-settings>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('flowdesh_theme/vendor/jquery.min.js') }}"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('flowdesh_theme/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('flowdesh_theme/vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('flowdesh_theme/vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('flowdesh_theme/vendor/material-design-kit.js') }}"></script>

    <!-- App -->
    <script src="{{ asset('flowdesh_theme/js/toggle-check-all.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/check-selected-row.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/dropdown.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/sidebar-mini.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/app.js') }}"></script>

    <!-- App Settings (safe to remove) -->
    <script src="{{ asset('flowdesh_theme/js/app-settings.js') }}"></script>

    {{-- DropZone --}}
    <script src="{{ asset('flowdesh_theme/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/dropzone.js') }}"></script>

    <!-- imageUploader -->
    <script src="{{ asset('flowdesh_theme/js/image-uploader.js') }}"></script>


    <!-- Toastr -->
    <script src="{{ asset('flowdesh_theme/vendor/toastr.min.js') }}"></script>
    <script src="{{ asset('flowdesh_theme/js/toastr.js') }}"></script>

    <script>
        $(document).ready(function() {

            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF_TOKEN': token.content
                    }
                });
            }
            $('.back-btn').on('click', function() {
                window.history.go(-1);
                return false;
            });

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            @if (session('create'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('create') }}'
                })
            @endif

            @if (session('update'))
                console.log('updated');
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('update') }}'
                })
            @endif

            @if (session('delete'))
                Toast.fire({
                    icon: 'success',
                    title: '{{ session('delete') }}'
                })
            @endif
        });
    </script>
    @yield('scripts')

</body>

</html>
