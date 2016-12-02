<?php 
require_once('settings.php');
require_once('helpers.php');

// Script set up.
date_default_timezone_set('UTC');


// Last FM
// -------------------------------------------------
DebugLog( 'LastFM...' );
$current_time = time(); 
$num_of_requests = 0 ; 

echo '<pre>';
// Only scan this last years worth of Last.fm data. 
$year = 2016 ; 
for( $month = 1 ; $month <= 12 ; $month++ ) {
	$max_days = days_in_month($year, $month ); 
	for( $day = 1 ; $day <= $max_days ; $day++) {
		if( $num_of_requests > 400 ) {
			break; 
		}

		// Create the date string. 
		$start = mktime (0,0,0, $month, $day, $year );
		$end   = mktime (0,0,0, $month, $day+1, $year );
		$datestring = sprintf('%04d-%02d-%02d', $year,$month,$day);

		// echo $datestring .'= ';
		$url = $settings['lastfm']['url'].'?method=user.getrecenttracks&user='.$settings['lastfm']['user'] .'&api_key='. $settings['lastfm']['api_key'] .'&format=json&from='.$start.'&to='.$end.'&extended=0&limit=1';
		$response = GetURL( $url ) ; 
		$results = json_decode($response, true); 
		$num_of_requests++; 

		// Check to see if we recived an error. If we do then use the total of zero as a value. 
		$total = 0 ; 
		if( isset( $results['recenttracks']['@attr']['total'] ) ) {
			$total = $results['recenttracks']['@attr']['total'] ; 
		}

		// Update the database 
		// $results = $dbhandle->query('INSERT INTO last_fm (datestring, total) VALUES ( "'. $datestring .'", "'. $total .'")');
		echo $datestring . ",". $total . "\n"; 
	}
}

echo '</pre>';

?>