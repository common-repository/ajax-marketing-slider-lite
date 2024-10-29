<?php 
add_action( 'save_post', 'soasl_save_woo_class_meta', 10, 2 );
add_action( 'load-post.php', 'soasl_woo_metaboxes_setup' );
add_action( 'load-post-new.php', 'soasl_woo_metaboxes_setup' );
/* Meta box setup function. */
function soasl_woo_metaboxes_setup() {
  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'soasl_add_woo_metaboxes' );
}
/* Create one or more meta boxes to be displayed on the post editor screen. */
function soasl_add_woo_metaboxes() {
  add_meta_box(
    'soasl-woo-type',      // Unique ID
    esc_html__( 'Marketing Slider Options', 'soasl_woo_cta' ),    // Title
    'soasl_woo_type_setting',   // Callback function
    'product',  // Admin page (or post type)
    'normal',         // Context
    'high'         // Priority
  );
}
$prefix_border = 'soasl_woo_setting';
$soasl_woo_metaboxes = array(
    array(
        'label'=>  'Enter the custom url for this product.',
        'desc'  => 'Where should this product link to inside the Marketing slider ?',
        'id'    => $prefix_border.'cta_url',
        'type'  => 'input'
    ),
);

function soasl_woo_type_setting(){
global $soasl_woo_metaboxes, $post;
// Use nonce for verification
echo '<input type="hidden" name="soasl_post_class_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
    // Begin the field table and loop
    echo '<table class="form-table">';
    foreach ($soasl_woo_metaboxes as $field) {
        // get value of this field if it exists for this post
        $meta = get_post_meta($post->ID, $field['id'], true);
        // begin a table row with
        
        echo '<tr>
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                <td>';
                switch($field['type']) {
                	//upload image
                    case 'input':
                        echo '<input type="text" id="'.$field['id'].'" name="'.$field["id"].'" value="'.$meta.'" />
                              <br /><span class="description">'.$field['desc'].'</span>';                              
                    break;
                } //end switch
        echo '</td></tr>';
    } // end foreach
    echo '</table>'; // end table
}

/* Save the meta box's post metadata. */
function soasl_save_woo_class_meta( $post_id, $post ) {
  global $soasl_woo_metaboxes;
  /* Verify the nonce before proceeding. */
  if ( !isset( $_POST['soasl_post_class_nonce'] ) || !wp_verify_nonce( $_POST['soasl_post_class_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;
  $options = array('soasl-woo-type');
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
  if (!wp_verify_nonce($_POST['soasl_post_class_nonce'], basename(__FILE__))) 
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

  // loop through fields and save the data
  foreach ($soasl_woo_metaboxes as $post_data) {
      $old = get_post_meta($post_id, $post_data['id'], true);
      $new = $_POST[$post_data['id']];
      if ($new && $new != $old) {
          update_post_meta($post_id, $post_data['id'], $new);
      } elseif ('' == $new && $old) {
          delete_post_meta($post_id, $post_data['id'], $old);
      }
  }
  
}
?>