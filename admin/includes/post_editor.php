<?php 

include('post_types.php');

include('product_metabox.php');

// include('ads_metaboxes.php');

add_action( 'save_post', 'soasl_save_post_class_meta', 10, 2 );

add_action( 'load-post.php', 'soasl_post_meta_boxes_setup' );

add_action( 'load-post-new.php', 'soasl_post_meta_boxes_setup' );

/* Meta box setup function. */

function soasl_post_meta_boxes_setup() {

  /* Add meta boxes on the 'add_meta_boxes' hook. */

  add_action( 'add_meta_boxes', 'soasl_add_post_meta_boxes' );

}

/* Create one or more meta boxes to be displayed on the post editor screen. */

function soasl_add_post_meta_boxes() {

  add_meta_box(

    'soasl-shortcode-settings',      // Unique ID

    esc_html__( 'Shortcode', 'soasl_Postshortcode' ),    // Title

    'soasl_shortcode_gen',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'side',         // Context

    'default'        // Priority

  );

  add_meta_box(

    'soasl-display-shortcode',      // Unique ID

    esc_html__( '', 'soasl_Post' ),    // Title

    'soasl_display_shortcode',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'normal',         // Context

    'high'         // Priority

  );

   add_meta_box(

    'soasl-banner-settings',      // Unique ID

    esc_html__( 'Marketing Slider Pro', 'soasl_pro_banner' ),    // Title

    'soasl_pro_banner',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'side',         // Context

    'default'        // Priority

  );

  add_meta_box(

    'soasl-cat-incex',      // Unique ID

    esc_html__( 'Categories Include/Exclude', 'soasl_Post' ),    // Title

    'soasl_post_class_meta_box',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'normal',         // Context

    'default'         // Priority

  );

  add_meta_box(

    'soasl-posts-inc-exc',      // Unique ID

    esc_html__( 'Posts Include/Exclude', 'soasl_Post' ),    // Title

    'soasl_post_incexc_meta_box',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'normal',         // Context

    'default'         // Priority

  );

  add_meta_box(

    'soasl_post_slider_type',      // Unique ID

    esc_html__( 'Slider effects', 'soasl_Post' ),    // Title

    'soasl_post_slider_effect',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'normal',         // Context

    'default'         // Priority

  );

  add_meta_box(

    'soasl-slider-styling',      // Unique ID

    esc_html__( 'Slider Main Components Styling', 'soasl_Post' ),    // Title

    'soasl_post_slider_styling', // Callback function

    'soasl_slider',       // Admin page (or post type)

    'normal',       // Context

    'default'      // Priority

  );

  add_meta_box(

    'soasl-slider-post-content',      // Unique ID

    esc_html__( 'Content settings', 'soasl_Post' ),    // Title

    'soasl_post_slider_post_content',   // Callback function

    'soasl_slider',         // Admin page (or post type)

    'normal',         // Context

    'default'        // Priority

  );

  

}

/* Display the post meta box. */

add_action('wp_ajax_refresh_soasl_cats_setting', 'refresh_soasl_cats_setting');

function refresh_soasl_cats_setting(){

  $value = $_REQUEST['value'];

  $post_id = $_REQUEST['id'];

  add_post_meta( $post_id, 'soasl-post-type-setting', $value, true);

  $post_type = get_post_meta( $post_id, 'soasl-post-type-setting', true );

  $selected_vals_serialized = get_post_meta( $post_id, 'soasl-cat-incex', 'true' );

  $selected_vals = maybe_unserialize( $selected_vals_serialized ); 



  $slider = new SOASLIDER($post_id);

  $data = $slider->slider_data($post_id);

  $option_tax_types = $data['soasl-tax-type-setting'];

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

    $selected = "";

    $o = get_option('soasl_plugin_options');

    

    foreach ($terms as $key) { 

      if(is_array($selected_vals)){

        if(in_array($key->term_id, $selected_vals)){ $selected = 'checked'; } else { $selected=""; }   

      }

      ?>

      <label><input type="checkbox" name="soasl-cat-incex[]" value="<?php echo $key->term_id; ?>" <?php echo $selected; ?>><?php echo $key->name; ?></label><br>

     <?php }



  die();

}

$prefix_for_postincexc = 'soasl_post_incexc_';

