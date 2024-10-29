<?php
/**
 * I included this section in case you do a copy paste you don't have to worry
 * about setting up a stylesheet
 *
 *  function soasl_js_shortcode_css()
    {
        wp_register_style('js-shortcode-css',
                       plugins_url( '/style.css', __FILE__ ),
                       false,
                       '1.0',
                       false );
        wp_enqueue_style('js-shortcode-css');
    }
    //Make sure the style sheet is only loaded in the backend
    add_action( 'admin_head', 'soasl_js_shortcode_css' );
*/

//Need to find what the base of the page you currently are on
if(!defined("JS_CURRENT_PAGE"))
    define("JS_CURRENT_PAGE", basename($_SERVER['PHP_SELF']));

//If the current page is a page or a post load the popup to be run in the admin footer
if(in_array(JS_CURRENT_PAGE, array('post.php', 'page.php', 'page-new.php', 'post-new.php'))){
    //THe third argument is set to 11 so the button appears after the WordPress Add Media button
    add_action('media_buttons', 'add_soasl_js_shortcode_button', 11);
    add_action('admin_footer',  'add_soasl_js_shortcode_popup');
    
}

//Function for creating the button
function add_soasl_js_shortcode_button()
{
    //Check to see if the current page is contained in the array    
    $is_post_edit_page = in_array(JS_CURRENT_PAGE, array('post.php', 'page.php', 'page-new.php', 'post-new.php'));
    if($is_post_edit_page)
    {
        //Use the wordpress thick box to display the popup
        //More info can be found here https://codex.wordpress.org/ThickBox
        echo '<a href="#TB_inline?width=480&inlineId=select_js_shortcode" class="thickbox"
            id="add_js_shortcode" title="' . __("Marketing Slider", 'js_shortcode') . '"><button type="button" class="button">Marketing Slider</button></a>';

    }
}

//Button for the popup with two forms for example
function add_soasl_js_shortcode_popup()
{
?>
    <script>
    jQuery(document).ready(function() {
        //Hide the forms until one is selected
        jQuery("#contact_form_attributes").hide();
        jQuery("#button_form_attributes").hide();
        
        //Name of the select that you will be watching for a change
        jQuery("#add_js_short").change(function() {
            if (jQuery("#add_js_short").val() == 'contact') {
                jQuery("#contact_form_attributes").show();
                jQuery("#button_form_attributes").hide();
            }
            else if (jQuery("#add_js_short").val() == 'button') {
                jQuery("#button_form_attributes").show();
                jQuery("#contact_form_attributes").hide();
            }
            else { 
                jQuery("#contact_form_attributes").hide();
                jQuery("#button_form_attributes").hide();
            }
        });
    });
        
    //This is run once a user clicks the submit button  
    function InsertShortcode(){
        var form_shortcode = jQuery("#add_soasl_js_short").val();
        wp.media.editor.insert("[marketing_slider id=" + form_shortcode + "]");
        
    }
    </script>
    
    <div id="select_js_shortcode" style="display:none;">
        <div class="soasl_js_shortcode_form_display">
            <h3 id="soasl_js_shortcode_header"><?php _e("Insert Marketing Slider Shortcode", "js_shortcode"); ?></h3>
            <span>
                <?php _e("Select shortcode from the drop-down menu to add it to your page or post.", "js_shortcode"); ?>
            </span>
        </div>
        <div class="soasl_js_shortcode_form_display">
            <select name="add_soasl_js_short" id="add_soasl_js_short">
              	<?php
				 global $wpdb; 
				 $results = $wpdb->get_results("SELECT ID,post_title 
				 								FROM $wpdb->posts 
				 								WHERE post_type='soasl_slider'
				 								AND post_status='publish'
				 								");
				 foreach ($results as $key) {
				 ?>
					<option value="<?php echo $key->ID; ?>"><?php echo $key->post_title; ?></options>
				 <?php
				 }
				 ?>
            </select>
        </div>
        
        <div style="padding:15px;">
            <input type="button" value="Insert Slider Shortcode" onclick="InsertShortcode();"/>&nbsp;&nbsp;&nbsp;
            <a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;"><?php _e("Cancel", "js_shortcode"); ?></a>
        </div>
    </div>
<?php
}
?>