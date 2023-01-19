<?php
function wpae_after_export( $export_id ) {

    // Retrieve export object.
    $export = new PMXE_Export_Record();
    $export->getById($export_id);
    
    // Check if "Secure Mode" is enabled in All Export > Settings.
    $is_secure_export = PMXE_Plugin::getInstance()->getOption('secure');

    // Retrieve file path when not using secure mode.
    if ( !$is_secure_export) {
        $filepath = get_attached_file($export->attch_id);

    // Retrieve file path when using secure mode.                    
    } else {
        $filepath = wp_all_export_get_absolute_path($export->options['filepath']);
    }

    // Path to the export file.
    $localfile = $filepath;

    // File name of remote file (destination file name).
    $remotefile = basename($filepath);
    
    // Remote FTP server details.
    // The 'path' is relative to the FTP user's login directory.
    $ftp = array(
        'server' => 'aim-control.com',
        'user' => 'gen_ftp',
        'pass' => 'G3Nftp!',
        'path' => '/'
    );

    // Ensure username is formatted properly
    $ftp['user'] = str_replace('@', '%40', $ftp['user']);
    
    // Ensure password is formatted properly
    $ftp['pass'] = str_replace(array('#','?','/','\\'), array('%23','%3F','%2F','%5C'), $ftp['pass']);
    
    // Remote FTP URL.
    $remoteurl = "ftp://{$ftp['user']}:{$ftp['pass']}@{$ftp['server']}{$ftp['path']}/{$remotefile}";

    // Retrieve cURL object.
    $ch = curl_init();

    // Open export file.
    $fp = fopen($localfile, "rb");
    
    // Proceed if the local file was opened.
    if ($fp) {
        
        // Provide cURL the FTP URL.
        curl_setopt($ch, CURLOPT_URL, $remoteurl);

        // Prepare cURL for uploading files.
        curl_setopt($ch, CURLOPT_UPLOAD, 1);

        // Provide the export file to cURL.
        curl_setopt($ch, CURLOPT_INFILE, $fp);

        // Provide the file size to cURL.
        curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localfile));
        
        // Start the file upload.
        curl_exec($ch);

        // If there is an error, write error number & message to PHP's error log.
        if($errno = curl_errno($ch)) {
            if (version_compare(phpversion(), '5.5.0', '>=')) {
                
                // If PHP 5.5.0 or greater is used, use newer function for cURL error message.
                $error_message = curl_strerror($errno);

            } else {

                // Otherwise, use legacy cURL error message function.
                $error_message = curl_error($ch);
            }

            // Write error to PHP log.
            error_log("cURL error ({$errno}): {$error_message}");

        }
        
        // Close the connection to remote server.
        curl_close($ch);
        
    } else {

        // If export file could not be found, write to error log.
        error_log("Could not find export file");

    }
}

add_action('pmxe_after_export', 'wpae_after_export', 10, 1);
