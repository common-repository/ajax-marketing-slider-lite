jQuery(document).ready(function($){
    var selectedCats = [];
    $('#soasl-cat-incex input').on('change', function(){
        if(this.checked){
            selectedCats.push($(this).val());
        } else {
            selectedCats.shift($(this).val());
        }
        var post_id = $(this).data('id');

        $('#post').ajaxSubmit({ success: function(responseText, statusText, xhr, $form) {
                $.post(ajaxurl, { 
                    action: 'refresh_soasl_postincexc_setting', 
                    value: selectedCats, 
                    id: post_id 
                }, function(a, b, c) { 
                    $('#exlude-box').html(a); 
                }); 
            } 
        });
        
    });
});
jQuery(document).ready(function() { "use strict";

    if (typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function') { jQuery('#soasl-border-color').wpColorPicker();

        jQuery('#soasl-post-content-color').wpColorPicker();

        jQuery('#soasl-post-title-color').wpColorPicker();

        jQuery('#soasl_post_styling_colorbg').wpColorPicker();

        jQuery('#soasl_commerce_btn_bg_color').wpColorPicker();

        jQuery('#soasl_commerce_btn_txt_color').wpColorPicker();

        jQuery('#soasl-post-title-bg').wpColorPicker();

        jQuery('#soasl_commerce_color_regular_price').wpColorPicker();

        jQuery('#soasl_commerce_color_sales_price').wpColorPicker();

        jQuery('#soasl_post_styling_nav_next_txt_color').wpColorPicker();

        jQuery('#soasl_post_styling_nav_prev_txt_color').wpColorPicker();

        jQuery('#soasl_post_styling_nav_next_bg_color').wpColorPicker();

        jQuery('#soasl_post_styling_nav_prev_bg_color').wpColorPicker();

        jQuery('#soasl_post_content_readmorebtntxtcolor').wpColorPicker();
        jQuery("#soasl_post_styling_cat_button_text").wpColorPicker();
        jQuery("#soasl_post_styling_cat_button_text_bg").wpColorPicker();
        jQuery('#soasl_post_content_readmorebtntxtbgcolor').wpColorPicker(); } else { jQuery('#colorpicker').farbtastic('#soasl-border-color'); } });

jQuery(document).ready(function($) { $('.soasl_post_type_radio_setting').change(function(event) { event.preventDefault();

        var val = $(this).val();

        var post_id = $(this).data('id');

        $('#post').ajaxSubmit({ success: function(responseText, statusText, xhr, $form) {

                var value = $(this).val;

                $.post(ajaxurl, { action: 'refresh_soasl_cats_setting', value: val, id: post_id }, function(a, b, c) { $('#soasl-cat-incex .inside p').html(a); }); } }); }); });

// var bannerID = '';

// jQuery(document).ready(function($) { 

// 	$('#upload_banner_btn').click(function() { 

// 		uploadID = jQuery(this).prev('input');

//         formfield = jQuery('.upload').attr('name');

//         tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

//         return false; 

//     });

//     window.send_to_editor = function(html) {

//         var image_url = $('img', html).attr('src');

//         uploadID.val(imgurl);

//         tb_remove();

//         $('#banner_prev').attr({ 'src': image_url }); 

//     } 

// });



// Start test

jQuery(document).ready(function($){

$('#upload_banner_btn').click(function(e) {

        e.preventDefault();

        var image = wp.media({ 

            title: 'Upload Image',

            // mutiple: true if you want to upload multiple files at once

            multiple: false

        }).open()

        .on('select', function(e){

            // This will return the selected image from the Media Uploader, the result is an object

            var uploaded_image = image.state().get('selection').first();

            // We convert uploaded_image to a JSON object to make accessing it easier

            // Output to the console uploaded_image

            console.log(uploaded_image);

            var image_url = uploaded_image.toJSON().url;

            // Let's assign the url value to the input field

            $('#soasl_ads_setting_upload_banner_image').val(image_url);

        });

    });

});

// End Test