$custom_meta_fields_for_incexc = array(

    array(

        'label'=> 'Exclude Posts',

        'desc'  => 'Type the ID of the posts you wish to exclude from the slider separated with a comma e.g. 5,2,6,7',

        'id'    => 'soasl_post_incexc_posts_exclude',

        'type'  => 'exclude'
    ),

);

function soasl_post_incexc_meta_box(){
  global $custom_meta_fields_for_incexc, $post;
  echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

    // Begin the field table and loop

    echo '<table class="form-table">';

    foreach ($custom_meta_fields_for_incexc as $field) {

        // get value of this field if it exists for this post

        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>

                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>

                <td>';

                switch($field['type']) {

                    case 'exclude':
                    $unserialized_cats = get_post_meta($post->ID, 'soasl-cat-incex', true);
                    $cats = maybe_unserialize($unserialized_cats);
                    $cat_post_ids = get_posts(array(
                    'numberposts'   => -1, // get all posts.
                    'tax_query'     => array(
                        array(
                            'taxonomy'  => 'category',
                            'field'     => 'id',
                            'terms'     => $cats,
                        ),
                    ),
                    'fields'        => 'ids', // Only get post IDs
                    ));
                    if(is_array(maybe_unserialize($meta))){
                      $array = maybe_unserialize($meta);
                    } else {
                      $array = array();
                    }
                    echo '<input type="text" name="'.$field['id'].'" value="'.$meta.'" id="'.$field['id'].'" /><br />';
                    echo '<span class="description">'.$field['desc'].'</span>';
                    break;

                } //end switch

        echo '</td></tr>';

    } // end foreach

    echo '</table>'; // end table

}

function soasl_post_class_meta_box( $object, $box ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'soasl_post_class_nonce' ); ?>

  <p>

    <?php 

    global $post;

    $post_id = $post->ID;

    // $option_tax_types = get_post_meta( $post_id, '', true );

    if(null !== get_post_meta( $post_id, 'soasl-post-type-setting', true ) || get_post_meta( $post_id, 'soasl-post-type-setting', true ) !== ""){

      $post_type = get_post_meta( $post_id, 'soasl-post-type-setting', true );

    } else {

      $post_type = "post";

    }



    $selected_vals_serialized = get_post_meta( $post_id, 'soasl-cat-incex', 'true' );

    if(!empty($selected_vals_serialized) || $selected_vals_serialized !== ""){

      $selected_vals = maybe_unserialize( $selected_vals_serialized ); 

    } else {

      $selected_vals = array();

    }

    $slider = new SOASLIDER($post_id);

    $data = $slider->slider_data($post_id);

    $option_tax_types = $data['soasl-tax-type-setting'];

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

        'taxonomy'                 => 'category',

        'pad_counts'               => false 

    ); 



    $terms = get_categories( $args );

    $selected = "";

    $o = get_option('soasl_plugin_options');



    foreach ($terms as $key) { 
        if(is_object($key)){
        if(in_array($key->term_id, $selected_vals)){ 

            $selected = 'checked';

          } else { $selected = ""; }

      ?>

      <label><input type="checkbox" name="soasl-cat-incex[]" value="<?php echo $key->term_id; ?>" <?php echo $selected; ?>><?php echo $key->name; ?></label><br>

     <?php 
        } else {
          return print('<p>Please select a post type first</p>');
        }  
      } ?>

    <!-- </select> -->

  </p>

<?php }

$prefix_for_slider_type = 'soasl_post_type_';

$custom_meta_fields_for_slider_type = array(

    array(

        'label'=> 'Slide Effect',

        'desc'  => 'Choose slide effect',

        'id'    => $prefix_for_slider_type.'slide_effect',

        'type'  => 'slide_effect',

        'options' => array(

            '1' => array(

                    'label' => 'Soft scale',

                    'value' => 'fxSoftScale'

                    ),

            '2' => array(

                    'label' => 'Press away',

                    'value' => 'fxPressAway'

                    ),

            '3' => array(

                    'label' => 'Side Swing',

                    'value' => 'fxSideSwing'

                    ),

            '4' => array(

                    'label' => 'Fortune wheel',

                    'value' => 'fxFortuneWheel'

                    ),
            '6' => array(

                    'label' => 'Push reveal',

                    'value' => 'fxPushReveal'

                    ),

            '7' => array(

                    'label' => 'Snap in',

                    'value' => 'fxSnapIn'

                    ),
             '9' => array(

                    'label' => 'Stick it',

                    'value' => 'fxStickIt'

                    ),
             '10' => array(

                    'label' => 'Archive me',

                    'value' => 'fxArchiveMe'

                    ),

            '11' => array(

                    'label' => 'Vertical growth',

                    'value' => 'fxVGrowth'

                    ),

            '12' => array(

                    'label' => 'Slide Behind',

                    'value' => 'fxSlideBehind'

                    ),
        )

    ),array(

      'label'=> 'Auto Slide',

      'desc'  => 'Start sliding automatically?',

      'id'    => $prefix_for_slider_type.'slide_auto',

      'type'  => 'slide_auto',

      'options' => array(

          'one' => array(

              'label' => 'Yes',

              'value' => 'true',

          ),

          'two' => array(

              'label' => 'No',

              'value' => 'false',

          ),

      )

      ),array(

      'label'=> 'Auto Slide Interval',

      'desc'  => 'Slide every',

      'id'    => $prefix_for_slider_type.'slide_auto_interval',

      'type'  => 'slide_auto_interval',

      ),

);

