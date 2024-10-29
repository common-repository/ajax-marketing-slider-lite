<?php $data = $this->slider_data($soaslID); 
      
      if($data["soasl_post_styling_checkbox"] == "true"){
          $border ="<style>#soasl_ultimate_container{ border: ".$soasl_post_styling_border_thickness."px solid ".$soasl_post_styling_border_color."; border-radius: ".$soasl_post_styling_border_radius."px;}</style>";
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
var showGallery = '<?php if($data["soasl_commerce_show_gallery"] == "true"){ echo 'true'; } else { echo 'false'; } ?>';
var showReviews = '<?php if($data["soasl_commerce_showreviews"] == "true"){ echo 'true'; } else { echo 'false'; } ?>';
var showAds = <?php echo $data["soasl_ads_setting_radio"]; ?>; 
// var adsIds = ;
var soaslAutoSlide = "<?php echo $data['soasl_post_type_slide_auto']; ?>";
var soaslAutoSlideInterval = <?php echo ($data["soasl_post_type_slide_auto_interval"] !== "") ? $data["soasl_post_type_slide_auto_interval"] : 2000; ?>;
</script>
<?php echo $border; ?>
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('transitions/css/normalize.css', __FILE__); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('transitions/css/component.css', __FILE__); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo plugins_url('transitions/css/fxfullwidth.css', __FILE__); ?>" />
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
    background-image: url("<?php echo plugins_url('img/slidenavs/previous'.$data["soasl_post_styling_navigation_button"].'.png', __FILE__); ?>");
  }
  .soaslSideNavNext{
    background-image: url("<?php echo plugins_url('img/slidenavs/next'.$data["soasl_post_styling_navigation_button"].'.png', __FILE__); ?>");
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
    background-color: <?php echo $soasl_post_styling_colorbg; ?>;
  }
  .fxLetMeIn li::after {
    background-color: <?php echo $soasl_post_styling_colorbg; ?>;  
  }
  .fxArchiveMe li::before,
  .fxArchiveMe li::after {
    background-color: <?php echo $soasl_post_styling_colorbg; ?>;  
  }
  .fxEarthquake li::after {
    background-color: <?php echo $soasl_post_styling_colorbg; ?>;  
  }
  .fxCliffDiving li::after {
    background-color: <?php echo $soasl_post_styling_colorbg; ?>;  
  }
  /*Commerce Buttons Start Styling*/
  
  .soasl_commerce_button{
    background-color: <?php echo $data["soasl_commerce_btn_bg_color"]; ?>;
    border-radius: <?php echo $data["soasl_commerce_btn_radius"]; ?>;
  }
  .soasl_commerce_button a{
    color: <?php echo $data["soasl_commerce_btn_txt_color"]; ?> !important;
  }
  .saletagc{
    background-image: url('<?php echo $data["soasl_commerce_pricing_tags"]; ?>');
  }
 
   .soaslheaderbg{
    background-color: <?php echo $data["soasl_post_content_color_titlebg"]; ?>;
   }
  <?php if($data['soasl_commerce_pricing_mode'] == 'false'){ ?>
  .soaslsaletag{
    display: none;
  }
  <?php } ?>
  .soasl_commerce_price_tag .soaslsaleprice{
    color: <?php echo $data["soasl_commerce_color_sales_price"]; ?>;
    font-size: <?php echo $data['soasl_commerce_size_sales_price']; ?>px;
    font-family: "<?php echo $data['soasl_commerce_font_price']; ?>";
  }
  <?php if($data["soasl_commerce_color_regular_price"] !== null && $data['soasl_commerce_size_regular_price'] !== null  && $data['soasl_commerce_font_price'] !== null){?>
    .soasl_commerce_price_tag .soaslregularprice{
      color: <?php echo $data["soasl_commerce_color_regular_price"]; ?>;
      font-size: <?php echo $data['soasl_commerce_size_regular_price']; ?>px;
      font-family: "<?php echo $data['soasl_commerce_font_price']; ?>";
    }
  <?php } ?>
