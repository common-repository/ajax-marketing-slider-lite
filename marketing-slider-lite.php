<?php
/*
* Plugin Name: Ajax Marketing Slider Lite
* Plugin URI: www.marketingslider.com
* Description: A fully responsive Ajax content slider, display entire post categories from one Ajax slider.Customizable fonts, colors and buttons.
* Author: soamnovum
* Author URI: www.marketingslider.com
* Version: 0.0.4
*/
remove_filter('the_content', 'wpautop');
add_action('wp_ajax_create_soasl_shc', 'create_soasl_shc');

add_action('wp_ajax_nopriv_create_soasl_shc', 'create_soasl_shc');

function create_soasl_shc(){ ?>

    <div id="soasl_add_shortcode">

        <div class="row">

            <select name="" id="soasl_sliders_shc">

            <?php

             global $wpdb; 

             $results = $wpdb->get_results("SELECT ID,post_title 

                                            FROM $wpdb->posts 

                                            WHERE post_type='soasl_slider'

                                            AND post_status='publish'

                                            ");

             foreach ($results as $key) {

            

                echo '<option value="[soasl_slider id='.$key->ID.']">'.$key->post_title.'</option>';

             

             }

            

          echo  '</select>

            <input type="button" id="soasl_insert_shc" value="Insert Shortcode"/>

                </div>

            </div>';?>

             <script type="text/javascript">

                jQuery('#soasl_insert_shc').click(function(){

                            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, jQuery('#soasl_sliders_shc').val());

                            tb_remove();

                })

            </script>

    <?php

    die();

}

add_action('wp_ajax_soasl_get_ads_content', 'soasl_get_ads_content');

add_action('wp_ajax_nopriv_soasl_get_ads_content', 'soasl_get_ads_content');

function soasl_get_ads_content(){

    check_ajax_referer( 'soaslm', 'security' );

    $id = $_REQUEST['soaslid'];

    $slider = new SOASLIDER($id);

    $data = $slider->slider_data($id);

    //To show Advertisements randomly

    $ads_mode = get_post_meta( $data["soasl_ads_setting_ads_select"], 'soasl_ads_setting_mode_embed', true );

    if($ads_mode !== false){

        //Use image as banner

        $type = 'banner';

        $content = get_post_meta( $data["soasl_ads_setting_ads_select"], 'soasl_ads_setting_upload_banner_image', true );

        $content_url = get_post_meta( $data["soasl_ads_setting_ads_select"], 'soasl_ads_setting_insert_link', true );

        $array = array('type' => $type, 'content' => $content, 'content_url' => $content_url, 'display' => $data["soasl_ads_setting_ads_display_choice"]);    

    } else {

        //Use script as banner

        $type = 'script';

        $script = get_post_meta( $data["soasl_ads_setting_ads_select"], 'soasl_ads_setting_add_script', true );

        $array = array('type' => $type, 'script' => $script,'display' => $data["soasl_ads_setting_ads_display_choice"]);

    }

    $jsonized = json_encode($array);

    print($jsonized);

    die();

}

add_shortcode( 'marketing_slider', 'process_slider' );

add_action( 'wp_enqueue_scripts', 'soasl_front_scripts' );

// Making options global

    if(isset(get_option('soasl_plugin_options')['soasl_post_type_setting'])){

            $option_post_types = get_option('soasl_plugin_options')['soasl_post_type_setting']; 

            $option_post_types_obj = get_post_type_object($option_post_types);

            if($option_post_types == 'product') {

                $option_tax_types = 'product_cat';

            } elseif($option_post_types == 'post') {

                $option_tax_types = 'category';

            }

    }

include('includes/constructor.php');    

if(isset(get_option('soasl_plugin_options')['soasl_choose_category'])){$option_category_ids = get_option('soasl_plugin_options')['soasl_choose_category'];}

