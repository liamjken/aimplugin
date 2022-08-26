<?php
   /*
   Plugin Name: AIM Experts Intergration
   Plugin URI: https://aimexperts.com
   description: Legacy plugin that helps add the aim features to a wordpress website. connected to local drive
   Version: 1.0.1
   Author: Liam Kennedy
   Author URI: https://aimexperts.com
   License: GPL2
   */

	
add_action('admin_menu', 'aim_integration_setup_menu');
 
function aim_integration_setup_menu(){
    add_menu_page( 'AIM Short Code', 'AIM Integration', 'manage_options', 'aim-shortcode', 'shortcode_aim' );
    add_submenu_page('aim-shortcode', 'AIM Short Code', 'AIM Short Code', 'manage_options', 'aim-shortcode' );
    
}






function shortcode_aim() {

	ob_start();
	?> 



    <img src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-experts-logo.png'; ?>">

    <h1>The easiest way to intergrate AIM with your WordPress site    </h1>


    <p>Just add some simple shortcode to your VDP and Listing pages<p>
    <p>Add this shortcode to your VDP page.  <p>
        <pre>[aim-buttons-static]</pre>
<p>If adding code to template file use the following code</p>
<pre>&lt;?php echo do_shortcode("[aim-buttons-static]"); ?&gt;</pre> 
<p>for floating buttons add the following code to template file.</p>
    <pre>&lt;?php echo do_shortcode("[aim-buttons-float]"); ?&gt;</pre> 
<p>To add just VSA and calculator buttons to the vdp use the following short code</p>
<pre>[aim-buttons-vdp]</pre>
<p>or use this code within the template file</p>
    <pre>&lt;?php echo do_shortcode("[aim-buttons-vdp]"); ?&gt;</pre>
<p>Add this shortcode to your VLP page.  <p>
<pre>[aim-buttons-listing]</pre>
<p>If adding code to template file use the following code</p>
<pre>&lt;?php echo do_shortcode("[aim-buttons-listing]"); ?&gt;</pre>
                
     <?php
	echo ob_get_clean();
}



add_action('wp_enqueue_scripts', 'plugin_styles');