</style>
  <div id="soasl_ultimate_container" style="background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>; width: <?php echo ($data["soasl_post_styling_slider_full_width"] == 'true') ? '100%' : $data["soasl_post_styling_slider_width"].'px'; ?>; height: <?php echo ($data["soasl_post_styling_slider_full_height"] == 'true') ? '500px' : $data["soasl_post_styling_slider_height"].'px'; ?>;">
    <div id="loadingSliderContent" style="display: none;">
      <div id="loadingSliderContainer">
        <div id="mainSliderLoader" data-role="preloader" data-type="cycle" data-style="color">
        </div>
      </div>
    </div>
      <section>
        <div id="component" class="component component-fullwidth <?php echo $data["soasl_post_type_slide_effect"]; ?>">
          <div id="soaslLoader" style="display: none;background-color: <?php echo $data["soasl_post_styling_colorbg"]; ?>;"></div>
          
          <ul class="itemwrap">
            <li class="current">
              <div class="container-fluid">
                <div class="row">
                  <!-- I should play with lg columns and offsets to sum up 12 -->
                  <div class="col-lg-3 col-lg-offset-1">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore dignissimos dolores, sunt molestiae nesciunt officiis, et dolore assumenda nulla aliquam excepturi alias commodi ducimus, suscipit laborum, nam quae vitae pariatur?
                  </div>
                  <div class="col-lg-4 col-lg-offset-1 col-lg-push-2 soasl_slider_thumbnail">
                      <div id="soasl_main_img_1"></div>
                      <div class="row soasl_gallery_items">
                        <div class="soasl_gallery_preview">
                          <ul id="soasl_gallery_thumbs_1"></ul>
                            <div class="soasl_gal_abs_next" style="display:none;"><span>></span></div>
                            <div class="soasl_gal_abs_prev" style="display:none;"><span><</span></div>               
                        </div>
                      </div>
                  </div>
                  <!--  -->
                    <!-- <div class="col-xs-10 col-xs-offset-1 col-lg-2 col-md-4 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $imgposition; ?> soasl_slider_thumbnail">
                          <img src="http://gdj.gdj.netdna-cdn.com/wp-content/uploads/2012/04/creative-advertisements-11.jpg" alt="" />                      
                    </div> -->
                  <!--  -->
                  <!-- clearfix for only the required viewport -->
                <div class="clearfix visible-sm-block"></div>
                <div class="col-lg-3 col-lg-pull-5 soasl_contents">                  
                  <h1 class="soaslheaderbg"><a href="#" id="soasl_post_url_1"></a></h1>
                  <div class="soaslRating" id="soasl_reviews_1" data-role="rating" style="display: none;" data-size="large" data-size="small" data-static="true" data-show-score="false" data-value=""></div>
                  <p id="soasl_post_content_1"></p>
                  <?php if($data['soasl_commerce_mode'] == 'true'){ ?>
                  <div class="soasl_commerce_options_container">
                    <div class="soasl_commerce_price_tag">
                      <p>
                        <span id="soasl_sale_price_1" class="soaslsaleprice"></span>
                        <span id="soasl_commerce_regular_1" class="soaslregularprice"></span>
                      </p>
                    </div>
                    <div class="soasl_commerce_button">
                      <a id="soasl_commerce_button_1" href="#"><?php echo $data["soasl_commerce_btn_txt"]; ?></a>
                    </div>
                  </div>
                  <?php } elseif($data['soasl_commerce_mode'] !== 'true' && $data["soasl_post_content_readmorebtn"] == "true"){  ?>
                    <div class="soasl_readmore_button">
                      <a id="soasl_readmore_button_1" href="#"><?php echo $data["soasl_post_content_readmore_txt"]; ?></a>
                    </div>
                  <?php } ?>
                  <?php if($data["soasl_post_styling_social"] == "true"){ ?>
                  <!-- Go to www.addthis.com/dashboard to customize your tools -->
                  <div class="addthis_sharing_toolbox"></div>
                  <?php } ?>
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="container-fluid">
                <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-lg-4 col-md-4 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $imgposition; ?> soasl_slider_thumbnail">
                    <div id="soasl_main_img_2"></div>
                      <div class="row soasl_gallery_items">
                        <div class="soasl_gallery_preview">
                          <ul id="soasl_gallery_thumbs_2"></ul>
                            <div class="soasl_gal_abs_next" style="display:none;"><span>></span></div>
                            <div class="soasl_gal_abs_prev" style="display:none;"><span><</span></div>               
                        </div>
                      </div>
                </div>
                  <!-- clearfix for only the required viewport -->
                <div class="clearfix visible-sm-block"></div>
                <div class="col-xs-10 col-xs-offset-1 col-lg-5 col-md-5 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $contentposition; ?> soasl_contents">                  
                  <h1 class="soaslheaderbg"><a href="#" id="soasl_post_url_2"></a></h1>
                  <div class="soaslRating" id="soasl_reviews_2" data-role="rating" style="display: none;" data-size="large" data-size="small" data-static="true" data-show-score="false" data-value=""></div>
                  <p id="soasl_post_content_2"></p>
                  <?php if($data['soasl_commerce_mode'] == 'true'){ ?>
                  <div class="soasl_commerce_price_tag">
                    <p>
                    <span id="soasl_sale_price_2" class="soaslsaleprice"></span>
                    <span id="soasl_commerce_regular_2" class="soaslregularprice"></span>
                    </p>
                  </div>
                  <div class="soasl_commerce_button">
                  <a id="soasl_commerce_button_2" href="#"><?php echo $data["soasl_commerce_btn_txt"]; ?></a>
                  </div>
                  
                  <?php } if($data['soasl_commerce_mode'] !== 'true' && $data["soasl_post_content_readmorebtn"] == "true"){  ?>
                    <div class="soasl_readmore_button">
                      <a id="soasl_readmore_button_2" href="#"><?php echo $data["soasl_post_content_readmore_txt"]; ?></a>
                    </div>
                  <?php } ?>
                  <?php if($data["soasl_post_styling_social"] == "true"){ ?>
                  <!-- Go to www.addthis.com/dashboard to customize your tools -->
                  <div class="addthis_sharing_toolbox"></div>
                  <?php } ?>
                </div>
                </div>
              </div>
            </li>
            <li>
              <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-lg-4 col-md-4 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $imgposition; ?> soasl_slider_thumbnail">
                <!-- <div data-role="preloader" data-type="ring" data-style="dark" style="display:none;" id="soasl_loader_preloader"></div> -->
                <div id="soasl_main_img_3"></div>
                <div class="row soasl_gallery_items">
                        <div class="soasl_gallery_preview">
                          <ul id="soasl_gallery_thumbs_3"></ul>
                            <div class="soasl_gal_abs_next" style="display:none;"><span>></span></div>
                            <div class="soasl_gal_abs_prev" style="display:none;"><span><</span></div>               
                        </div>
                      </div>
                </div>
                  <!-- clearfix for only the required viewport -->
                <div class="clearfix visible-sm-block"></div>
            <div class="col-xs-10 col-xs-offset-1 col-lg-5 col-md-5 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 <?php echo $contentposition; ?> soasl_contents">              
              <h1 class="soaslheaderbg"><a href="#" id="soasl_post_url_3"></a></h1>
              <div class="soaslRating" id="soasl_reviews_3" data-role="rating" style="display: none;" data-size="large" data-size="small" data-static="true" data-show-score="false" data-value=""></div>
              <p id="soasl_post_content_3"></p>
              <?php if($data['soasl_commerce_mode'] == 'true'){ ?>
                <div class="soasl_commerce_price_tag">
                  <p>
                    <span id="soasl_sale_price_3" class="soaslsaleprice"></span>
                    <span id="soasl_commerce_regular_3" class="soaslregularprice" ></span>
                  </p>
                </div>
                <div class="soasl_commerce_button">
                <a id="soasl_commerce_button_3" href="#"><?php echo $data["soasl_commerce_btn_txt"]; ?></a>
                </div>
              
              <?php } if($data['soasl_commerce_mode'] !== 'true' && $data["soasl_post_content_readmorebtn"] == "true"){  ?>
                    <div class="soasl_readmore_button">
                      <a id="soasl_readmore_button_3" href="#"><?php echo $data["soasl_post_content_readmore_txt"]; ?></a>
                    </div>
              <?php } ?>
              <?php if($data["soasl_post_styling_social"] == "true"){ ?>
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_sharing_toolbox"></div>
              <?php } ?>
            </div>    
              </div>
            </li>
          </ul>

        </div>
        <?php if($data["soasl_post_styling_disable_img_arrow"] == 'true'){ ?>
          <div id="soasl_nav_side">
            <div class="soaslSideNavPrevTxt" id="soaslPrev"><span><a href="#"><?php echo $data["soasl_post_styling_nav_prev_text"]; ?></a></span></div>
            <div class="soaslSideNavNextTxt" id="soaslNext"><span><a href="#"><?php echo $data["soasl_post_styling_nav_next_text"]; ?></a></span></div>
          </div>
          <?php } else { ?>
        <div id="soasl_nav_side">
          <div class="soaslSideNavPrev" id="soaslPrev"></div>
          <div class="soaslSideNavNext" id="soaslNext"></div>
        </div>
        <?php } ?>

      </section>
  </div><!-- /container -->
<scrip src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56cbf9c111f65f5e"></script>