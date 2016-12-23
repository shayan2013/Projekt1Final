<?php
function readData(){
	$dateihandle = fopen("Dokumentation/Datensicherung.txt","r");
	while(!feof($dateihandle)) {
		$zeile = fgets($dateihandle, 4096);
		echo $zeile . "<br>";
	}
	fclose($dateihandle);	
}

function writeData($txt) {
	$myfile = fopen("Dokumentation/Datensicherung.txt", "a+") or die("Unable to open file!");
	fwrite($myfile, "\r\n" . $txt);
	fclose($myfile);
}
?>