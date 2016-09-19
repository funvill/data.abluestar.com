<?php 

// Helper functions 
function DebugLog( $message ) {
	global $settings;
	if( $settings['debug'] ) { 
		echo $message ."\n"; 
	}
}


function GetURL($url) {
	global $settings;

	// DebugLog( $url );

	if( ! function_exists("curl_init")   || 
		! function_exists("curl_setopt") || 
		! function_exists("curl_exec")   || 
		! function_exists("curl_close") ) 
	{
		echo "Error: cURL Basic Functions UNAVAILABLE" ; 
		return false ; 
	}

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 				$url);
    curl_setopt($ch, CURLOPT_USERAGENT, 		$settings['useragent']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 	1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 	FALSE);    
    // curl_setopt($ch, CURLOPT_HEADER, 			false);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 	true);
    // curl_setopt($ch, CURLOPT_REFERER, 			$url);
    $result = curl_exec($ch);
    if( ! $result ) {
    	echo 'Curl error: ' . curl_error($ch);
    	curl_close($ch);
    	return false; 
    }
    curl_close($ch);

	// Save the contents of the file to disk for debug
	// file_put_contents( 'request.json', $result ); 
	
	// return the results. 
	return $result ; 
}

function days_in_month($year, $month) { 
    return( date( "t", mktime( 0, 0, 0, $month, 1, $year) ) ); 
}

?>