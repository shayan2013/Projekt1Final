<?php
$servername = "localhost";
$username = "root";
$password = "YZmAfDpGyAUY3ax3";
$dbname = "Shablog";

// Datenbank erstellen
function create(){
	global $servername, $username, $password, $dbname;
	// MySQL Verbindung
	$link = mysql_connect($servername, $username, $password);
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	echo "Verbindung erfolgreich erstellt";
	// Datenbank auswaehlen
	$db_selected = mysql_select_db($dbname, $link);
	if (!$db_selected) {
	  // Wenn Db nicht ausgewaehlt wwerden kann dann existiert sie  entweder nicht oder wir koennen es nicht sehen 
	  $sql = "CREATE DATABASE IF NOT EXISTS " .$dbname;
	  if (mysql_query($sql, $link)) {
		  echo "Datenbank erfolgreich erstellt \n";
	  } else {
		  echo "Error Datenbankerstellung: " . mysql_error() . "\n";
	  }
	}


	// tebelle erstellen
	$sql = "CREATE TABLE IF NOT EXISTS users ( `id` INT(6) UNSIGNED NOT NULL AUTO_INCREMENT ,
	`username` VARCHAR(30) NOT NULL , `email` VARCHAR(50) NOT NULL , 
	`kennwort` VARCHAR(30) NOT NULL , `website` VARCHAR(50) NOT NULL ,
	`kommentar` VARCHAR(100) NOT NULL , `geschlecht` VARCHAR(9) NOT NULL ,
	`reg_date` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB; ";
	
    $conn = new mysqli($servername, $username, $password, $dbname);
	$conn->query($sql);
	echo "Verbindung zur Tabelle erfolgreich erstellt";
	$conn->close();
}


//Daten einfuegen
function createData($uname, $eMail, $kenn, $webseite, $komment, $gesch){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "INSERT INTO users (username, email, kennwort, website, kommentar, geschlecht) VALUES (?, ?, ?, ?, ?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ssssss", $uname, $eMail, $kenn, $webseite, $komment, $gesch);
	$stmt->execute();
	echo "Daten erfolgreich eingetragen.";
	$last_id = $conn->insert_id;
	return $last_id;
	$stmt->close();
	$conn->close();
}

//alles ausgeben
function selectAll(){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT id, username, email, kennwort, website, kommentar, geschlecht, reg_date FROM users";
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"]. " - kennwort: " . $row["kennwort"].
			 " - website: " . $row["website"]. " - kommentar: " . $row["kommentar"]. " - geschlecht: " . $row["geschlecht"]. " - reg_date: " . $row["reg_date"]. "<br>";
		}
	}else {
		echo "ergebnis 0";
	}
	$conn->close();
}

//eine auswaehlen
function selectOne($id){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT id, username, email, kennwort, website, kommentar, geschlecht, reg_date FROM users WHERE id = " . $id ;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			return "id: " . $row["id"]. " - username: " . $row["username"]. " - email: " . $row["email"]. " - kennwort: " . $row["kennwort"]. "\n" .
			 " - website: " . $row["website"]. " - kommentar: " . $row["kommentar"]. " - geschlecht: " . $row["geschlecht"]. " - reg_date: " . $row["reg_date"]. "\n";			
		}
	} else {
		return "ergebnis 0";
	}
		
	$conn->close();
}

//loeschen
function deleteData($id){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "DELETE FROM users WHERE id = '?'";
	$stmt = $conn->prepare($sql);
	//$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $id);
	$stmt->execute(); 
	if ($conn->query($sql) === TRUE) {
		echo "Daten erfolgreich geloescht.";
	} else {
		echo "Daten nicht geloescht: " . $conn->error;
	}
	
	$stmt->close();
	$conn->close();
}

//Daten aktuallisieren
function updateData($uname, $eMail, $kenn, $webseite, $komment, $gesch, $id) {
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "UPDATE users SET username = ?, email = ?, kennwort = ?, website = ?, kommentar = ?, geschlecht = ? WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssssssi', $uname, $eMail, $kenn, $webseite, $komment, $gesch, $id);
	$stmt->execute();
	if ($conn->query($sql) === TRUE) {
		echo "Daten erfolgreich aktualisiert.";
	} else {
		echo "Daten nicht aktualisiert: " . $conn->error;
	}
	$stmt->close();
	$conn->close();
}

function logInCheck($uname, $kenn){
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT * FROM users WHERE username='$uname'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$kn = $row["kennwort"];
			if ($kn == $kenn) {
				return 1;
			}else {
				echo "nicht eingeloggt";
			}
		}
	}
	
}

?> 