function soasl_post_slider_effect(){ 

global $custom_meta_fields_for_slider_type, $post;

// Use nonce for verification

echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

     

    // Begin the field table and loop

    echo '<table class="form-table">';

    foreach ($custom_meta_fields_for_slider_type as $field) {

        // get value of this field if it exists for this post

        $meta = get_post_meta($post->ID, $field['id'], true);

        // begin a table row with

        $border_meta = get_post_meta( $post->ID, '', true );

        if($border_meta !== ""){ $selected="checked"; }else {$selected = "";}

        echo '<tr>

                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>

                <td>';

                switch($field['type']) {

                    case 'slide_effect':

                        echo '<br /><select name="'.$field['id'].'" id="'.$field['id'].'">';

                          foreach ($field['options'] as $key => $value) {

                              echo '<option value="'.$value['value'].'" ',($meta == $value['value']) ? 'selected="selected"' : '',' >'.$value['label'].'</option>';

                          }

                        echo '</select><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'slide_auto':

                        foreach ($field['options'] as $key => $value) {

                          echo '<label><input type="radio" name="'.$field['id'].'" id="'.$field['id'].'" ', ($meta == $value['value']) ? 'checked="checked"' : "" ,'" value="'.$value['value'].'">'.$value['label'].'</label>';  

                        }

                        echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'slide_auto_interval':

                          echo '<label><input type="text" name="'.$field['id'].'" id="'.$field['id'].'" placeholder="e.g.2000" value="'.$meta.'">milliseconds</label>';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    // textarea

                } //end switch

        echo '</td></tr>';

    } // end foreach

    echo '</table>'; // end table

}

//Post Styling

//

$prefix_border = 'soasl_post_styling_';

