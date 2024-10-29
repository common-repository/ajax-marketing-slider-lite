<?php 

class SOASLIDER

{

    function __construct($post_id)
    {

    }

    public function slider_data($post_id){

        $soasl_post_styling_cat_button_mode = (get_post_meta( $post_id, 'soasl_post_styling_cat_button_mode', true )) ? get_post_meta( $post_id, 'soasl_post_styling_cat_button_mode', true ) : "true";
        $soasl_post_styling_cat_button_text = (get_post_meta( $post_id, 'soasl_post_styling_cat_button_text', true )) ? get_post_meta( $post_id, 'soasl_post_styling_cat_button_text', true ) : "#ffffff";
        $soasl_post_styling_cat_button_text_bg = (get_post_meta( $post_id, 'soasl_post_styling_cat_button_text_bg', true )) ? get_post_meta( $post_id, 'soasl_post_styling_cat_button_text_bg', true ) : "#000000";
        $soasl_post_styling_cat_button_pos = (get_post_meta( $post_id, 'soasl_post_styling_cat_button_pos', true )) ? get_post_meta( $post_id, 'soasl_post_styling_cat_button_pos', true ) : "left";
        $soasl_post_styling_catbuttontext = (get_post_meta( $post_id, "soasl_post_styling_catbuttontext", true )) ? get_post_meta( $post_id, "soasl_post_styling_catbuttontext", true ) : "Categories";
        $slider_type = (get_post_meta($post_id, 'soasl-slider-type', true)) ? get_post_meta($post_id, 'soasl-slider-type', true) : 'content';

        $soasl_slider_type = (get_post_meta($post_id, "soasl-post-type-setting", true)) ? get_post_meta($post_id, "soasl-post-type-setting", true) : 'content';

        $soasl_post_styling_content_position = (get_post_meta( $post_id, 'soasl_post_styling_content_position', true )) ? get_post_meta( $post_id, 'soasl_post_styling_content_position', true ) : 'content-right';

        $soasl_cat_incex_serialized = (get_post_meta($post_id, "soasl-cat-incex", true)) ? get_post_meta($post_id, "soasl-cat-incex", true) : array();

        $soasl_post_styling_color_text = (get_post_meta($post_id, "soasl_post_styling_border_color", true)) ? get_post_meta($post_id, "soasl_post_styling_border_color", true) : '#757575';

        $soasl_post_styling_border_thickness = (get_post_meta($post_id, "soasl_post_styling_border_thickness", true)) ? get_post_meta($post_id, "soasl_post_styling_border_thickness", true) : '2';

        $soasl_post_styling_border_radius = (get_post_meta($post_id, "soasl_post_styling_border_radius", true)) ? get_post_meta($post_id, "soasl_post_styling_border_radius", true) : '2';

        $soasl_post_styling_checkbox = (get_post_meta($post_id, "soasl_post_styling_border", true)) ? get_post_meta($post_id, "soasl_post_styling_border", true) : '';

        $soasl_post_styling_select = (get_post_meta($post_id, "soasl_post_styling_select", true)) ? get_post_meta($post_id, "soasl_post_styling_select", true) : '';

        $soasl_post_styling_navigation_button = (get_post_meta( $post_id, 'soasl_post_styling_navigation_button', true)) ? get_post_meta( $post_id, 'soasl_post_styling_navigation_button', true) : '1';

        $soasl_post_styling_colorbg = (get_post_meta( $post_id, 'soasl_post_styling_colorbg', true )) ? get_post_meta( $post_id, 'soasl_post_styling_colorbg', true ) : '#ffffff';

        $soasl_post_content_color_title = (get_post_meta( $post_id, 'soasl_post_content_color_title', true )) ? get_post_meta( $post_id, 'soasl_post_content_color_title', true ) : '#ffffff';

        $soasl_post_content_color_content = (get_post_meta( $post_id, 'soasl_post_content_color_content', true )) ? get_post_meta( $post_id, 'soasl_post_content_color_content', true ) : '#020000';

        $soasl_post_type_slide_auto = (get_post_meta( $post_id, 'soasl_post_type_slide_auto', true )) ? get_post_meta( $post_id, 'soasl_post_type_slide_auto', true ) : 'false';

        $soasl_post_type_slide_auto_interval = (get_post_meta( $post_id, 'soasl_post_type_slide_auto_interval', true )) ? get_post_meta( $post_id, 'soasl_post_type_slide_auto_interval', true ) : '';

        $soasl_post_styling_slider_width = (get_post_meta( $post_id, 'soasl_post_styling_slider_width', true )) ? get_post_meta( $post_id, 'soasl_post_styling_slider_width', true ) : '';

        $soasl_post_styling_slider_full_width = (get_post_meta( $post_id, 'soasl_post_styling_slider_full_width', true )) ? get_post_meta( $post_id, 'soasl_post_styling_slider_full_width', true ) : 'true';

        $soasl_post_styling_slider_height = (get_post_meta( $post_id, 'soasl_post_styling_slider_height', true )) ? get_post_meta( $post_id, 'soasl_post_styling_slider_height', true ) : '350';

        

        $soasl_commerce_btn_bg_color = (get_post_meta( $post_id, 'soasl_commerce_btn_bg_color', true)) ? get_post_meta( $post_id, 'soasl_commerce_btn_bg_color', true) : '#000000';

        $soasl_commerce_btn_txt_color = (get_post_meta( $post_id, 'soasl_commerce_btn_txt_color', true)) ? get_post_meta( $post_id, 'soasl_commerce_btn_txt_color', true) : '#ffffff';

        $soasl_commerce_btn_radius = (get_post_meta( $post_id, 'soasl_commerce_btn_radius', true)) ? get_post_meta( $post_id, 'soasl_commerce_btn_radius', true) : '2';

        $soasl_commerce_btn_txt = (get_post_meta( $post_id, 'soasl_commerce_btn_txt', true)) ? get_post_meta( $post_id, 'soasl_commerce_btn_txt', true) : 'Buy Now!';

        $soasl_commerce_btn_custom = (get_post_meta( $post_id, 'soasl_commerce_btn_custom', true)) ? get_post_meta( $post_id, 'soasl_commerce_btn_custom', true) : '';

        $soasl_commerce_btn_txt_font = (get_post_meta( $post_id, 'soasl_commerce_btn_txt_font', true)) ? get_post_meta( $post_id, 'soasl_commerce_btn_txt_font', true) : 'Raleway';

        $soasl_post_content_font_title = (get_post_meta( $post_id, 'soasl_post_content_font_title', true )) ? get_post_meta( $post_id, 'soasl_post_content_font_title', true ) : 'Raleway';

        $soasl_post_content_size_title = (get_post_meta( $post_id, 'soasl_post_content_size_title', true )) ? get_post_meta( $post_id, 'soasl_post_content_size_title', true ) : '28';

        $soasl_post_content_font_content = (get_post_meta( $post_id, 'soasl_post_content_font_content', true )) ? get_post_meta( $post_id, 'soasl_post_content_font_content', true ) : 'Raleway';

        $soasl_post_content_size_content = (get_post_meta( $post_id, 'soasl_post_content_size_content', true )) ? get_post_meta( $post_id, 'soasl_post_content_size_content', true ) : '10';

        $soasl_post_content_readmorebtntxtcolor = (get_post_meta($post_id, 'soasl_post_content_readmorebtntxtcolor', true)) ? get_post_meta( $post_id, 'soasl_post_content_readmorebtntxtcolor', true ) : '#ffffff';

        $soasl_post_content_readmorebtntxtbgcolor = (get_post_meta($post_id, 'soasl_post_content_readmorebtntxtbgcolor', true)) ? get_post_meta( $post_id, 'soasl_post_content_readmorebtntxtbgcolor', true ) : '#000000';

        $soasl_post_content_readmore_txt = (get_post_meta($post_id, 'soasl_post_content_readmore_txt', true)) ? get_post_meta( $post_id, 'soasl_post_content_readmore_txt', true ) : 'Read more';

        $soasl_post_content_readmorebtn = (get_post_meta($post_id, 'soasl_post_content_readmorebtn', true)) ? get_post_meta( $post_id, 'soasl_post_content_readmorebtn', true ) : 'false';

        $soasl_post_content_readmorebtnfont = (get_post_meta($post_id, 'soasl_post_content_readmorebtnfont', true)) ? get_post_meta( $post_id, 'soasl_post_content_readmorebtnfont', true ) : 'Raleway';

        $soasl_post_content_readmorebtnfontsize = (get_post_meta($post_id, 'soasl_post_content_readmorebtnfontsize', true)) ? get_post_meta( $post_id, 'soasl_post_content_readmorebtnfontsize', true ) : '18';



        $soasl_commerce_cta_url = (get_post_meta( $post_id, 'soasl_commerce_cta_url', true )) ? get_post_meta( $post_id, 'soasl_commerce_cta_url', true ) : 'gtpp';

        $soasl_commerce_showreviews = (get_post_meta( $post_id, 'soasl_commerce_showreviews', true )) ? get_post_meta( $post_id, 'soasl_commerce_showreviews', true ) : 'false';

        $soasl_commerce_font_price = (get_post_meta( $post_id, 'soasl_commerce_font_price', true )) ? get_post_meta( $post_id, 'soasl_commerce_font_price', true ) : 'Raleway';

        $soasl_commerce_size_regular_price = (get_post_meta( $post_id, 'soasl_commerce_size_regular_price', true )) ? get_post_meta( $post_id, 'soasl_commerce_size_regular_price', true ) : '20';

        $soasl_commerce_size_sales_price = (get_post_meta( $post_id, 'soasl_commerce_size_sales_price', true )) ? get_post_meta( $post_id, 'soasl_commerce_size_sales_price', true ) : '21';

        $post_type_slide_effect = (get_post_meta( $post_id, 'soasl_post_type_slide_effect', true )) ? get_post_meta( $post_id, 'soasl_post_type_slide_effect', true ) : 'fxSnapIn'; 

        $soasl_post_content_source_settings = (get_post_meta( $post_id, 'soasl_post_content_source', true )) ? get_post_meta( $post_id, 'soasl_post_content_source', true ) : 'content';

        $soasl_post_content_chars_settings = (get_post_meta( $post_id, 'soasl_post_content_chars', true )) ? get_post_meta( $post_id, 'soasl_post_content_chars', true ) : '350';

        $soasl_post_color_title_settings = (get_post_meta( $post_id, 'soasl_post_content_color_title', true )) ? get_post_meta( $post_id, 'soasl_post_content_color_title', true ) : '#000000';

        $soasl_post_color_content_settings = (get_post_meta( $post_id, 'soasl_post_content_color_content', true )) ? get_post_meta( $post_id, 'soasl_post_content_color_content', true ) : '#000000';

        $soasl_post_border_radius_settings = (get_post_meta( $post_id, 'soasl_post_content_border_radius', true )) ? get_post_meta( $post_id, 'soasl_post_content_border_radius', true ) : '';

        $soasl_post_styling_social = (get_post_meta( $post_id, 'soasl_post_styling_social', true )) ? get_post_meta( $post_id, 'soasl_post_styling_social', true ) : 'FALSE';

        $soasl_post_content_color_titlebg = (get_post_meta( $post_id, 'soasl_post_content_color_titlebg', true )) ? get_post_meta( $post_id, 'soasl_post_content_color_titlebg', true ) : '#000000';

        $soasl_post_styling_disable_img_arrow = (get_post_meta( $post_id, 'soasl_post_styling_disable_img_arrow', true )) ? get_post_meta( $post_id, 'soasl_post_styling_disable_img_arrow', true ) : 'TRUE';

        $soasl_post_styling_nav_next_text = (get_post_meta( $post_id, 'soasl_post_styling_nav_next_text', true )) ? get_post_meta( $post_id, 'soasl_post_styling_nav_next_text', true ) : 'Next';

        $soasl_post_styling_nav_prev_text = (get_post_meta( $post_id, 'soasl_post_styling_nav_prev_text', true )) ? get_post_meta( $post_id, 'soasl_post_styling_nav_prev_text', true ) : 'Prev';

        $soasl_commerce_color_regular_price = (get_post_meta( $post_id, 'soasl_commerce_color_regular_price', true )) ? get_post_meta( $post_id, 'soasl_commerce_color_regular_price', true ) : '#5e5e5e';

        $soasl_commerce_color_sales_price = (get_post_meta( $post_id, 'soasl_commerce_color_sales_price', true )) ? get_post_meta( $post_id, 'soasl_commerce_color_sales_price', true ) : '#1e1e1e';

        //Ads settings

        $soasl_ads_settings_mode = (get_post_meta($post_id, 'soasl_ads_setting_radio', true)) ? get_post_meta($post_id, 'soasl_ads_setting_radio', true) : 'false';

        $soasl_ads_setting_ads_display_choice = (get_post_meta( $post_id, 'soasl_ads_setting_ads_display_choice', true )) ? get_post_meta( $post_id, 'soasl_ads_setting_ads_display_choice', true ) : 'ads_show_left';
        $soasl_ads_setting_ads_select = (get_post_meta($post_id,'soasl_ads_setting_ads_select',true)) ? get_post_meta($post_id,'soasl_ads_setting_ads_select',true) : '';

        //Commerce Settings 

        $soasl_commerce_pricing_tags = (get_post_meta( $post_id, 'soasl_commerce_pricing_tags', true )) ? get_post_meta( $post_id, 'soasl_commerce_pricing_tags', true ) : '';

        $soasl_commerce_mode = (get_post_meta( $post_id, 'soasl_commerce_mode', true )) ? get_post_meta( $post_id, 'soasl_commerce_mode', true ) : 'FALSE';

        $soasl_commerce_button = (get_post_meta($post_id,'soasl_commerce_purchase',true)) ? get_post_meta($post_id,'soasl_commerce_purchase',true) : '';

        $soasl_commerce_pricing_mode = (get_post_meta($post_id, 'soasl_commerce_pricing_mode', true)) ? get_post_meta($post_id, 'soasl_commerce_pricing_mode', true) : '';

        $soasl_pricing_tag = (get_post_meta($post_id,'soasl_commerce_pricing_tags',true)) ? get_post_meta($post_id,'soasl_commerce_pricing_tags',true) : '';

        if($soasl_slider_type == "post"){

            $soasl_tax_type_setting = "category";

        } else if($soasl_slider_type == "product"){

            $soasl_tax_type_setting = "product_cat";

        }else {

            $soasl_tax_type_setting = "category";

        }

        $soasl_cat_incex = maybe_unserialize( $soasl_cat_incex_serialized );

        $array = array(

            "slider_type" => $slider_type,

            "soasl-post-type-setting" => $soasl_slider_type,

            "soasl_cat_incex" => $soasl_cat_incex,

            "soasl_post_styling_border_color" => $soasl_post_styling_color_text,

            "soasl_post_styling_border_thickness" => $soasl_post_styling_border_thickness,

            "soasl_post_styling_border_radius" => $soasl_post_styling_border_radius,

            "soasl_post_styling_checkbox" => $soasl_post_styling_checkbox,

            "soasl_post_styling_select" => $soasl_post_styling_select,

            "soasl-tax-type-setting" => $soasl_tax_type_setting,

            "soasl_post_content_source_settings" => $soasl_post_content_source_settings,

            "soasl_post_content_chars_settings" => $soasl_post_content_chars_settings,

            "soasl_post_color_title_settings" => $soasl_post_color_title_settings,

            "soasl_post_color_content_settings" => $soasl_post_color_content_settings,

            "soasl_post_border_radius_settings" => $soasl_post_border_radius_settings,

            "soasl_post_type_slide_effect"    => $post_type_slide_effect,

            "soasl_commerce_mode" => $soasl_commerce_mode,

            "soasl_commerce_button" => $soasl_commerce_button,

            "soasl_pricing_tag" => $soasl_pricing_tag,

            "soasl_ads_setting_radio" => $soasl_ads_settings_mode,

            "soasl_post_styling_navigation_button" => $soasl_post_styling_navigation_button,

            "soasl_post_styling_colorbg" => $soasl_post_styling_colorbg,

            "soasl_post_content_color_title" => $soasl_post_content_color_title,

            "soasl_post_content_color_content" => $soasl_post_content_color_content,

            "soasl_post_content_font_title" => $soasl_post_content_font_title,

            "soasl_post_content_size_title" => $soasl_post_content_size_title,

            "soasl_post_content_font_content" => $soasl_post_content_font_content,

            "soasl_post_content_size_content" => $soasl_post_content_size_content,

            "soasl_commerce_font_price" => $soasl_commerce_font_price,

            "soasl_commerce_size_regular_price" => $soasl_commerce_size_regular_price,

            "soasl_post_type_slide_auto" => $soasl_post_type_slide_auto,

            "soasl_post_type_slide_auto_interval" => $soasl_post_type_slide_auto_interval,

            "soasl_post_styling_slider_width" => $soasl_post_styling_slider_width,

            "soasl_post_styling_slider_full_width" => $soasl_post_styling_slider_full_width,

            "soasl_post_styling_slider_height" => $soasl_post_styling_slider_height,

            "soasl_post_styling_content_position" => $soasl_post_styling_content_position,

            "soasl_commerce_btn_bg_color" => $soasl_commerce_btn_bg_color,

            "soasl_commerce_btn_txt_color" => $soasl_commerce_btn_txt_color,

            "soasl_commerce_btn_radius" => $soasl_commerce_btn_radius,

            "soasl_commerce_btn_txt" => $soasl_commerce_btn_txt,

            "soasl_commerce_btn_custom" => $soasl_commerce_btn_custom,

            "soasl_commerce_btn_txt_font" => $soasl_commerce_btn_txt_font,

            "soasl_commerce_pricing_tags" => $soasl_commerce_pricing_tags,

            "soasl_post_styling_social" => $soasl_post_styling_social,

            "soasl_post_content_color_titlebg" => $soasl_post_content_color_titlebg,

            "soasl_post_styling_disable_img_arrow" => $soasl_post_styling_disable_img_arrow,

            "soasl_post_styling_nav_next_text" => $soasl_post_styling_nav_next_text,

            "soasl_post_styling_nav_prev_text" => $soasl_post_styling_nav_prev_text,

            "soasl_commerce_pricing_mode" => $soasl_commerce_pricing_mode,

            "soasl_commerce_color_regular_price" => $soasl_commerce_color_regular_price,

            "soasl_commerce_color_sales_price" => $soasl_commerce_color_sales_price,

            "soasl_commerce_size_sales_price" => $soasl_commerce_size_sales_price,

            "soasl_commerce_cta_url" => $soasl_commerce_cta_url,

            "soasl_commerce_showreviews" => $soasl_commerce_showreviews,

            "soasl_post_content_readmorebtntxtcolor" => $soasl_post_content_readmorebtntxtcolor,

            "soasl_post_content_readmorebtntxtbgcolor" => $soasl_post_content_readmorebtntxtbgcolor,

            "soasl_post_content_readmore_txt" => $soasl_post_content_readmore_txt,

            "soasl_post_content_readmorebtn" => $soasl_post_content_readmorebtn,

            "soasl_post_content_readmorebtnfont" => $soasl_post_content_readmorebtnfont,

            "soasl_post_content_readmorebtnfontsize" => $soasl_post_content_readmorebtnfontsize,

            "soasl_ads_setting_ads_display_choice" => $soasl_ads_setting_ads_display_choice,

            "soasl_ads_setting_ads_select" => $soasl_ads_setting_ads_select,

            "soasl_post_styling_cat_button_mode" => $soasl_post_styling_cat_button_mode,
            "soasl_post_styling_cat_button_text" => $soasl_post_styling_cat_button_text,
            "soasl_post_styling_cat_button_text_bg" => $soasl_post_styling_cat_button_text_bg,
            "soasl_post_styling_cat_button_pos" => $soasl_post_styling_cat_button_pos,
            "soasl_post_styling_catbuttontext" => $soasl_post_styling_catbuttontext,
        );

        return $array;

    }

    public function slider_theming($post_id){
        $slider_choice = (null !== get_post_meta( $post_id, 'soasl-slider-type', true )) ? get_post_meta( $post_id, 'soasl-slider-type', true ) : '';
        return $this->full_width($post_id); 
    }

    public function full_width($id){
        $soaslID = $id;
        include(plugin_dir_path(__FILE__ ).'full_width.php');
    }
}

?>