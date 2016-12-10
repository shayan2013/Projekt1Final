<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "Shablog";

// Datenbank erstellen
function create(){
	$sql = "CREATE DATABASE $dbname";
	if ($conn->query($sql) === TRUE) {
    	echo "Datenbank erfolgreich erstellt";
	} else {
    	echo "Error Datenbankerstellung: " . $conn->error;
	}
}

// Verbindung erstellen
function connect(){
	$conn = new mysqli($servername, $username, $password, $dbname);
	// test die Verbindung
	if ($conn->connect_error) {
    	die("Verbindungsfehler: " . $conn->connect_error);
	}
}

// tebelle erstellen
function createTable(){
	$sql = "CREATE TABLE users (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	username VARCHAR(30) NOT NULL,
	email VARCHAR(50) NOT NULL,
	kennwort VARCHAR(30) NOT NULL,
	website VARCHAR(50),
	kommentar VARCHAR(100),
	website VARCHAR(50),
	geschlecht VARCHAR(9) NOT NULL,
	reg_date TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "users Tabelle erfolgreich erstellt";
	} else {
	    echo "Error Tebelle erstellen: " . $conn->error;
	}
}

//Verbindung aufheben
function closeConn(){
	$conn->close();
}

?> 