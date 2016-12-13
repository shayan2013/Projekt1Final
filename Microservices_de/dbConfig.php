<?php
$servername = "localhost";
$username = "root";
$password = "YZmAfDpGyAUY3ax3";
$dbname = "Shablog";

// Datenbank erstellen
function create(){
	// MySQL Verbindung
	$link = mysql_connect('localhost', $username, $password);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	// Make my_db the current database
	$db_selected = mysql_select_db($dbname, $link);
	if (!$db_selected) {
	  // Wenn Db nicht ausgewaehlt wwerden kann dann existiert sie  entweder nicht oder wir koennen es nicht sehen 
	  $sql = "CREATE DATABASE $dbname";
	  if (mysql_query($sql, $link)) {
		  echo "Datenbank erfolgreich erstellt \n";
	  } else {
		  echo "Error Datenbankerstellung: " . mysql_error() . "\n";
	  }
	}
	mysql_close($link);

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
	geschlecht VARCHAR(9) NOT NULL,
	reg_date TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "users Tabelle erfolgreich erstellt";
	} else {
	    echo "Error Tebelle erstellen: " . $conn->error;
	}
}

//Daten einfuegen
function createData($uname, $eMail, $kenn, $webseite, $komment, $gesch){
	$sql = "INSERT INTO users (username, email, kennwort, website, kommentar, geschlecht) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssss", $uname, $eMail, $kenn, $webseite, $komment, $gesch);
	$stmt->execute();
	if ($stmt->execute()) {
	    echo "Daten erfolgreich eingefuegt";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$stmt->close();
}

function selectAll(){
	$sql = "SEELECT id, username, email, kennwort, website, kommentar, geschlecht, reg_date FROM users";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // Daten ausgeben
	    while($row = $result->fetch_assoc()) {
	        echo "id: " . $row["id"]. " - username: " . $row["username"]. " - email" . $row["email"]. " - kennwort" . $row["kennwort"]. "<br>"
			 " - website" . $row["website"]. " - kommentar" . $row["kommentar"]. " - geschlecht" . $row["geschlecht"]. " - reg_date" . $row["reg_date"]. "<br>";
	    }
	} else {
    echo "0 results";
	}
	
}

//Verbindung aufheben
function closeConn(){
	$conn->close();
}

?> 