if(isset(get_option('soasl_plugin_options')['soasl_post_tagging_setting'])){$option_post_tagging = get_option('soasl_plugin_options')['soasl_post_tagging_setting'];}

if(isset(get_option('soasl_plugin_options')['soasl_next_post_text_setting'])){$option_next_post_text = get_option('soasl_plugin_options')['soasl_next_post_text_setting'];}

if(isset(get_option('soasl_plugin_options')['soasl_content_amount_of_chars_setting'])){$option_amount_of_chars = get_option('soasl_plugin_options')['soasl_content_amount_of_chars_setting'];}

if(isset(get_option('soasl_plugin_options')['soasl_enable_commerce_setting'])){$option_commerce_mode = get_option('soasl_plugin_options')['soasl_enable_commerce_setting'];}

if(isset(get_option('soasl_plugin_options')['soasl_compare_buttons_setting'])){$option_compare_mode = get_option('soasl_plugin_options')['soasl_compare_buttons_setting'];}

if(isset(get_option('soasl_plugin_options')['soasl_excerpt_or_content_setting'])){$option_excerpt_content = get_option('soasl_plugin_options')['soasl_excerpt_or_content_setting'];}

if(isset(get_option('soasl_plugin_options')['soasl_enable_next_post_preview'])){$option_enable_next_post_preview = get_option('soasl_plugin_options')['soasl_enable_next_post_preview'];}

if(isset(get_option('soasl_plugin_options')['soasl_show_rating'])){ $option_enable_reviews = get_option('soasl_plugin_options')['soasl_show_rating']; }

function soasl_front_scripts(){

	wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'soasl_bootstrap_script', plugins_url( 'js/bootstrap.min.js' , __FILE__ ),'', array( 'jquery' ), false, true);

	wp_enqueue_script( 'soasl_scripts', plugins_url( 'js/global.js' , __FILE__ ),'', array( 'jquery' ), false, false);

    wp_localize_script( 'soasl_scripts', 'soasl_ajax', array('ajaxUrl' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => wp_create_nonce('soaslm')) );

    wp_enqueue_style('soasl_bootstrap_style.css', plugins_url( 'css/bootstrap.min.css' , __FILE__ ));

    wp_enqueue_style('soasl_bootstrap_theme_style.css', plugins_url( 'css/bootstrap-theme.min.css' , __FILE__ ));

    wp_enqueue_script( 'soasl_modernizr_slider_script', plugins_url( 'js/modernizr.custom.js' , __FILE__ ),'', array( 'jquery' ), false, true);

    wp_enqueue_script( 'soasl_classie_slider_script', plugins_url( 'js/classie.js' , __FILE__ ),'', array( 'jquery' ), false, false);

    wp_enqueue_script( 'soasl_metro_script', plugins_url( 'js/metro.js' , __FILE__ ),'', array( 'jquery' ), false, true);

    wp_enqueue_style('soasl_metro_main_style', plugins_url( 'css/metro/metro.css' , __FILE__ )); 

    wp_enqueue_script('thickbox');

    wp_enqueue_style('thickbox');

}

add_action('wp_ajax_load_post_ids', 'load_post_ids');

add_action('wp_ajax_nopriv_load_post_ids', 'load_post_ids');

include('admin/includes/post_editor.php');

include('admin/add_shortcodes.php');

