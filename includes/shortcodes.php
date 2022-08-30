<?php

 //Grabs blog name from the WP settings
function aimDealerName_function() {
 $dealername= esc_attr( get_bloginfo( 'name' ) );
    
    return $dealername;
}

add_shortcode('aimDealerName', 'aimDealerName_function');  


 //Grabs addresss from motors theme settings
function aimDealerAddress_function() {
  $header_address= stm_me_get_wpcfto_mod( 'header_address', 'No address entered' );
    
    return $header_address;
}

add_shortcode('aimDealerAddress', 'aimDealerAddress_function');

 //Grabs phone number from motors theme settings
function aimDealerPhone_function() {
    $content = stm_me_get_wpcfto_mod( 'header_main_phone', 'no number entered' );
       
       return $content;
   }
   
   add_shortcode('aimDealerPhone', 'aimDealerPhone_function');
   

 //Grabs dealer city name plugin settings admin form
function aimDealerCity_function() {
 $content = esc_attr( get_option('dealer_city') );
    
    return $content;
}

add_shortcode('aimDealerCity', 'aimDealerCity_function');

 //Grabs dealer brand name plugin settings admin form
function aimDealerBrand_function() {
 $content= esc_attr( get_option('dealer_brand') );
    
    return $content;
}

add_shortcode('aimDealerBrand', 'aimDealerBrand_function');


 //Grabs AIM dealer ID name plugin settings admin form
function aimDealerID_function() {
 $content= 	esc_attr( get_option('aim_dealer_id') );
    
    return $content;
}

add_shortcode('aimDealerID', 'aimDealerID_function');