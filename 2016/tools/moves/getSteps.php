<pre><?php 

function GetSteps( $url ) {

	$contents = file_get_contents($url); 
	$contents = utf8_encode($contents); 
	$results = json_decode($contents, true); 

	// print_r( $results ) ; 

	echo $results[0]["date"]."," ; 
	// echo $results[0]["summary"][0]["steps"] ; 
	// echo "\n";
	$total = 0 ; 
	if( isset( $results[0]["summary"] ) ) {
		foreach( $results[0]["summary"] as $summary ) {
			if( isset( $summary["steps"] ) ) {
				$total += $summary["steps"] ; 
			}
		}
	}
	echo $total.",\n";
}

$iteration = 0 ; 

$files = scandir('.');
foreach( $files as $file  ) {
	/*
	$iteration++; 
	if( $iteration < 0 || $iteration >= 100 ) {
		continue; 
	}
	*/
	GetSteps($file);	
}
// GetSteps("moves_20150101.json");
?></pre>