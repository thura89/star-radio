{{-- {!! JsValidator::formRequest('App\Http\Requests\CreateAgentUserRequest','#create') !!} --}}
<script type="text/javascript" src="{{ asset('/backend/js/image-uploader.js') }}"></script>
<script>
    $(function() {

        
        $('.input-images-1').imageUploader();

        $("input[type='file']").on('change',function(){
            $( "div" ).remove( ".upimg" );
            var img = "<div class='upimg'><img src='/backend/images/upload.png'></div>";
            $(img).appendTo('.uploaded');
        });
        // var text = "<span></span>";
        // $( text ).appendTo( ".image-uploader" );

             
        let preloaded = [{
                id: 1,
                src: 'https://picsum.photos/500/500?random=1'
            },
            {
                id: 2,
                src: 'https://picsum.photos/500/500?random=2'
            },
            {
                id: 3,
                src: 'https://picsum.photos/500/500?random=3'
            },
            {
                id: 4,
                src: 'https://picsum.photos/500/500?random=4'
            },
            {
                id: 5,
                src: 'https://picsum.photos/500/500?random=5'
            },
            {
                id: 6,
                src: 'https://picsum.photos/500/500?random=6'
            },
        ];

        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'photos',
            preloadedInputName: 'old'
        });
        $('form').on('submit', function(event) {

            // Stop propagation
            // event.preventDefault();
            event.stopPropagation();

            // Get some vars
            let $form = $(this),
                $modal = $('.modal');

            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]')
            }
            // Get the new files names
            let $fileNames = $('<ul>');
            for (let file of $inputImages.prop('files')) {
                $('<li>', {
                    text: file.name
                }).appendTo($fileNames);
            }

            // Set the new files names
            $modal.find('#display-new-images').html($fileNames.html());

            // Get the preloaded inputs
            let $inputPreloaded = $form.find('input[name^="old"]');
            if ($inputPreloaded.length) {

                // Get the ids
                let $preloadedIds = $('<ul>');
                for (let iP of $inputPreloaded) {
                    $('<li>', {
                        text: '#' + iP.value
                    }).appendTo($preloadedIds);
                }

                // Show the preloadede info and set the list of ids
                $modal.find('#display-preloaded-images').show().html($preloadedIds.html());


            } else {

                // Hide the preloaded info
                $modal.find('#display-preloaded-images').hide();

            }

            // Show the modal
            // $modal.css('visibility', 'visible');
     
        });
        // Input and label handler
        $('input').on('focus', function() {
            $(this).parent().find('label').addClass('active')
        }).on('blur', function() {
            if ($(this).val() == '') {
                $(this).parent().find('label').removeClass('active');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.region').on('change', function() {
            $('.region_old').hide();
            $('.township_old').hide();
            var region_id = this.value;
            if (region_id == '') {
                $('.region_old').show();
                $('.township_old').show();
            }
            $(".township").html('');
            $.ajax({
                url: "{{ url('/admin/township') }}",
                type: "POST",
                data: {
                    region_id: region_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('.township').html('<option value="">Select State</option>');
                    $.each(result.township, function(key, value) {
                        $(".township").append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                }
            });
        });
        // Partation Show / Hide
        $('.partation_hider').hide();
        $('.partation_type').change(function() {
            if ($('.partation_type').val() == '2') {
                $('.partation_hider').show();
            } else {
                $('.partation_hider').hide();
            }
        });
        // Agreement for update
        $('input#agreecheck').attr("checked", 'checked');
        $('input#agreecheck').prop("disabled", true);
        $('button#agreebtn').prop("disabled", false);
    });
</script>