add_action('wp_ajax_soasl_get_cat_post_ids', 'soasl_get_cat_post_ids');
add_action('wp_ajax_nopriv_soasl_get_cat_post_ids', 'soasl_get_cat_post_ids');
function soasl_get_cat_post_ids(){
    check_ajax_referer( 'soaslm', 'security' );
    $subcat_id = $_REQUEST['subcat_id'];
    $slider_id = $_REQUEST['soaslid'];

    $soaslider = new SOASLIDER($slider_id);

    $slider_options = $soaslider->slider_data($slider_id);

    $posts_array = get_posts(

    array(

        'posts_per_page' => -1,

        'post_type' => $slider_options["soasl-post-type-setting"],

        'tax_query' => array(

            array(

                'taxonomy' => $slider_options["soasl-tax-type-setting"],

                'field' => 'term_id',

                'terms' => $subcat_id,

            )

        )

        )

    );

    $post_ids = array();

    foreach ($posts_array as $key) {

        $post_ids[] = $key->ID;

    }

    print(json_encode($post_ids));
    die();
}
function load_post_ids(){

    check_ajax_referer( 'soaslm', 'security' );

    global $option_post_types;

    global $option_category_ids;

    global $option_tax_types;

    $slider_id = $_REQUEST['soaslid'];

    $soaslider = new SOASLIDER($slider_id);

    $slider_options = $soaslider->slider_data($slider_id);

    $posts_to_exclude_ = get_post_meta( $slider_id, 'soasl_post_incexc_posts_exclude', true );
    $posts_to_exclude_array = explode(',', $posts_to_exclude_); 
    if(is_array($posts_to_exclude_array)){
        $posts_to_exclude_unserialized = $posts_to_exclude_array;    
    } else {
        $posts_to_exclude_unserialized = array($posts_to_exclude_);
    }
    

    $posts_array = get_posts(

    array(

        'posts_per_page' => -1,

        'post_type' => 'post',

        'tax_query' => array(

            array(

                'taxonomy' => 'category',

                'field' => 'term_id',

                'terms' => $slider_options["soasl_cat_incex"],

            )

        )

        )

    );

    $post_ids = array();

    foreach ($posts_array as $key) {
        if(!in_array($key->ID, $posts_to_exclude_unserialized)){
            $post_ids[] = $key->ID;
        }

    }

    print(json_encode($post_ids));

    die();

}

add_action('wp_ajax_soasl_compare_products', 'soasl_compare_products');

add_action('wp_ajax_nopriv_soasl_compare_products', 'soasl_compare_products');

function soasl_compare_products(){

    check_ajax_referer( 'soaslm', 'security' );

    global $option_post_types;

    $ids = $_REQUEST['ids'];

    $ids_array = array_filter(explode(',', $ids));

    $array = array();

    if($option_post_types == 'product'){

        foreach ($ids_array as $post_id) {

            $wc_product_obj = get_product( $post_id );

            $post_thumbnail_id = get_post_thumbnail_id($post_id);

            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

            $post_url = get_permalink($post_id);

            $array[] = array( 'title' => $wc_product_obj->post->post_title, 'content' => $wc_product_obj->post->post_content,'thumb' => $post_thumbnail_url, 'post_url' => $post_url);

        }

    } elseif($option_post_types == 'post') {

        foreach ($ids_array as $post_id) {

            $post_thumbnail_id = get_post_thumbnail_id($post_id);

            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

            $post_url = get_post_permalink($post_id);

            $post_object = get_post($post_id);

            $array[] = array( 'title' => $post_object->post_title, 'content' => $post_object->post_content, 'thumb' => $post_thumbnail_url, 'post_url' => $post_url);

        }

    }

    $jsonized = json_encode($array);

    print($jsonized);

    die();

}

function load_categories(){
    global $option_post_types;
    global $option_category_ids;
    global $option_tax_types;
	$taxonomies = array( 
        $option_tax_types
    );

    $args = array(

        'type'                     => $option_post_types,

        'child_of'                 => 0,

        'parent'                   => '',

        'orderby'                  => 'name',

        'order'                    => 'ASC',

        'hide_empty'               => 1,

        'hierarchical'             => 1,

        'exclude'                  => '',

        'include'                  => '',

        'number'                   => '',

        'taxonomy'                 => $option_tax_types,

        'pad_counts'               => false 

    ); 
$categories = get_categories( $args );

    foreach ($categories as $key) {

        echo $key->term_id."<br />";

        if(in_array($key->term_id, $option_category_ids)){

            $sub_tax = array( 

                'category',



            );

            $sub_args = array(

                'parent'         => $key->term_id,

                'hide_empty'     => 1

            ); 

            $subcats = get_terms($sub_tax, $sub_args);

            $get = array();

            foreach ($subcats as $sc) {

                $get = $sc->term_id;

            }

            if(!in_array($key->term_id, $get)){

                echo '<optgroup label="'.$key->name.'"';

            } 

            var_dump($subcats);

            foreach ($subcats as $subcat) {

                echo '<option value="'.$subcat->term_id.'">'.$subcat->name.'</option>';

            }    

            echo "</optgroup>";

        }

    }

}

