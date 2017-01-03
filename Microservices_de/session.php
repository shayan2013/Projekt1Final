<?php

	session_start();

	function sessionWelcome($welcome){
		$_SESSION["welcome"] = $welcome;
	}
	
	function sessionSetName($uname){
		$_SESSION["uname"] = $uname;
	}
	
	function sessionSetId($id) {
		$_SESSION["id"] = $id;
	}
	
	function sessionPrint(){
		print_r($_SESSION);
	}
	
	function sessionDestroy(){
		session_destroy();
	}
	
	function sessionUnset($unset){
		unset($_SESSION[$unset]);
	}
?>