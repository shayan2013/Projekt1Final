<?php
	function headi(){
		echo "<h1>ShaBlog</h1>";
		getDateTime(); 
	}

	function footi(){
		echo "&copy;2016-" . date("Y") . " -Projekt1";		
	}

?>
<?php 
	function getDateTime(){
		echo "Today is " .date("Y/m/d");
		echo "<br> The time is " .date("h:i") ."<br><br>";
	}
?>