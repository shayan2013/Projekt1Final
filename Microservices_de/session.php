<?php

	session_start();
	
	function sessionWelcome($welcome){
		$_SESSION["welcome"] = $welcome;
	}
	
	function sessionSetName($uname){
		$_SESSION["uname"] = $uname;
	}
	
	function sessionPrint(){
		print_r($_SESSION);
	}
	
	function sessionDestroy(){
		session_unset();
		session_destroy();
	}
?>