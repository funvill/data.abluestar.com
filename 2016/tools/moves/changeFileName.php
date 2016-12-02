<pre><?php 

function FindAndSaveAsFilename( $url ) {
	echo "Doing... ". $url ." " ; 

	$contents = file_get_contents($url); 
	$contents = utf8_encode($contents); 
	$results = json_decode($contents, true); 

	// print_r( $results ) ; 

	file_put_contents('moves_'.$results[0]["date"].'.json', $contents );

	echo "Done... ". 'moves_'.$results[0]["date"].'.json'. "\n" ; 
}

$files = scandir('.');
foreach( $files as $file  ) {
	FindAndSaveAsFilename($file);	
}


?></pre>