    jQuery(document).ready(function($) {
        $('.header_logo_upload').click(function(e) {
            e.preventDefault();

            var custom_uploader = wp.media({
                title: 'Custom Image',
                button: {
                    text: 'Upload Image'
                },
                multiple: false  // Set this to true to allow multiple files to be selected
            })
            .on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                $('.header_logo').attr('src', attachment.url);
                $('.header_logo_url').val(attachment.url);
                $('.header_logo').show();
                $('.remove_logo_upload').show();

            })
            .open();
        });

        $('.remove_logo_upload').click(function(e) {
            e.preventDefault();
                $('.header_logo').attr('src', "");
                $('.header_logo_url').val("");
                $('.header_logo').hide();
                $('.remove_logo_upload').hide();
            
        });

        $('#reset_data').click(function(e) {
            e.preventDefault();

            $('.header_logo').attr('src', "");
                $('.header_logo_url').val("");
                $('.header_logo').hide();
                $(".dateCreate").val("");
                $(".typeProduct").val("no");
                $('#upload_data').text('Save'); 

        });

    });