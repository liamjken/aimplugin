<?php 

add_action('admin_menu', 'av_plugin_create_menu');

  
function av_plugin_create_menu() {

  //create new top-level menu
  add_menu_page('AV Plugin Settings', 'AV Settings', 'administrator', __FILE__, 'av_plugin_settings_page' , plugins_url('/img/av-icon.png', __DIR__), );
  add_submenu_page(__FILE__, 'AV Shortcode', 'AV Shortcode', 'manage_options', __FILE__.'/custom', 'shortcode_av');


  //call register settings function
  add_action( 'admin_init', 'register_av_plugin_settings' );
}

function register_av_plugin_settings() {
  //register our settings
  register_setting( 'av-plugin-settings-group', 'dealer_city' );
  register_setting( 'av-plugin-settings-group', 'dealer_brand' );
  register_setting( 'av-plugin-settings-group', 'aim_dealer_id' );
  register_setting( 'av-plugin-settings-group', 'av_sdk_url' );
  register_setting( 'av-plugin-settings-group', 'av_slack_url' );
  register_setting( 'av-plugin-settings-group', 'av_import_order' );
  register_setting( 'av-plugin-settings-group', 'dealer_color' );
  register_setting( 'av-plugin-settings-group', 'dealer_secondary_color' );
  register_setting( 'av-plugin-settings-group', 'dealer_background_color' );
}


//content within the av Settings tab
function av_plugin_settings_page() {

  ob_start();
  ?> 

<div class="wrap">
<h1>av Settings</h1>

<form method="post" action="options.php">
  <?php settings_fields( 'av-plugin-settings-group' ); ?>
  <?php do_settings_sections( 'av-plugin-settings-group' ); ?>
  <table class="form-table">
      <tr valign="top">
      <th scope="row">Dealership City</th>
      <td><input type="text" name="dealer_city" value="<?php echo esc_attr( get_option('dealer_city') ); ?>" /></td>
      </tr>
       
      <tr valign="top">
      <th scope="row">Dealership Brand</th>
      <td><input type="text" name="dealer_brand" value="<?php echo esc_attr( get_option('dealer_brand') ); ?>" /></td>
      </tr>
      
      <tr valign="top">
      <th scope="row">AIM dealer ID</th>
      <td><input type="text" name="aim_dealer_id" value="<?php echo esc_attr( get_option('aim_dealer_id') ); ?>" /></td>
      </tr>
    
     <tr valign="top">
      <th scope="row">AV SDK URL</th>
      <td><input type="text" name="av_sdk_url" value="<?php echo esc_attr( get_option('av_sdk_url') ); ?>" /></td>
      </tr>

      <tr valign="top">
      <th scope="row">AV Slack Webhook URL</th>
      <td><input type="text" name="av_slack_url" value="<?php echo esc_attr( get_option('av_slack_url') ); ?>" /></td>
      </tr>

      <tr valign="top">
      <th scope="row">AV Import Order</th>
      <td><input type="text" name="av_import_order" value="<?php echo esc_attr( get_option('av_import_order') ); ?>" /></td>
      </tr>

      <tr valign="top">
      <th scope="row">Select Main Colour</th>
      <td><input type="color" id="favcolor" name="dealer_color" value="<?php echo esc_attr( get_option('dealer_color') ); ?>"></td>
      </tr>

      <tr valign="top">
      <th scope="row">Select Secondary Colour</th>
      <td><input type="color" id="favcolor" name="dealer_secondary_color" value="<?php echo esc_attr( get_option('dealer_secondary_color') ); ?>"></td>
      </tr>

      <tr valign="top">
      <th scope="row">Select Background Colour</th>
      <td><input type="color" id="favcolor" name="dealer_background_color" value="<?php echo esc_attr( get_option('dealer_background_color') ); ?>"></td>
      </tr>
  </table>
  
  <?php submit_button(); ?>

</form>
</div>
 <?php
  echo ob_get_clean();
}

//content within the av shortcode tab
function shortcode_av() {

    ob_start();
    ?> 
  
  
  
      <img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ) . '/img/av-experts-logo.png'; ?>">
  
      <h1>The easiest way to intergrate av with your WordPress site    </h1>
  
  
      <p>Just add some simple shortcode to your VDP and Listing pages<p>
      <p>Add this shortcode to your VDP page.  <p>
          <pre>[av-buttons-static]</pre>
  <p>If adding code to template file use the following code</p>
  <pre>&lt;?php echo do_shortcode("[av-buttons-static]"); ?&gt;</pre> 
  <p>for floating buttons add the following code to template file.</p>
      <pre>&lt;?php echo do_shortcode("[av-buttons-float]"); ?&gt;</pre> 
  <p>To add just VSA and calculator buttons to the vdp use the following short code</p>
  <pre>[av-buttons-vdp]</pre>
  <p>or use this code within the template file</p>
      <pre>&lt;?php echo do_shortcode("[av-buttons-vdp]"); ?&gt;</pre>
  <p>Add this shortcode to your VLP page.  <p>
  <pre>[av-buttons-listing]</pre>
  <p>If adding code to template file use the following code</p>
  <pre>&lt;?php echo do_shortcode("[av-buttons-listing]"); ?&gt;</pre>
                  
       <?php
    echo ob_get_clean();
  }