jQuery(document).ready(function($) {

    if (jQuery('#soasl_ads_setting_random').is(':checked') == true) { jQuery('#soasl_ads_setting_interval').prop('disabled', true); }

    jQuery('#soasl_ads_setting_random').on('change', function(event) { event.preventDefault();

        if (jQuery('#soasl_ads_setting_random').is(':checked') == true) { jQuery('#soasl_ads_setting_interval').prop('disabled', true); } else { jQuery('#soasl_ads_setting_interval').prop('disabled', false); } });

    if (jQuery('#soasl_ads_setting_mode_embed').is(':checked') == true) { $('#soasl_ads_setting_insert_link').prop('disabled', true);

        $('#soasl_ads_setting_upload_banner_image').prop('disabled', true);

        $('#upload_banner_btn').prop('disabled', true);

        $('#soasl_ads_setting_add_script').prop('disabled', false); } else { $('#soasl_ads_setting_add_script').prop('disabled', true); }

    jQuery('#soasl_ads_setting_mode_embed').on('change', function() {

        if (jQuery('#soasl_ads_setting_mode_embed').is(':checked') == true) { $('#soasl_ads_setting_insert_link').prop('disabled', true);

            $('#soasl_ads_setting_upload_banner_image').prop('disabled', true);

            $('#upload_banner_btn').prop('disabled', true);

            $('#soasl_ads_setting_add_script').prop('disabled', false); } else { $('#soasl_ads_setting_insert_link').prop('disabled', false);

            $('#soasl_ads_setting_upload_banner_image').prop('disabled', false);

            $('#upload_banner_btn').prop('disabled', false);

            $('#soasl_ads_setting_add_script').prop('disabled', true); } });

    jQuery('#soasl_post_styling_slider_full_width').on('change', function() {

        if (jQuery('#soasl_post_styling_slider_full_width').is(':checked') == true) { $('#soasl_post_styling_slider_width').prop('disabled', true); } else { $('#soasl_post_styling_slider_width').prop('disabled', false); } });

    if (jQuery('#soasl_post_styling_slider_full_width').is(':checked') == true) { $('#soasl_post_styling_slider_width').prop('disabled', true); }

    jQuery('#soasl_post_styling_slider_full_height').on('change', function() {

        if (jQuery('#soasl_post_styling_slider_full_height').is(':checked') == true) { $('#soasl_post_styling_slider_height').prop('disabled', true); } else { $('#soasl_post_styling_slider_height').prop('disabled', false); } });

    if (jQuery('#soasl_post_styling_slider_full_height').is(':checked') == true) { $('#soasl_post_styling_slider_height').prop('disabled', true); }

    jQuery('#soasl_post_styling_border').on('change', function() {

        if ($(this).val() == 'false') { $('#soasl_post_styling_border_thickness').prop('disabled', true); } else { $('#soasl_post_styling_border_thickness').prop('disabled', false); } });

    if (jQuery('#soasl_post_styling_border').is(':checked') == true) {

        if ($(this).val() == 'false') { $('#soasl_post_styling_slider_height').prop('disabled', true); } }

    jQuery('#soasl_post_styling_disable_img_arrow').on('change', function() {

        if (jQuery('#soasl_post_styling_disable_img_arrow').is(':checked') == true) { $('.soasl_post_styling_navigation_button').prop('disabled', true); } else { $('.soasl_post_styling_navigation_button').prop('disabled', false); } });

    if (jQuery('#soasl_post_styling_disable_img_arrow').is(':checked') == true) { $('.soasl_post_styling_navigation_button').prop('disabled', true); }

});

jQuery(function($) { $('#fontSelect').fontselect().change(function() {

        var font = $(this).val().replace(/\+/g, ' ');

        font = font.split(':');

        $('#fontPreview').css('font-family', font[0]);

        $(this).val(font[0]); });

    $('#fontSelectPrice').fontselect().change(function() {

        var font = $(this).val().replace(/\+/g, ' ');

        font = font.split(':');

        $('#fontPreviewPrice').css('font-family', font[0]);

        $(this).val(font[0]); });

    $('#fontSelectReadmore').fontselect().change(function() {

        var font = $(this).val().replace(/\+/g, ' ');

        font = font.split(':');

        $('#fontPreviewReadmore').css('font-family', font[0]);

        $(this).val(font[0]); });

    $('#fontSelectContent').fontselect().change(function() {

        var font = $(this).val().replace(/\+/g, ' ');

        font = font.split(':');

        $('#fontPreviewContent').css('font-family', font[0]);

        $(this).val(font[0]); });

    $('#fontSelectTitle').fontselect().change(function() {

        var font = $(this).val().replace(/\+/g, ' ');

        font = font.split(':');

        $('#fontPreviewTitle').css('font-family', font[0]);

        $(this).val(font[0]); }); });