<?php $data = $this->slider_data($soaslID); 
      if($data["soasl_post_styling_checkbox"] == "true"){

          $border ="<style>#soasl_ultimate_container{ border: ".$data["soasl_post_styling_border_thickness"]."px solid ".$data["soasl_post_styling_border_color"]."; border-radius: ".$data["soasl_post_styling_border_radius"]."px;}</style>";

      } else {

          $border = "";

      }

      

      if($data["soasl_post_styling_content_position"] == "content-left"){ 

        $contentposition = "col-lg-pull-5 col-md-pull-5 col-sm-pull-5"; 

        $imgposition = "col-lg-push-6 col-md-push-6 col-sm-push-6";

      } else { 

        $contentposition = ""; $imgposition ="";

      }
?>    



<script>var soaslID = <?php echo $soaslID; ?>; 
var usrSpecifiedHeight = <?php echo $data["soasl_post_styling_slider_height"]; ?>;
var soaslAutoSlide = "<?php echo $data['soasl_post_type_slide_auto']; ?>";
var soaslAutoSlideInterval = <?php echo ($data["soasl_post_type_slide_auto_interval"] !== "") ? $data["soasl_post_type_slide_auto_interval"] : 2000; ?>;
</script>

<?php echo $border; 

$fontsArray = array(

  $data["soasl_post_content_readmorebtnfont"],

  $data["soasl_post_content_font_title"],

  $data["soasl_post_content_font_content"],

  $data['soasl_commerce_font_price'],

);

$fonts_nodupes = array_unique($fontsArray);

foreach ($fonts_nodupes as $key) { ?>

<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=<?php echo $key; ?>">

<?php

  }

?>

<link rel="shortcut icon" href="../favicon.ico">

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url( 'transitions/css/normalize.css', dirname(__FILE__)); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('transitions/css/component.css', dirname(__FILE__)); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('transitions/css/fxfullwidth.css', dirname(__FILE__)); ?>" />

<style>

  .soasl_readmore_button{

      background-color: <?php echo $data["soasl_post_content_readmorebtntxtbgcolor"]; ?>;

      border-radius: 2px;

  }

  .soasl_readmore_button a{

      color: <?php echo $data["soasl_post_content_readmorebtntxtcolor"]; ?> !important;

      font-family: <?php echo $data["soasl_post_content_readmorebtnfont"]; ?>;

      font-size: <?php echo $data["soasl_post_content_readmorebtnfontsize"]; ?>;

  }

  .soaslSideNavPrev{

    background-image: url("<?php echo plugins_url('imgs/slidenavs/previous'.$data["soasl_post_styling_navigation_button"].'.png', realpath(dirname(__FILE__).'/.')); ?>");

  }

  .soaslSideNavNext{

    background-image: url("<?php echo plugins_url('imgs/slidenavs/next'.$data["soasl_post_styling_navigation_button"].'.png', realpath(dirname(__FILE__).'/.')); ?>");

  }

 

  .soasl_contents h1 a{

    color: <?php echo $data["soasl_post_content_color_title"]; ?> !important;

    font-family: "<?php echo $data["soasl_post_content_font_title"]; ?>";

    font-size: <?php echo $data["soasl_post_content_size_title"]; ?>px;

    font-weight: 700;

  }

  .soasl_contents p{

    color: <?php echo $data["soasl_post_content_color_content"]; ?>;

    font-family: "<?php echo $data["soasl_post_content_font_content"]; ?>";

    font-size: <?php echo $data["soasl_post_content_size_content"]; ?>px;

   

  }

  .fxSnapIn li::after {

    background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;

  }

  .fxLetMeIn li::after {

    background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;  

  }

  .fxArchiveMe li::before,

  .fxArchiveMe li::after {

    background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;  

  }

  .fxEarthquake li::after {

    background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;  

  }

  .fxCliffDiving li::after {

    background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;  

  }

  /*Commerce Buttons Start Styling*/
  
   .soaslheaderbg{

    background-color: <?php echo $data["soasl_post_content_color_titlebg"]; ?>;

   }
