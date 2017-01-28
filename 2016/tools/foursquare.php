<?php 
require_once('settings.php');
require_once('helpers.php');

// Script set up.
date_default_timezone_set('UTC');

// Four Square 
// -------------------------------------------------
DebugLog( 'FourSquare...' );
$current_time = time(); 
$num_of_requests = 0 ; 

echo '<pre>';

// Only scan this last years worth of Last.fm data. 
$year = 2016 ;
for( $month = 12 ; $month <= 12 ; $month++ ) {
	$max_days = days_in_month($year, $month ); 
	for( $day = 1 ; $day <= $max_days ; $day++) {
		if( $num_of_requests > 100 ) {
			break; 
		}

		// Create the date string. 
		$start = mktime (0,0,0, $month, $day, $year );
		$end   = mktime (0,0,0, $month, $day+1, $year );
		$datestring = sprintf('%04d-%02d-%02d', $year,$month,$day);

		// echo $datestring .'... ';

		// Check for current date. 
		if( $current_time < $end ) {
			// Don't poll todays date as we might get bad data if we listen to more songs today. 
			// echo "skipped, todays date \n";
			break; 
		}

		$url = $settings['foursquare']['url']. 'users/self/checkins?oauth_token='. $settings['foursquare']['oauth_token'] .'&v=20140322&afterTimestamp='.$start.'&beforeTimestamp='.$end ;
		$response = GetURL( $url ) ; 
		$results = json_decode($response, true); 
		$num_of_requests++; 

		echo $datestring .','. count( $results["response"]["checkins"]["items"] ) ."\n";
		
		// Update the database 
		// $results = $dbhandle->query('INSERT INTO foursquare (datestring, checkins) VALUES ( "'. $datestring .'", "'. $total .'")');
		// $results = $dbhandle->query('UPDATE foursquare SET checkins = "'. $total .'" WHERE datestring = "'. $datestring .'"; ');
		
	}
}


echo '</pre>';

?>