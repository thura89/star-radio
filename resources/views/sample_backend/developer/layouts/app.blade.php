<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="en" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Implement in your applications Google or vector maps." />
    <meta name="msapplication-tap-highlight" content="no" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/images/tinemyay-favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/images/tinemyay-favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/images/tinemyay-favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('backend/images/tinemyay-favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('backend/images/tinemyay-favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    
    {{-- themes css --}}
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet" />
    {{-- Custom Css --}}
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet" />
    @yield('extra-css')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('backend.developer.layouts.header')
        <div class="app-main">
            @include('backend.developer.layouts.sidebar')
            <div class="app-main__outer">
                @yield('content')
                @include('backend.developer.layouts.footer')
            </div>
            
            {{-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> --}}
        </div>
    </div>
    @yield('modal')
    
    <script type="text/javascript" src="{{ asset('backend/js/main.js') }}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if(token){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF_TOKEN' : token.content
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
            @if(session('create'))
            Toast.fire({
                icon: 'success',
                title: '{{session('create')}}'
            })
            @endif

            @if(session('update'))
            Toast.fire({
                icon: 'success',
                title: '{{session('update')}}'
            })
            @endif
            
            @if(session('delete'))
            Toast.fire({
                icon: 'success',
                title: '{{session('delete')}}'
            })
            @endif

            @if(session('fail'))
            Toast.fire({
                icon: 'fail',
                title: '{{session('fail')}}'
            })
            @endif

            //agree check
            $('#agreebtn').prop('disabled', true);

            $('#agreecheck').on('click', function() {
                if ( $(this).prop('checked') == false ) {
                    $('#agreebtn').prop('disabled', true);
                } else {
                    $('#agreebtn').prop('disabled', false);
                }
            });

        });
    </script>
    @yield('script')
</body>

</html>
