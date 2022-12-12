<script>
    $(function() {

        $('.input-images-1').imageUploader();
        // var image_php = <?php echo $images; ?>;

        let preloaded = @php echo $images @endphp;
        $('.input-images-2').imageUploader({
            preloaded: preloaded,
            imagesInputName: 'photos',
            preloadedInputName: 'old'
        });

        $('form').on('submit', function(event) {

            // Stop propagation
            // event.preventDefault();
            event.stopPropagation();


            // Get the input file
            let $inputImages = $form.find('input[name^="images"]');
            if (!$inputImages.length) {
                $inputImages = $form.find('input[name^="photos"]');
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
            $modal.css('visibility', 'visible');
        });

        // Input and label handler
        // $('input').on('focus', function() {
        //     $(this).parent().find('label').addClass('active')
        // }).on('blur', function() {
        //     if ($(this).val() == '') {
        //         $(this).parent().find('label').removeClass('active');
        //     }
        // });


        let img = "<div class='upimg'><img src='/backend/images/upload.png'></div>";
        $(img).appendTo('.uploaded');
        
        $("input[type='file']").on('change', function() {
            $("div").remove(".upimg");
            var img = "<div class='upimg'><img src='/backend/images/upload.png'></div>";
            $(img).appendTo('.uploaded');
        });
    });
</script>