</style>


  <div id="soasl_ultimate_container" style="background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>; width: <?php echo ($data["soasl_post_styling_slider_full_width"] == 'true') ? '100%' : $data["soasl_post_styling_slider_width"].'px'; ?>;">
      <section>

        <div id="component" class="component component-fullwidth <?php echo $data["soasl_post_type_slide_effect"]; ?>">

          <div id="soaslLoader" style="display: none;background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;"><img id="soaslLoader2" src="<?php echo plugin_dir_url(__FILE__);?>/img/loader2.gif" alt=""></div>

          <ul class="itemwrap">

            <li class="current">

              <div class="container-fluid">
        
                <div class="row">
                
                  <div class="col-xs-10 col-xs-offset-1 col-lg-4 col-md-4 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $imgposition; ?> soasl_slider_thumbnail">

                      <div id="soasl_main_img_1"></div>

                  </div>


                <div class="clearfix visible-sm-block"></div>

                <div class="col-xs-10 col-xs-offset-1 col-lg-5 col-md-5 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $contentposition; ?> soasl_contents">                  

                  <h1 class="soaslheaderbg"><a href="#" class="soasl_post_url_1"></a></h1>

                  <p id="soasl_post_content_1"></p>

                  <div id="soasl_buttons_container_1">

            
                  <?php if($data["soasl_post_content_readmorebtn"] == "true"){  ?>

                    <div class="soasl_readmore_button">

                      <a id="soasl_readmore_button_1" class="soasl_post_url_1" href="#"><?php echo $data["soasl_post_content_readmore_txt"]; ?></a>

                    </div>

                  <?php } ?>

                

                  </div>

                  </div>

                </div>

              </div>

            </li>

            <li>

              <div class="container-fluid">

                <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-lg-4 col-md-4 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $imgposition; ?> soasl_slider_thumbnail">

                    <div id="soasl_main_img_2"></div>

                </div>

                  <!-- clearfix for only the required viewport -->

                <div class="clearfix visible-sm-block"></div>

                <div class="col-xs-10 col-xs-offset-1 col-lg-5 col-md-5 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $contentposition; ?> soasl_contents">                  

                  <h1 class="soaslheaderbg"><a href="#" class="soasl_post_url_2"></a></h1>

                  <p id="soasl_post_content_2"></p>

                  <div id="soasl_buttons_container_2">

                  <?php if($data["soasl_post_content_readmorebtn"] == "true"){  ?>

                    <div class="soasl_readmore_button">

                      <a id="soasl_readmore_button_2"  class="soasl_post_url_2" href="#"><?php echo $data["soasl_post_content_readmore_txt"]; ?></a>

                    </div>

                  <?php } ?>

              

                </div>

                </div>

                </div>

              </div>

            </li>

            <li>

              <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-lg-4 col-md-4 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $imgposition; ?> soasl_slider_thumbnail">

          

                <div id="soasl_main_img_3"></div>


                </div>

                  <!-- clearfix for only the required viewport -->

                <div class="clearfix visible-sm-block"></div>

            <div class="col-xs-10 col-xs-offset-1 col-lg-5 col-md-5 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $contentposition; ?> soasl_contents">              

              <h1 class="soaslheaderbg"><a href="#" class="soasl_post_url_3"></a></h1>

              <p id="soasl_post_content_3"></p>

              <div id="soasl_buttons_container_3">

              <?php if($data["soasl_post_content_readmorebtn"] == "true"){  ?>

                    <div class="soasl_readmore_button">

                      <a id="soasl_readmore_button_3"  class="soasl_post_url_3" href="#"><?php echo $data["soasl_post_content_readmore_txt"]; ?></a>

                    </div>

              <?php } ?>


            </div>

            </div>    

              </div>

            </li>

          </ul>
        </div>
    
    
        
        

        <div id="soasl_nav_side">

          <div class="soaslSideNavPrev" id="soaslPrev"></div>

          <div class="soaslSideNavNext" id="soaslNext"></div>

        </div>
      </section>

  </div><!-- /container -->

<scrip src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>