<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('flowdesh_theme/css/style.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('flowdesh_theme/css/app.css') }}" rel="stylesheet">
    
    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-material-icons.css') }}" rel="stylesheet">
    
    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{ asset('flowdesh_theme/css/vendor-fontawesome-free.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
    

</head>

<body class="layout-login-centered-boxed">

    <div class="row justify-content-center align-content-center" style="height: 100vh;">
        <div class="layout-login-centered-boxed__form card">
            <div class="d-flex flex-column justify-content-center align-items-center mt-2 navbar-light">
                <a href="index.html" class="navbar-brand flex-column align-items-center mr-0" style="min-width: 0">
                    <div class="icon d-flex align-items-center justify-content-center"></div>
                </a>
        
            </div>
            {{-- Flash Message --}}
            {{-- <div class="alert alert-soft-success d-flex" role="alert">
                <i class="material-icons mr-3">check_circle</i>
                <div class="text-body">An email with password reset </div>
            </div> --}}
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label class="text-label" for="email">Email Address:</label>
                    <div class="input-group input-group-merge">
                        <input id="email" type="email" required="" class="form-control form-control-prepended" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="john@doe.com">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="far fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-label" for="password">Password:</label>
                    <div class="input-group input-group-merge">
                        <input id="password" type="password" class="form-control form-control-prepended @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus placeholder="Password">
        
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-key"></span>
                            </div>
                        </div>
        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
        
                    </div>
                </div>
                <div class="form-group mt-4">
                    <button class="btn btn-block btn-primary" type="submit">{{ __('Login') }}</button>
                </div>
        
                {{-- <div class="form-group text-center">
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a> 
                    <br>
                    @endif
                </div> --}}
            </form>
        </div>
    </div>

<!-- jQuery -->
<script src="{{ asset('flowdesh_theme/vendor/jquery.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('flowdesh_theme/vendor/bootstrap.min.js') }}"></script>

<!-- Laravel Javascript Validation -->
<script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


{{-- Sweet alert --}}
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {

        @if (session('fail_validator'))
            const sec_fail = @php echo session('fail_validator') @endphp;
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
            const propertyValues=Object.values(sec_fail);  
            console.log(propertyValues);
            Toast.fire({
                    icon: 'error',
                    title: propertyValues,
            });
            
        @endif
        @if (session('fail'))
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
            Toast.fire({
                    icon: 'error',
                    title: '{{session("fail")}}',
            });
            
        @endif

    });
</script>

</body>

</html>