add_action( 'wp_ajax_process_slider', 'process_slider');

add_action('wp_ajax_nopriv_process_slider', 'process_slider');



function process_ids(){

    //get the id of the SLIDER where the shortcode is located

    check_ajax_referer( 'soaslm', 'security' );

    $slider = new SOASLIDER(142);

    $post_types = 'post';

    global $option_tax_types;

    $posts_array = get_posts(

    array(

        'posts_per_page' => -1,

        'post_type' => $option_post_types,

        'tax_query' => array(

            array(

                'taxonomy' => $option_tax_types,

                'field' => 'term_id',

                'terms' => $option_category_ids,

            )

        )

        )

    );

    $post_ids = array();

    foreach ($posts_array as $key) {

        $post_ids[] = $key->ID;

    }

    print(json_encode($post_ids));

    die();

}

function process_slider($slide){

    if(!isset($slide)){

        return;

    } else {

        if(isset($slide['id'])){

            $id = $slide['id'];

        } else {

            $id = $slide;

        }

    }
    $soaslider = new SOASLIDER($id);
    ob_start();
    $soaslider->slider_theming($id);
    $content = ob_get_contents();
    ob_get_clean();
    return $content;
}

add_action('wp_ajax_get_cat_post_ids','get_cat_post_ids' );

add_action('wp_ajax_nopriv_get_cat_post_ids','get_cat_post_ids' );

function get_cat_post_ids(){

    check_ajax_referer( 'soaslm', 'security' );

    global $option_post_types;

    global $option_category_ids;

    global $option_tax_types;

    if(!isset($_REQUEST['selected_cats'])) return;

    $decoded = json_decode($_REQUEST['selected_cats']);

	$cat_ids = preg_replace('/\"|\[|\]|\\\/', '', $_REQUEST['selected_cats']);

    $cat_ids_formatted = explode(',', $cat_ids);



    $posts_array = get_posts(

    array(

        'posts_per_page' => -1,

        'post_type' => $option_post_types,

        'tax_query' => array(

            array(

                'taxonomy' => $option_tax_types,

                'field' => 'term_id',

                'terms' => $cat_ids_formatted,

            )

        )

        )

    );

$post_ids = array();

foreach ($posts_array as $key) {

	$post_ids[] = $key->ID;

}

	print(json_encode($post_ids));

    die();

}

add_action('wp_ajax_soasl_get_post_content', 'soasl_get_post_content' );

add_action('wp_ajax_nopriv_soasl_get_post_content', 'soasl_get_post_content' );

function char_length($x, $length)

{

  if(strlen($x)<=$length)

  {

    return $x;

  }

  else

  {

    $y=substr($x,0,$length) . '...';

    return $y;

  }

}

add_action('wp_ajax_soasl_get_post_attachments','soasl_get_post_attachments');

add_action('wp_ajax_nopriv_soasl_get_post_attachments','soasl_get_post_attachments');

function soasl_get_post_attachments(){

    $post_id = $_REQUEST['id'];

    check_ajax_referer( 'soaslm', 'security' );

    $soaslid = $_REQUEST['soaslid'];

    $wc_product_obj = get_product( $post_id );

    $slider = new SOASLIDER($soaslid);

    $data = $slider->slider_data($soaslid);

    $attachment_ids = $wc_product_obj->get_gallery_attachment_ids();

    $product_urls = array();

    foreach( $attachment_ids as $attachment_id ) 

    {

      $product_urls[] = wp_get_attachment_url( $attachment_id ); 

    }

    $json = json_encode($product_urls);

    print($json);

    die();

}

function soasl_get_post_content(){

    check_ajax_referer( 'soaslm', 'security' );

    $soaslid = $_REQUEST['soaslid'];

    $slider = new SOASLIDER($soaslid);

    $data = $slider->slider_data($soaslid);

    $option_post_types = $data['soasl-post-type-setting'];

    $post_id = $_REQUEST['id'];

    if(isset($data['soasl_post_content_chars_settings'])){

        $char_length = $data['soasl_post_content_chars_settings'];

    } else {

        $char_length = 500;

    }

        $post_thumbnail_id = get_post_thumbnail_id($post_id);

        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

        $post_url = get_post_permalink($post_id);

    	$post_object = get_post($post_id);

        $post_category = get_the_category($post_id);
        if($data["soasl_post_content_source_settings"] == "content"){

            $post_source = wp_strip_all_tags($post_object->post_content, false);

            $post_source_formatted = char_length($post_source, $char_length);

        } else if($data["soasl_post_content_source_settings"] == "excerpt"){

            $post_source = wp_strip_all_tags($post_object->post_excerpt, false);

            $post_source_formatted = char_length($post_source, $char_length);

        }

        $post_source = wp_strip_all_tags($post_object->post_content, false);

        $post_source_formatted = char_length($post_source, $char_length);

        $post_filter = str_replace('[soasl_slider id='.$soaslid.']', '', $post_source_formatted);

        $post_content = $post_filter;

    	$array = array( 'title' => $post_object->post_title, 'content' => $post_content, 'thumb' => $post_thumbnail_url, 'post_url' => $post_url);

    	$jsonized = json_encode($array);

        print($jsonized);

	die();

}

add_action('wp_ajax_soasl_get_suggested_post_content', 'soasl_get_suggested_post_content');

add_action('wp_ajax_nopriv_soasl_get_suggested_post_content', 'soasl_get_suggested_post_content');

function soasl_get_suggested_post_content(){

    check_ajax_referer( 'soaslm', 'security' );

    global $option_post_types;

    if(!isset($_REQUEST['ids'])){ return false; }

    $post_ids = preg_replace('/\"|\[|\]|\\\/', '', $_REQUEST['ids']);

    $post_ids_formatted = explode(',', $post_ids);

    if($option_post_types == 'product'){ 

        $collect_data = array();

        foreach ($post_ids_formatted as $key) {

            $getting_product_object = get_product( $key );

            $post_thumbnail_id = get_post_thumbnail_id($key);

            $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);

            $post_url = get_permalink($key);

            $array = array( 'title' => $getting_product_object->post->post_title, 'content' => $getting_product_object->post->post_content,'thumb' => $post_thumbnail_url, 'post_url' => $post_url);

            $collect_data[] = $array;

        }

        $filtered_wc_data = json_encode($collect_data);

        print($filtered_wc_data);

    } elseif($option_post_types == 'post') {

        $collect_data = array();

        foreach ($post_ids_formatted as $key) {

            $post_thumbnail_id = get_post_thumbnail_id($key);

            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );

            $post_url = get_post_permalink($key);

            $post_object = get_post($key);

            $array = array( 'title' => $post_object->post_title, 'content' => $post_object->post_content, 'thumb' => $post_thumbnail_url, 'post_url' => $post_url);

            $collect_data[] = $array;

        }

        $filtered_post_data = json_encode($collect_data);

        print($filtered_post_data);

    }

    

    die();

}

    add_action( 'wp_enqueue_scripts', 'register_soasl_scripts' );

    function register_soasl_scripts() {

        wp_enqueue_style( 'soasl_styles', plugins_url( 'css/general.css', __FILE__ ) );

    }



class SOASL_Options{

    public $options; //To call the wordpress options variable wp-admin/options.php

    public $post_type;

    public function __construct(){

        $this->register_settings_and_fields();

        $this->options = get_option('soasl_plugin_options'); //We called the option field of our plugin here

        $this->load_admin_styles();

    }

    

    public function get_soasl_selected_taxonomies($post_type){

        if(null !== get_object_taxonomies($post_type, 'objects')){ 

            $option_tax_types_obj = get_object_taxonomies($post_type, 'objects');

            $option_tax_types_array = array();

            foreach ($option_tax_types_obj as $value => $key) {

                $option_tax_types_array[] = $value;

            }  

            return $option_tax_types_array;

        }





    }

    /* */

    public function register_wpbp_post_type(){

        register_post_type($this->cpt,

        array(

            'labels' => array(

                'name'                  => __('Backgrounds', $this->prefix),

                'singular_name'         => __('Background', $this->prefix),

                'menu_name'             => __('WP BG Pro', $this->prefix),

                'add_new'               => __('Add New', $this->prefix),

                'add_new_item'          => __('Add New Background', $this->prefix),

                'edit_item'             => __('Edit Background', $this->prefix),

                'new_item'              => __('New Background', $this->prefix),

                'view_item'             => __('View Background', $this->prefix),

                'search_items'          => __('Search Background', $this->prefix),

                'not_found'             => __('No Background Found', $this->prefix),

                'not_found_in_trash'    => __('No Background Found In Trash', $this->prefix),

                'parent_item_colon'     => ''

            ),

            'public'                => false,

            'publicly_queryable'    => false,

            'hierarchial'           => false,

            '_builtin'              => false,

            '_edit_link'            => 'post.php?post=%d',

            'show_ui'               => true,

            'exclude_from_search'   => true,

            'show_in_nav_menus'     => false,

            'capability_type'       => 'post',

            'can_export'            => true,

            'has_archive'           => false,

            'supports'              => array('title'),

            'menu_icon'             => '',

            )

        );

    }

    /* */

