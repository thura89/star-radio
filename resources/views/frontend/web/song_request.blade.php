@extends('frontend.layouts.master')
@section('title', 'Song Request')    
@section('songRequest-active', 'active')

@section('content')
     <!--=================================================
        Song Request
        ==================================================-->   

        <section class="mb-30">
            <header class="parallax parallax_two style3 text-center text-uppercase text-bold" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h2>@lang('front_index.song_request')</h2>
                        </div>
                    </div>
                </div>
            </header><!--section header-->
            <section class="mt-100">
                <div class="container">
                    <div class="container">
                        {{-- <form action="{{ route('home.songRequest.store') }}" method="POST" id="create-form" enctype="multipart/form-data">
                            @csrf
                            @method('POST') --}}
                        <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        <div class="col-xs-12 col-sm-6">
                            <div class="field-wrap">
                                <label for="name">your Name</label>
                                <input name="name" id="name" type="text" required="required" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="field-wrap">
                                <label class="tranparent" for="email">you@example.com</label>
                                <input name="email" class="tranparent" id="email" type="email" required="required" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="field-wrap">
                                <label for="songname">your Song Name</label>
                                <input name="songname" id="songname" type="text" required="required" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="field-wrap">
                                <label class="tranparent" for="artist">Artist Name</label>
                                <input name="artist" class="tranparent" id="artist" type="text" required="required" />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="field-wrap textarea-wrap">
                                <label for="message">Your Message</label>
                                <textarea name="message" id="message" required></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 text-center">
                            <button class="btn btn-default btn-md" id="butsave" type="submit">send message</button>
                        </div>
                        <div class="col-xs-12 text-center">
                            <div class="validationError">
                                <div class="alert alert-danger" role="alert">
                                    Oh snap! Change a few things up and try submitting again.
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="col-xs-12 text-center">
                                <div class="validationError">
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- </form> --}}
            
                        <div class="messageSentSuccess">
                            <div class="alert alert-success" role="alert">Message has been sent successfully, we will be in touch
                            </div>
                        </div>
            
                    </div>
                </div>
            </section>
        </section>   
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#butsave').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var songname = $('#songname').val();
                var artist = $('#artist').val();
                var message = $('#message').val();
                if (name != "" && email != "" && songname != "" && artist != "" && message != "") {
                    /*  $("#butsave").attr("disabled", "disabled"); */
                    $.ajax({
                        url: "{{ route('home.songRequest.store') }}",
                        type: "POST",
                        data: {
                            _token: $("#csrf").val(),
                            type: 1,
                            name: name,
                            email: email,
                            songname: songname,
                            artist: artist,
                            message: message
                        },
                        cache: false,
                        success: function(dataResult) {
                            console.log(dataResult);
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                swal("Your Song Request! It has been sent!", {
                                    icon: "success",
                                });
                                $("#name").val('');
                                $('label[for=name]').css({
                                    display: 'block'
                                });
                                $("#email").val('');
                                $('label[for=email]').css({
                                    display: 'block'
                                });
                                $("#songname").val('');
                                $('label[for=songname]').css({
                                    display: 'block'
                                });
                                $("#artist").val('');
                                $('label[for=artist]').css({
                                    display: 'block'
                                });
                                $("#message").val('');
                                $('label[for=message]').css({
                                    display: 'block'
                                });


                            } else if (dataResult.statusCode == 201) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!'
                                })
                            }

                        }
                    });
                } else {
                    // alert('Please fill all the field !');
                    swal("Your Song Request! Not Complete!", {
                        icon: "error",
                    });
                }
            });
        });
    </script>
@endsection
