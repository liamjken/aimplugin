<?php

function wpai_send_email($import_id)
{

    
    // Retrieve the last import run stats.
    global $wpdb;
    $table = $wpdb->prefix . "pmxi_imports";
    $dealername= esc_attr( get_bloginfo( 'name' ) );

    if ( $soflyyrow = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `" . $table . "` WHERE `id` = '%d'", $import_id ) ) ) {
        
        $count = $soflyyrow->count;
        $imported = $soflyyrow->imported;
        $created = $soflyyrow->created;
        $updated = $soflyyrow->updated;
        $skipped = $soflyyrow->skipped;
        $deleted = $soflyyrow->deleted;

    }
    
    // Destination email address.
    $to = 'lkennedy@autoverify.com';

    // Email subject.
    $subject = ''.$dealername.'Import Update';
    date_default_timezone_set('US/Eastern');

    // Email message.
    $body = '<p>***This email is autoamted to confirm the daily Import has completed***</p> <p>'.$dealername.' Inventory Import ID: '.$import_id.' has completed at '. date("h:i:s A l jS \of F Y "). "\r\n" .'</p>'. '<p><strong>Number of Vehicles in Import:</strong>' .$count."\r\n".'</p>'.'<p><strong>Vehicles Imported:</strong>'.$imported."\r\n".'</p>'.'<p><strong>New vehicles Added:</strong>'.$created.'</p>';
    $body .= "\r\n" . '<p><strong>Vehicles Updated:</strong>'. $updated . "\r\n" .'</p>'. '<p><strong>Vehicles Not requiring update:</strong>' . $skipped . "\r\n" .'</p>'. '<p><strong>Vehicles Deleted:</strong>' . $deleted.'</p>';


    // Send the email as HTML.
    $headers = array('Content-Type: text/html; charset=UTF-8');
 
    // Send via WordPress email.
    wp_mail( $to, $subject, $body, $headers );

    

}

add_action('pmxi_after_xml_import', 'wpai_send_email', 10, 1);


function my_send_slack_notification( $import_id ) {

    // Retrieve the last import run stats.
    global $wpdb;
    $table = $wpdb->prefix . "pmxi_imports";
    $dealername= esc_attr( get_bloginfo( 'name' ) );
    $avimportorder= esc_attr( get_option('av_import_order') );
    

    if ( $soflyyrow = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM `" . $table . "` WHERE `id` = '%d'", $import_id ) ) ) {
        

        $count = $soflyyrow->count;
        $imported = $soflyyrow->imported;
        $created = $soflyyrow->created;
        $updated = $soflyyrow->updated;
        $skipped = $soflyyrow->skipped;
        $deleted = $soflyyrow->deleted;
    }

    $api_url = esc_attr( get_option('av_slack_url') );
    $notification_text = ''.$avimportorder. ' '  . $dealername . ' Import ID '.$import_id.' has been Complete. 
    Vehicles imported: ' . $imported . ' 
    Vehicles Updated: '.$updated.' 
    Vehicles Skipped: '.$skipped.'
    Vehicles Created: '.$created.'
    Vehicles deleted: '.$deleted.'
    '; ;
    $body = [
        'text' => $notification_text
    ];
    $body = wp_json_encode( $body );
    wp_remote_post( $api_url,
        [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $body
        ]
    );
}

add_action('pmxi_after_xml_import', 'my_send_slack_notification', 10, 1);