function plugin_styles() {
    wp_enqueue_style('AimPluginStyles', plugins_url('/css/style.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'plugin_scripts');

function plugin_scripts() {
	wp_enqueue_script('AimPluginScripts', plugins_url('/js/script.js', __FILE__), array('jquery'), false, true);
}


function aimDealerName_function() {
 $content .= 'Rainbow Ford Sales';
    
    return $content;
}

add_shortcode('aimDealerName', 'aimDealerName_function');  

function aimDealerAddress_function() {
 $content .= 'P.O Box 1228, 4312 - 42nd Avenue, Rocky Mountain House AB T4T 1A9';
    
    return $content;
}

add_shortcode('aimDealerAddress', 'aimDealerAddress_function');

function aimDealerCity_function() {
 $content .= 'Rocky Mountain House';
    
    return $content;
}

add_shortcode('aimDealerCity', 'aimDealerCity_function');


function aimDealerBrand_function() {
 $content .= 'Ford';
    
    return $content;
}

add_shortcode('aimDealerBrand', 'aimDealerBrand_function');

function aimDealerID_function() {
 $content .= 27562;
    
    return $content;
}

add_shortcode('aimDealerID', 'aimDealerID_function');

function aimDealerPhone_function() {
 $content .= '403-845-3673';
    
    return $content;
}

add_shortcode('aimDealerPhone', 'aimDealerPhone_function');




function aimbuynow_function() {
     $qstring = $_SERVER['QUERY_STRING'];
 $content .= '<iframe style="min-height:1260px; width:100%;" src="https://deal-proposal.com/apps/deal_proposal/make_your_deal.html?vin='.$qstring.'&dealer_id=<?php echo do_shortcode("[aimDealerID]"); ?>" width="100%" height="100%">
</iframe>';
    
    return $content;
}

add_shortcode('aim-buynow', 'aimbuynow_function');  


function aim_listings_buttons_function() {
    $vin_num = get_post_meta(get_the_id(), 'vin_number', true);
    $car_fax_link = get_post_meta(get_the_ID(), 'car_fax_link', true);
	ob_start();
	?> 
                <a class="vsa-active" href="/virtual-sales-assistant/?<?php echo esc_attr($vin_num); ?>" target=_deal><img src="<?php echo plugin_dir_url( __FILE__ ) . '/img/CTA_With_Negotiate.gif'; ?>" style="margin-top: 10px; width:100%;"></a>

<?php if(!empty($car_fax_link)) { ?>	
             <a style="color:#000000;" href="<?php echo $car_fax_link; ?>" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ ) . '/img/carfax-logo.png'; ?>"></a>
            <?php } ?>

<?php
	return ob_get_clean();
}

add_shortcode('aim-buttons-listing', 'aim_listings_buttons_function'); 

function aim_vdp_buttons_function() {
    $vin_num = get_post_meta(get_the_id(), 'vin_number', true);
	ob_start();
	?> 
<div class="vsa-active" id="aim_lease_calculator"  vin="<?php echo esc_attr($vin_num); ?>"
             widget_background="002d69"
             apply_boostrap="0" open_in_window="0" ></div>
<script src="https://automediaservices.com/apps/calculator/lease_calculator.js" type="text/javascript"></script>
                
<script src="https://automediaservices.com/apps/calculatorPro/myjs/widget.js" type="text/javascript"></script>
<div class="aim_deal_sheet_app vsa-active" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>">
<button class="vsa-modal" onclick="aim_deal_sheet_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>'})"></button>
</div> 

<?php
	return ob_get_clean();
}

add_shortcode('aim-buttons-vdp', 'aim_vdp_buttons_function'); 

function aim_buttonss_static_function() {
    $vin_num = get_post_meta(get_the_id(), 'vin_number', true);
    $window_sticker = get_post_meta(get_the_id(), 'window_sticker', true);
    $car_fax_link = get_post_meta(get_the_ID(), 'car_fax_link', true);
	ob_start();
	?>
<div class="vsa-active" id="aim_lease_calculator"  vin="<?php echo esc_attr($vin_num); ?>"
             widget_background="002d69"
             apply_boostrap="0" open_in_window="0" ></div>
<script src="https://automediaservices.com/apps/calculator/lease_calculator.js" type="text/javascript"></script>

<script src="https://automediaservices.com/apps/calculatorPro/myjs/widget.js" type="text/javascript"></script>
<div class="aim_deal_sheet_app vsa-active" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>">
<button class="vsa-modal" onclick="aim_deal_sheet_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>'})"></button>
</div>

<script src="https://automediaservices.com/apps/deal_widgets/deposit/js/widget.js"type="text/javascript"></script>
<div class="aim_deal_deposit_app vsa-active" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>" >
<button class="reserve-now aim-button" onclick="aim_deal_deposit_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>',deposit:49})"></button></div>

<script src="https://automediaservices.com/apps/deal_widgets/credit/js/widget.js" type="text/javascript"></script>
<div class="aim_deal_credit_app vsa-active"></div>
<button class="credit-apply-aim aim-button" onclick="aim_deal_apply_credit_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>})"></button>

<script src="https://automediaservices.com/apps/test_drive/js/widget.js"type="text/javascript"></script>
<div class="aim_deal_test_drive_app vsa-active"  dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>" >
<button class="test-drive aim-button" style="background: url(https://aimexperts.com/deal-sheet-images/Test-Drive.png); background-repeat: no-repeat; " onclick="aim_deal_test_drive_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>'})"></button></div>

<div class="aim_deal_sheet_app vsa-active" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>">
<button class="value-trade-aim aim-button"  onclick="window.open('/virtual-sales-assistant/?<?php echo esc_attr($vin_num); ?>')"></button>
</div>

<div class="aim_deal_sheet_app vsa-active" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>">
<button class="make-offer-aim aim-button"  onclick="window.open('/virtual-sales-assistant/?<?php echo esc_attr($vin_num); ?>')"></button>
</div>

<script src="https://automediaservices.com/apps/deal_widgets/google_review/js/widget.js"type="text/javascript"></script>
<div class="aim_deal_google_review_app vsa-active" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>"></div>
<button class="aim-g-review aim-button" onclick="aim_deal_google_review_widget.show_widget_dialog()"></button>

<button class="aim-window-sticker" onclick="window.open('<?php echo esc_attr($window_sticker); ?>')"></button>

<div id="aim_lease_calculator vsa-active"  vin="<?php echo esc_attr($vin_num); ?>"
             widget_background="bf172e"
             apply_boostrap="0" open_in_window="0" ></div>
<script src="https://automediaservices.com/apps/calculator/lease_calculator.js" type="text/javascript"></script>

<?php if(!empty($car_fax_link)) { ?>	
             <a style="color:#000000;" href="<?php echo $car_fax_link; ?>" target="_blank"><img src="<?php echo plugin_dir_url( __FILE__ ) . '/img/carfax-logo.png'; ?>"></a>
            <?php } ?>

<?php
	return ob_get_clean();
}

add_shortcode('aim-buttons-static', 'aim_buttonss_static_function');

function aim_buttons_float_function() {
    $vin_num = get_post_meta(get_the_id(), 'vin_number', true);
	ob_start();
	?> 


<div class="aim-floating-btns vsa-active">
    
     <div class="aim-btn-box">
         <script src="https://automediaservices.com/apps/deal_widgets/deposit/js/widget.js"type="text/javascript"></script>
<div class="aim_deal_deposit_app" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>" >         
<button class="reserve-button" onclick="aim_deal_deposit_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>',deposit:49})">
    
    <table class="aim-btn-table">
  <tr>
    <td width="40px;"><img width="40px;" height="40px;" src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-clock.png'; ?>"></td>
      <td width="10px;"></td>
    <td width="146px;" class="aim-btn-text">RESERVE <br/>VEHICLE NOW</td>
  </tr>
</table>

    </button></div>

<script src="https://automediaservices.com/apps/deal_widgets/credit/js/widget.js" type="text/javascript"></script>
<div class="aim_deal_credit_app">
<button class="credit-button" onclick="aim_deal_apply_credit_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>})">
    
    <table class="aim-btn-table">
  <tr>
    <td width="40px;"><img style="position: relative;left: 3px;" width="40px;" height="40px;" src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-credit-card.png'; ?>"></td>
      <td width="20px;"></td>
    <td width="146px;" class="aim-btn-text">APPLY FOR<br/> CREDIT</td>
  </tr>
</table>

</button></div>

<script src="https://automediaservices.com/apps/test_drive/js/widget.js"type="text/javascript"></script>
<div class="aim_deal_test_drive_app"  dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>" >         
<button class="btest-drive-button" onclick="aim_deal_test_drive_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>'})">
    
    <table class="aim-btn-table">
  <tr>
    <td width="40px;"><img style="position: relative;left: 3px;" width="40px;" height="40px;" src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-wheel.png'; ?>"></td>
      <td width="20px;"></td>
    <td width="146px;" class="aim-btn-text">BOOK A<br/> TEST DRIVE</td>
  </tr>
</table>

    </button></div>
        
        <script src="https://automediaservices.com/apps/calculatorPro/myjs/widget.js" type="text/javascript"></script>
<div class="aim_deal_sheet_app" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>">
         <button class="vtrade-button" onclick="aim_deal_sheet_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>'})">
    
    <table class="aim-btn-table">
  <tr>
    <td width="40px;"><img style="position: relative;left: 3px;" width="40px;" height="40px;" src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-keys.png'; ?>"></td>
      <td width="20px;"></td>
    <td width="146px;" class="aim-btn-text">VALUE MY<br/> TRADE-IN</td>
  </tr>
</table>

    </button></div>
        

<div class="aim_deal_sheet_app" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>" vin="<?php echo esc_attr($vin_num); ?>">
         <button class="moffer-button" onclick="aim_deal_sheet_widget.show_widget_dialog({dealer_id:<?php echo do_shortcode("[aimDealerID]"); ?>,vin:'<?php echo esc_attr($vin_num); ?>'})">
    
    <table class="aim-btn-table">
  <tr>
    <td width="40px;"><img style="position: relative;left: 3px;" width="40px;" height="40px;" src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-hand.png'; ?>"></td>
      <td width="20px;"></td>
    <td width="146px;" class="aim-btn-text">MAKE AN<br/> OFFER</td>
  </tr>
</table>

    </button></div>
        <script src="https://automediaservices.com/apps/deal_widgets/google_review/js/widget.js"type="text/javascript"></script>
<div class="aim_deal_google_review_app" dealer_id="<?php echo do_shortcode("[aimDealerID]"); ?>">
        <button class="greview-button" onclick="aim_deal_google_review_widget.show_widget_dialog()">
    
    <table class="aim-btn-table">
  <tr>
    <td width="40px;"><img style="position: relative;left: 3px;" width="40px;" height="40px;" src="<?php echo plugin_dir_url( __FILE__ ) . '/img/aim-google.png'; ?>"></td>
      <td width="20px;"></td>
    <td width="146px;" class="aim-btn-text">GOOGLE<br/> REVIEWS</td>
  </tr>
</table>

</button></div>
        
    
    </div>
    
    </div>
<?php
	return ob_get_clean();
}

add_shortcode('aim-buttons-float', 'aim_buttons_float_function'); 


register_activation_hook( __FILE__, 'myplugin_activate' );
    function myplugin_activate() {
   //create a variable to specify the details of page

       $post = array(     
                 'post_content'   => '[aim-buynow]', //content of page
                 'post_title'     =>'Virtual Sales Assistant', //title of page
                 'post_status'    =>  'publish' , //status of page - publish or draft
                 'post_type'      =>  'page'  // type of post
);
       wp_insert_post( $post ); // creates page
    
        
        }


