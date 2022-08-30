<?php add_action('wp_head', 'color_header_wp_head');
 function color_header_wp_head(){
     //Close PHP tags 
     ?>
 <?PHP
 echo '<style>';
 ?>
 
 :root {
 --aimMainColor: <?php echo esc_attr( get_option('dealer_color') ); ?>;
 --aimSecondaryColor: <?php echo esc_attr( get_option('dealer_secondary_color') ); ?>;   
 --aimBackgroundColor: <?php echo esc_attr( get_option('dealer_background_color') ); ?>;    
 
 }
 
 <?PHP
 echo '</style>';
 ?>
     <?php //Open PHP tags
 }
 