$custom_meta_fields = array(

    array(

        'label'=> 'Content Position',

        'desc'  => 'Position of the content',

        'id'    => $prefix_border.'content_position',

        'type'  => 'contentpos',

        'options' => array(

            'one' => array(

              'label' => 'Content Left',

              'value' => 'content-left'

            ),

            'two' => array(

              'label'=> 'Content Right',

              'value' => 'content-right'

            )

         )

    ),

    array(

        'label'=> 'Slider Width',

        'desc'  => 'Width of slider in pixels',

        'id'    => $prefix_border.'slider_width',

        'type'  => 'sliderwidth'

    ),

    array(

        'label'=> 'Full Width',

        'desc'  => 'Make slider 100% in width',

        'id'    => $prefix_border.'slider_full_width',

        'type'  => 'sliderfullwidth'

    ),

    array(

        'label'=> 'Slider Height',

        'desc'  => 'Height of slider in pixels',

        'id'    => $prefix_border.'slider_height',

        'type'  => 'sliderheight'

    ),

    array(

        'label'=> 'Border',

        'desc'  => 'Choose whether you like to have a border?',

        'id'    => $prefix_border.'border',

        'type'  => 'borderradio',

        'options' => array(

            'one' => array(

                'label' => 'Yes',

                'value' => 'true'

            ),

            'two' => array(

                'label' => 'No',

                'value' => 'false'

            )

        )

    ),

    array(

        'label'=> 'Border color',

        'desc'  => 'Choose the color of the slider border.',

        'id'    => $prefix_border.'border_color',

        'type'  => 'colorpicker'

    ),

    array(

        'label'=> 'Border thickness',

        'desc'  => 'Border thickness in pixels',

        'id'    => $prefix_border.'border_thickness',

        'type'  => 'text'

    ),

    array(

        'label'=> 'Border radius',

        'desc'  => 'Border radius in pixels',

        'id'    => $prefix_border.'border_radius',

        'type'  => 'text'

    ),

    array(

        'label'=> 'Slider Background color',

        'desc'  => 'Background color for the slider',

        'id'    => $prefix_border.'colorbg',

        'type'  => 'colorbg'

    ),

    array(

      'label'=>  'Choose Nav Icons',

      'desc'  => 'Choose your preferred navigation icons',

      'id'    => $prefix_border.'navigation_button',

      'type'  => 'navbuttons',

      'options' => array(

            'one' => array(

              'label' => plugins_url( 'imgs/slidenavs/next1.png', realpath(dirname(__FILE__).'/..')),

              'value' => 1,

              ),

            'two' => array(

              'label' => plugins_url( 'imgs/slidenavs/next2.png', realpath(dirname(__FILE__).'/..')),

              'value' => 2,

            ),

            'three' => array(

              'label' => plugins_url( 'imgs/slidenavs/next3.png', realpath(dirname(__FILE__).'/..')),

              'value' => 3,

            ),

        )

    ),

   

);
function soasl_post_slider_styling(){

global $custom_meta_fields, $post;

// Use nonce for verification

echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
    // Begin the field table and loop
    echo '<table class="form-table">';

    foreach ($custom_meta_fields as $field) {

        // get value of this field if it exists for this post

        $meta = get_post_meta($post->ID, $field['id'], true);

        // begin a table row with

        $border_meta = get_post_meta( $post->ID, '', true );

        if($border_meta !== ""){ $selected="checked"; }else {$selected = "";}

        echo '<tr>

                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>

                <td>';

                switch($field['type']) {

                    case 'contentpos':

                          foreach ($field['options'] as $key) {

                            echo '<p><label><input type="radio" value="'.$key['value'].'" id="'.$field['id'].'" name="'.$field['id'].'" ',($meta == $key['value']) ? 'checked="checked"' : '',' />'.$key['label'].'</label></p>';

                          }

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'borderradio':

                        foreach ($field['options'] as $key => $value) {

                          echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value['value'].'" size="30" ',($meta == $value['value']) ? 'checked="checked"' : '',' />'.$value['label'];

                        }

                        echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    // textarea

                    case 'text':

                        echo '<input type="number" name="'.$field['id'].'" size="5" placeholder="e.g.2" value="'.$meta.'" id="'.$field['id'].'" />



                            <br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'colorpicker':

                        echo '<input type="text" name="'.$field['id'].'" size="5" value="'.$meta.'" id="soasl-border-color" />

                             <div id="colorpicker"></div>

                            <br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'colorbg':

                        echo '<input type="text" name="'.$field['id'].'" size="5" value="'.$meta.'" id="'.$field['id'].'" />

                             <div id="colorpicker"></div>

                            <br /><span class="description">'.$field['desc'].'</span>';

                    break;



                    // checkbox

                    case 'checkbox':

                        echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>

                            <label for="'.$field['id'].'">'.$field['desc'].'</label>';

                    break;

                    // select

                    case 'select':

                        echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';

                        foreach ($field['options'] as $option) {

                            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';

                        }

                        echo '</select><br /><span class="description">'.$field['desc'].'</span>';

                    break;



                    case 'navbuttons':



                        // echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';

                        foreach ($field['options'] as $option) {

                             echo '<label style="display: inline-block; padding-right: 10px;"><img src="'.$option['label'].'" alt="" style="width: 20px; display: block;"/><input type="radio" name="'.$field['id'].'" class="'.$field['id'].'" value="'.$option['value'].'" size="30" ',($meta == $option['value']) ? 'checked="checked"' : '',' /></label>';

                        }

                        echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'disable_img_arrow':

                        echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '',' value="true" />

                            <label for="'.$field['id'].'">'.$field['desc'].'</label>';

                    break;

                    case 'navnexttext':



                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" placeholder="e.g.Next" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'navprevtext':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" placeholder="e.g.prev" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'navnexttxtcolor':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'navprevtxtcolor':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'navnextbgcolor':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'navprevbgcolor':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'sliderwidth':

                          echo '<input type="number" id="'.$field['id'].'" name="'.$field['id'].'" placeholder="e.g.500" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'sliderfullwidth':

                          echo '<input id="'.$field['id'].'" type="checkbox" name="'.$field['id'].'" value="true" ',($meta == 'true') ? 'checked="checked"' : '','>';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'sliderheight':

                          echo '<input type="number" id="'.$field['id'].'" width="30" name="'.$field['id'].'" placeholder="e.g.500" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                } //end switch

        echo '</td></tr>';

    } // end foreach

    echo '</table>'; // end table

}



/*Post content settings*/

$prefix_content = 'soasl_post_content_';

$custom_meta_fields_post_content = array(

    array(

        'label'=> 'Content of posts',

        'desc'  => 'Choose the source of content',

        'id'    => $prefix_content.'source',

        'type'  => 'radio',

        'options' => array(

            'one' => array(

              'label' => 'Excerpt',

              'value' => 'excerpt',

              ),

            'two' => array(

              'label' => 'Content',

              'value' => 'content',

            )

        )

    ),

    array(

        'label'=> 'Number of characters',

        'desc'  => 'Numnber of characters in post content',

        'id'    => $prefix_content.'chars',

        'type'  => 'text'

    ),

    array(

        'label'=> 'Color of post title',

        'desc'  => 'Choose the color of the post titles',

        'id'    => $prefix_content.'color_title',

        'type'  => 'colorpicker_title'

    ),

    array(

        'label'=> 'Color of post title background',

        'desc'  => 'Choose the color of the titles background',

        'id'    => $prefix_content.'color_titlebg',

        'type'  => 'color_titlebg'

    ),

    array(

        'label'=> 'Color of post content',

        'desc'  => 'Choose the color of the post content',

        'id'    => $prefix_content.'color_content',

        'type'  => 'colorpicker_content'

    ),

    array(

        'label'=> 'Font for post title',

        'desc'  => 'Choose the font for your post title',

        'id'    => $prefix_content.'font_title',

        'type'  => 'font_title'

    ),

    array(

        'label'=>  'Size of post Title',

        'desc'  => 'Choose the size in pixels for your post titles',

        'id'    => $prefix_content.'size_title',

        'type'  => 'size_title'

    ),

    array(

        'label'=> 'Font for post content',

        'desc'  => 'Choose the font for you post content',

        'id'    => $prefix_content.'font_content',

        'type'  => 'font_content'

    ),

    array(

        'label'=>  'Size of post content',

        'desc'  => 'Choose the size in pixels for your post contents',

        'id'    => $prefix_content.'size_content',

        'type'  => 'size_content'

    ),

    array(

        'label'=>  'Read more button?',

        'desc'  => 'Show read more button?',

        'id'    => $prefix_content.'readmorebtn',

        'type'  => 'readmorebtn'

    ),

    array(

        'label'=>  'Read more button text',

        'desc'  => 'e.g.Read more',

        'id'    => $prefix_content.'readmore_txt',

        'type'  => 'readmorebtntxt'

    ),

    array(

        'label'=>  'Read more button font?',

        'desc'  => 'Choose the font for your read more button',

        'id'    => $prefix_content.'readmore_font',

        'type'  => 'readmorebtnfont'

    ),

    array(

        'label'=>  'Read more button font size?',

        'desc'  => 'e.g.18',

        'id'    => $prefix_content.'readmore_fontsize',

        'type'  => 'readmorebtnfontsize'

    ),

    array(

        'label'=>  'Color of text for read more button?',

        'desc'  => 'Pick the color for the text inside the read more button.',

        'id'    => $prefix_content.'readmorebtntxtcolor',

        'type'  => 'readmorebtntxtcolor'

    ),

    array(

        'label'=>  'Background color for read more button',

        'desc'  => 'Choose the color of background for read more button',

        'id'    => $prefix_content.'readmorebtntxtbgcolor',

        'type'  => 'readmorebtntxtbgcolor'

    ),

);

function soasl_post_slider_post_content(){

global $custom_meta_fields_post_content, $post;

// Use nonce for verification

echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

     

    // Begin the field table and loop

    echo '<table class="form-table">';

    foreach ($custom_meta_fields_post_content as $field) {

        // get value of this field if it exists for this post

        $meta = get_post_meta($post->ID, $field['id'], true);

        // begin a table row with
        echo '<tr>

                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>

                <td>';

                switch($field['type']) {

                    case 'radio':

                        foreach ($field['options'] as $option) {

                          echo '<label><input id="'.$field['id'].'" type="radio"', $meta == $option['value'] ? ' checked="checked"' : '', ' value="'.$option['value'].'" name="'.$field['id'].'" />'.$option['label'].'</label><br />'; 

                        } 

                    break;

                    // textarea

                    case 'text':

                        echo '<input type="number" name="'.$field['id'].'" size="5" placeholder="e.g.300" value="'.$meta.'" />

                            <br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'colorpicker_title':

                        echo '<input type="text" name="'.$field['id'].'" id="soasl-post-title-color" value="', $meta == "" ? "#000000" : $meta,'">

                              <div id="colorpicker-post-title"></div>

                              <br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'color_titlebg':

                        echo '<input type="text" name="'.$field['id'].'" id="soasl-post-title-bg" value="', $meta == "" ? "#ffffff" : $meta,'">

                              <div id="colorpicker-post-content"></div>

                              <br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'colorpicker_content':

                        echo '<input type="text" name="'.$field['id'].'" id="soasl-post-content-color" value="', $meta == "" ? "#000000" : $meta,'">

                              <div id="colorpicker-post-content"></div>

                              <br /><span class="description">'.$field['desc'].'</span>';

                    break;



                    // checkbox

                    case 'checkbox':

                        echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>

                            <label for="'.$field['id'].'">'.$field['desc'].'</label>';

                    break;

                    // select

                    case 'select':

                        echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';

                        foreach ($field['options'] as $option) {

                            echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';

                        }

                        echo '</select><br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'font_title':

                          echo '<p><strong>Preview font: </strong><span id="fontPreviewTitle">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></p>';

                          echo '<input type="text" id="fontSelectTitle" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'size_title':

                    echo '<input type="number" name="'.$field['id'].'" placeholder="e.g.25" value="'.$meta.'"/><br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'font_content':

                          echo '<p><strong>Preview font: </strong><span id="fontPreviewContent">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></p>';

                          echo '<input type="text" id="fontSelectContent" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'size_content':

                          echo '<input type="number" name="'.$field['id'].'" placeholder="e.g.25" value="'.$meta.'"/><br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'readmorebtn':

                          echo '<input type="checkbox" value="true" id="'.$field['id'].'" name="'.$field['id'].'" ',($meta == 'true') ? 'checked="checked"' : '',' />';

                               '<span class="description">'.$field['desc'].'</span>';       

                    break;

                    case 'readmorebtnfont':

                          echo '<p><strong>Preview font: </strong><span id="fontPreviewReadmore">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span></p>';

                          echo '<input type="text" id="fontSelectReadmore" name="'.$field['id'].'" value="'.$meta.'" />';

                          echo '<br /><span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'readmorebtnfontsize':

                          echo '<input type="number" id="'.$field['id'].'" name="'.$field['id'].'" placeholder="e.g.18" value="'.$meta.'" />';

                          echo '<span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'readmorebtntxt':

                          echo '<input type="text" id="'.$field['id'].'" placeholder="e.g.Read more" name="'.$field['id'].'" value="'.$meta.'" />

                          <span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'readmorebtntxtcolor':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />

                          <span class="description">'.$field['desc'].'</span>';

                    break;

                    case 'readmorebtntxtbgcolor':

                          echo '<input type="text" id="'.$field['id'].'" name="'.$field['id'].'" value="'.$meta.'" />

                          <span class="description">'.$field['desc'].'</span>';

                    break;

                } //end switch

        echo '</td></tr>';

    } // end foreach

    echo '</table>'; // end table

}

/* Save the meta box's post metadata. */

function soasl_save_post_class_meta( $post_id, $post ) {

  global $custom_meta_fields_for_incexc, $field_for_ads_settings,$custom_meta_fields,$custom_meta_fields_post_content, $custom_meta_fields_for_slider_type;

  /* Verify the nonce before proceeding. */

  if ( !isset( $_POST['soasl_post_class_nonce'] ) || !wp_verify_nonce( $_POST['soasl_post_class_nonce'], basename( __FILE__ ) ) )

    return $post_id;



  /* Get the post type object. */

  $post_type = get_post_type_object( $post->post_type );



  /* Check if the current user has permission to edit the post. */

  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )

    return $post_id;

  // $options = array('soasl-slider-type', 'soasl-cat-incex', 'soasl-post-type-setting');

  $options = array('soasl-cat-incex', 'soasl-post-type-setting', 'custom_meta_fields_for_incexc');

  /* Get the posted data and sanitize it for use as an HTML class. */

  foreach ($options as $key) {

    $new_meta_value = ( isset( $key ) ? sanitize_html_class( $_POST[$key] ) : '' );  

    /* Get the meta key. */

  $meta_key = $key;



  /* Get the meta value of the custom field key. */

  $meta_value = get_post_meta( $post_id, $meta_key, true );



  /* If a new meta value was added and there was no previous value, add it. */

  if ( $new_meta_value && '' == $meta_value )

    add_post_meta( $post_id, $meta_key, $new_meta_value, true );



  /* If the new meta value does not match the old value, update it. */

  elseif ( $new_meta_value && $new_meta_value != $meta_value )

    update_post_meta( $post_id, $meta_key, $new_meta_value );



  /* If there is no new meta value but an old value exists, delete it. */

  elseif ( '' == $new_meta_value && $meta_value )

    delete_post_meta( $post_id, $meta_key, $meta_value );

  }

  /* Start adding Styling Meta Box To DB*/

  // verify nonce

  if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 

      return $post_id;

  // check autosave

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)

      return $post_id;

  // check permissions

  if ('page' == $_POST['post_type']) {

      if (!current_user_can('edit_page', $post_id))

          return $post_id;

      } elseif (!current_user_can('edit_post', $post_id)) {

          return $post_id;

  }

  foreach($custom_meta_fields_for_incexc as $field_post_type){
      $old = get_post_meta($post_id, $field_post_type['id'], true);

      $new = $_POST[$field_post_type['id']];

      if ($new && $new != $old) {

          update_post_meta($post_id, $field_post_type['id'], $new);

      } elseif ('' == $new && $old) {

          delete_post_meta($post_id, $field_post_type['id'], $old);

      }    
  } 
  foreach ($custom_meta_fields_for_slider_type as $field_post_type) {

      $old = get_post_meta($post_id, $field_post_type['id'], true);

      $new = $_POST[$field_post_type['id']];

      if ($new && $new != $old) {

          update_post_meta($post_id, $field_post_type['id'], $new);

      } elseif ('' == $new && $old) {

          delete_post_meta($post_id, $field_post_type['id'], $old);

      }

  } //

  // loop through fields and save the data

  foreach ($custom_meta_fields as $field) {

      $old = get_post_meta($post_id, $field['id'], true);

      $new = $_POST[$field['id']];

      if ($new && $new != $old) {

          update_post_meta($post_id, $field['id'], $new);

      } elseif ('' == $new && $old) {

          delete_post_meta($post_id, $field['id'], $old);

      }

  } // end foreach

  foreach ($custom_meta_fields_post_content as $post_data) {

      $old = get_post_meta($post_id, $post_data['id'], true);

      $new = $_POST[$post_data['id']];

      if ($new && $new != $old) {

          update_post_meta($post_id, $post_data['id'], $new);

      } elseif ('' == $new && $old) {

          delete_post_meta($post_id, $post_data['id'], $old);

      }

  }  
  foreach ($custom_meta_fields_for_incexc as $incexcdata) {
      $old = get_post_meta($post_id, 'soasl_post_incexc_posts_exclude', true);

      $new = $_POST['soasl_post_incexc_posts_exclude'];

      if ($new && $new != $old) {

          update_post_meta($post_id, 'soasl_post_incexc_posts_exclude', $new);

      } elseif ('' == $new && $old) {

          delete_post_meta($post_id, 'soasl_post_incexc_posts_exclude', $old);

      }
  }
}

function soasl_shortcode_gen(){

  global $post;

  echo '<p>Slider shortcode: </p>';

  echo '<pre>[marketing_slider id='.$post->ID.']<pre>';

}

function soasl_pro_banner(){
   echo '<p>What do you get?
        <ul>
          <li>Woocommerce integration</li>
          <li>Ajax categories load</li>
          <li>Integration of Advertisements</li>
          <li>Affiliate Marketing Tools</li>
          <li>More features</li>
          <li>FREE updates</li>
          <li>Support</li>
        </ul>
        </p>';
    echo '<div id="buynow"><a href="https://www.marketingslider.com/product/wordpress-ajax-marketing-slider/">Buy now</a></div>';
}

// UPLOAD ENGINE

function load_wp_media_files() {

    wp_enqueue_media();

}

add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );