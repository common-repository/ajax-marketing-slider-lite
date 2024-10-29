<?php 

add_action( 'init', 'soasl_post_type', 0 );

function soasl_post_type() {



$labels = array(

    'name'                  => _x( 'Sliders', 'Sliders', 'text_domain' ),

    'singular_name'         => _x( 'Slider', 'Slider', 'text_domain' ),

    'menu_name'             => __( 'Marketing Slider', 'text_domain' ),

    'name_admin_bar'        => __( 'Marketing Slider', 'text_domain' ),

    'archives'              => __( 'Slider Archives', 'text_domain' ),

    'parent_item_colon'     => __( 'Parent Slider:', 'text_domain' ),

    'all_items'             => __( 'All Sliders', 'text_domain' ),

    'add_new_item'          => __( 'Add New Slider', 'text_domain' ),

    'add_new'               => __( 'Add New', 'text_domain' ),

    'new_item'              => __( 'New Slider', 'text_domain' ),

    'edit_item'             => __( 'Edit Slider', 'text_domain' ),

    'update_item'           => __( 'Update Slider', 'text_domain' ),

    'view_item'             => __( 'View Slider', 'text_domain' ),

    'search_items'          => __( 'Search Slider', 'text_domain' ),

    'not_found'             => __( 'Not found', 'text_domain' ),

    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),

    'featured_image'        => __( 'Featured Image', 'text_domain' ),

    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),

    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),

    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),

    'insert_into_item'      => __( 'Insert into Slider', 'text_domain' ),

    'uploaded_to_this_item' => __( 'Uploaded to this Slider', 'text_domain' ),

    'items_list'            => __( 'Sliders list', 'text_domain' ),

    'items_list_navigation' => __( 'Sliders list navigation', 'text_domain' ),

    'filter_items_list'     => __( 'Filter items list', 'text_domain' ),

);

$args = array(

    'label'                 => __( 'Slider', 'text_domain' ),

    'description'           => __( 'Slider Description', 'text_domain' ),

    'labels'                => $labels,

    'supports'              => array( ),

    // 'taxonomies'            => array( 'category', 'post_tag' ),

    'hierarchical'          => false,

    'public'                => false,

    'show_ui'               => true,

    'show_in_menu'          => true,

    'menu_position'         => 5,

    'show_in_admin_bar'     => true,

    'show_in_nav_menus'     => false,

    'can_export'            => true,

    'has_archive'           => false,        

    'exclude_from_search'   => true,

    'publicly_queryable'    => false,

    'capability_type'       => 'post',

);

register_post_type( 'soasl_slider', $args );

remove_post_type_support( 'soasl_slider', 'editor' );

}    

?>