    public function register_settings_and_fields(){

        register_setting('soasl_plugin_options', 'soasl_plugin_options'); //3rd param = optional cb

        add_settings_section( 'soasl_main_section', 'Type of user', array($this, 'soasl_main_section_cb'), '/soasl_ajax_slider/admin/index.php'); //Acts like container of inputs

        add_settings_field( 'soasl_user_type', 'Choose Mode', array($this, 'soasl_user_type_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_main_section');

        add_settings_section( 'soasl_secondary_section', 'Slider settings', array($this, 'soasl_secondary_section_cb'), '/soasl_ajax_slider/admin/index.php'); //Acts like container of inputs

        add_settings_field( 'soasl_post_type', 'Post types: ', array($this, 'soasl_post_type_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_choose_category', 'Categories to use: ', array($this, 'soasl_choose_category_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section' );

        add_settings_field( 'soasl_post_tagging_mode', 'Post tagging: ', array($this, 'soasl_post_tagging_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_change_nav', 'Post navigation: ', array($this, 'soasl_change_nav_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_next_post_text', 'Next post text: ', array($this, 'soasl_next_post_text_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_content_amount_of_chars', 'Amount of chars to show: ', array($this, 'soasl_content_amount_of_chars_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_sliding_animation_type', 'Choose slider animation: ', array($this, 'soasl_sliding_animation_type_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_enable_commerce_mode', 'Enable Commerce Mode?', array($this, 'soasl_enable_commerce_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_enable_next_post_preview', 'Enable Next Post Window?', array($this, 'soasl_enable_next_post_preview'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_compare_buttons', 'Enable product compare?', array($this, 'soasl_compare_buttons_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_excerpt_or_content', 'Show post excerpt or content?', array($this, 'soasl_excerpt_or_content_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_reviews_type', 'Show ratings?', array($this, 'soasl_show_rating'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

        add_settings_field( 'soasl_slider_preview', 'Preview Slider', array($this, 'soasl_slider_preview_setting'), '/soasl_ajax_slider/admin/index.php', 'soasl_secondary_section');

    }



    public function soasl_show_rating(){

        global $option_enable_reviews;

        if(isset($option_enable_next_post_preview)){

            if($option_enable_next_post_preview == 1){ $true = 'checked="checked"'; $false = ''; } elseif($option_enable_next_post_preview == 0){ $false = 'checked="checked"'; $true = ''; };

        } else {

            $true = '';

            $false = '';

        }

        echo '<div class="radio radio-primary">';      

        echo "<label><input type='radio' name='soasl_plugin_options[soasl_show_rating]' ". $true ." value='1'><span class=\"circle\"></span><span class=\"check\"></span>Yes</label>";

        echo "<label><input type='radio' name='soasl_plugin_options[soasl_show_rating]' ". $false ." value='0'><span class=\"circle\"></span><span class=\"check\"></span>No</label>";

        echo '</div>';

    }

    public function soasl_secondary_section_cb(){



    }

    public  function soasl_slider_preview_setting(){

        echo '<button type="submit" class="btn btn-primary soasl_preview_slider">Preview Slider<div class="ripple-container"></div></button>';

    }

    public function load_admin_styles(){

        add_action( 'admin_enqueue_scripts', array($this,'load_soasl_admin_style') );

        add_action( 'wp_ajax_soasl_return_category_settings', array($this, 'soasl_return_category_settings'));

        add_action( 'admin_init', array($this, 'soasl_admin_scripts'));

    }

    public function soasl_return_category_settings(){

        $post_type = $_POST['soasl_selected_post_type'];

        global $option_tax_types;

        global $option_post_types;

        global $option_category_ids;



        $taxonomies = array( 

            $option_tax_types

        );

        $args = array(

            'type'                     => $post_type,

            'child_of'                 => 0,

            'parent'                   => '',

            'orderby'                  => 'name',

            'order'                    => 'ASC',

            'hide_empty'               => 1,

            'hierarchical'             => 1,

            'exclude'                  => '',

            'include'                  => '',

            'number'                   => '',

            'taxonomy'                 => $option_tax_types,

            'pad_counts'               => false 

        ); 



        $terms = get_categories( $args );

        

        $o = get_option('soasl_plugin_options');

        $i = 0;

        echo '<div class="checkbox soasl_categories_post_types">';

        foreach ($terms as $key) {

            $i++;

            if(isset($option_category_ids)){

                if(in_array($key->term_id, $option_category_ids)){

                    echo "<label><input type='checkbox' name='soasl_plugin_options[soasl_choose_category][$i]' value='$key->term_id' checked = 'checked'><span class='checkbox-material'><span class='check'></span></span>$key->name</label>";

                } else {

                    echo "<label><input type='checkbox' name='soasl_plugin_options[soasl_choose_category][$i]' value='$key->term_id'><span class='checkbox-material'><span class='check'></span></span>$key->name</label>";

                }

            } else {

                    echo "<label><input type='checkbox' name='soasl_plugin_options[soasl_choose_category][$i]' value='$key->term_id'><span class='checkbox-material'><span class='check'></span></span>$key->name</label>";

            }

        }

        echo '</div>';

        die();

    }

    public function soasl_admin_scripts() {

       if ( is_admin() ){ // for Admin Dashboard Only

          // Embed the Script on our Plugin's Option Page Only

          if ( isset($_GET['page']) && $_GET['page'] == 'myPluginOptions' ) {

             wp_enqueue_script('jquery');

             wp_enqueue_script( 'jquery-form' );

          }

       }

    }

    public function load_soasl_admin_style(){

        wp_enqueue_style('soasl_admin_style', plugins_url( 'admin/css/style.css' , __FILE__ ));

        wp_enqueue_script( 'soasl_admin_general_script', plugins_url( 'admin/js/admin.js' , __FILE__ ),'',  false, false);

        wp_enqueue_script( 'soasl_form_submit_script', plugins_url( 'admin/js/jquery.form.js' , __FILE__ ),'',  false, false);

        wp_enqueue_script( 'soasl_fontselect_script', plugins_url( 'admin/js/jquery.fontselect.min.js' , __FILE__ ),'',  false, false);

        wp_enqueue_style('soasl_fontselect_style', plugins_url( 'admin/css/fontselect.css' , __FILE__ ));

        wp_enqueue_script('thickbox');

        wp_enqueue_script( 'media-upload' );

        wp_enqueue_style('thickbox');

        //Access the global $wp_version variable to see which version of WordPress is installed.

        global $wp_version; 

        //If the WordPress version is greater than or equal to 3.5, then load the new WordPress color picker.

        if ( 3.5 <= $wp_version ){

        //Both the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.

        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_script( 'wp-color-picker' );

        }

        //If the WordPress version is less than 3.5 load the older farbtasic color picker.

        else {

            //As with wp-color-picker the necessary css and javascript have been registered already by WordPress, so all we have to do is load them with their handle.

            wp_enqueue_style( 'farbtastic' );

            wp_enqueue_script( 'farbtastic' );

        }

    }

    public function soasl_main_section_cb(){



    }
  

}
// add_action('wp_ajax_refresh_soasl_postincexc_setting', 'refresh_soasl_postincexc_setting');
// function refresh_soasl_postincexc_setting(){
//     $post_id = $_REQUEST['id'];
//     $array = $_REQUEST['value'];
//     $unserialized_cats = get_post_meta($post_id, 'soasl-cat-incex', true);
//     $cats = maybe_unserialize($unserialized_cats);
//     $cat_post_ids = get_posts(array(
//     'numberposts'   => -1, // get all posts.
//     'tax_query'     => array(
//         array(
//             'taxonomy'  => 'category',
//             'field'     => 'id',
//             'terms'     => $array,
//         ),
//     ),
//     'fields'        => 'ids', // Only get post IDs
//     ));
//     if(is_array(maybe_unserialize($meta))){
//       $array = maybe_unserialize($meta);
//     } else {
//       $array = array();
//     }
//     echo '<div id="exlude-box">';
//     foreach ($cat_post_ids as $key) {
//         echo '<label><input type="checkbox" value="'.$key.'" name="soasl_post_incexc_posts_exclude[]" ',(in_array($key, $array)) ? 'checked="checked"' : '' ,' />'.get_the_title($key).'</label><br />';  
//     } 
//     echo '</div>';
//     die();
// }

add_action('admin_init', function(){

    new SOASL_Options();

}); //enables us to register our settings

//Add column shortcodes
add_filter( 'manage_edit-soasl_slider_columns', 'news_edit_columns_title' ); 
//Here news is a custom post type , you can update its value according to post type.
/* We are taking shortcode field as custom filed */
function news_edit_columns_title( $columns ) {
 $columns = array(
 'cb' => '<input type="checkbox" />',
 'title' => __( 'Title', 'Theme_Name' ),
 'shortcode' => __( 'Shortcodes', 'Theme_Name' ),
 'date' => __( 'Date', 'Theme_Name' ),
 );
 return $columns;
}

/* Set the shortcode field value to that columns */

add_action( 'manage_posts_custom_column', 'add_shortcodes_columns_value' );
function add_shortcodes_columns_value( $column ) {
$custom_fields = get_post_custom();
 switch ( $column ) {
 case 'shortcode' :
 echo '[marketing_slider id='.get_the_ID().']';
//here custom_shortcode_value_key is the meta key for shortcode
break;
 }
}
?>