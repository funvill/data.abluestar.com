<html>
<body>
<script>
/*
function sleepFor( sleepDuration ){
    var now = new Date().getTime();
    while(new Date().getTime() < now + sleepDuration){ } 
}

(function() {
	var myLinks = document.getElementsByTagName("a");
	for (var i = 0; i < myLinks.length; i++) {
	  myLinks[i].click();
	  sleepFor(100);
	}
})();
*/
// https://code.google.com/p/chromium/issues/detail?id=373182
/*
function DownloadWithFileName (sUrl, fileName) {
	window.URL = window.URL || window.webkitURL;

	var xhr = new XMLHttpRequest();
	xhr.open('GET', sUrl, true);
	xhr.responseType = 'blob';

	xhr.onload = function(e) {
		var res = xhr.response;               
		var blob = new Blob([res], {type:"application/json"});

		url = window.URL.createObjectURL(blob);
		var a = document.createElement("a");
		document.body.appendChild(a);
		a.style = "display: none";
		a.href = url;
		a.download = fileName.replace(/\./g,'')+'.json';
		a.click();
		window.URL.revokeObjectURL(url);
	};
	xhr.send(); 
}
*/

function DownloadWithFileName(uri, name) {
    var link = document.createElement('a');
    link.href = uri;
    link.innerHTML = name ; 
    link.setAttribute('download', name);
    document.body.appendChild(link);
    link.click();
    // document.body.removeChild(a);
}


(function() {
<?php 

require_once('settings.php');
require_once('helpers.php');

$iteration = 0 ; 

/** 
 * It appears that I can download 30 at a time. 
 */ 
$startIteration = 0 ;
$maxIteration = 35 ; 

$year = 2016 ; 
for( $month = 12 ; $month <= 12 ; $month++ ) {
	$max_days = days_in_month($year, $month ); 
	for( $day = 1 ; $day <= $max_days ; $day++) {
		$iteration++;
		if( $iteration < $startIteration ) {
			continue; 
		}
		if( $iteration >= $startIteration+$maxIteration ) {
			break ; 
		}
		 

		$downloadDate = $year;
		if( $month < 10 ) {
			$downloadDate .= '0';
		}
		$downloadDate .= $month;
		if( $day < 10 ) {
			$downloadDate .= '0';
		}
		$downloadDate .= $day;

		echo 'DownloadWithFileName( "http://www.moves-export.com/jsonstoryline?startdate='. $downloadDate .'", "moves_'.$downloadDate.'.json");'."\n";
	}
}
?>


})();

</script>

</body>
</html>
