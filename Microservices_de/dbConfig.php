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
	echo "<table id='selectAllTable'>
		  	<tr>
    			<th>id</th>
    			<th>username</th> 
    			<th>email</th>
				<th>kennwort</th>
				<th>website</th>
				<th>kommentar</th>
				<th>geschlecht</th>
				<th>reg_date</th>
  			</tr>
		 ";
	if ($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "<tr>";
			echo "<td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["kennwort"].
			 "</td><td>" . $row["website"]. "</td><td>" . $row["kommentar"]. "</td><td>" . $row["geschlecht"]. "</td><td>" . $row["reg_date"]. "</td>";
			echo "</tr>";
		}
	}else {
		echo "<tr>ergebnis 0</tr>";
	}
	echo "</table>";
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
	$sql = "DELETE FROM users WHERE id ='$id'";
	//$stmt = $conn->prepare($sql);
	//$stmt->bind_param("i", $id);
	//$stmt->execute(); 
	if ($conn->query($sql) === TRUE) {
		return "Daten erfolgreich geloescht.";
	} else {
		return "Daten nicht geloescht: " . $conn->error;
	}
	
	//$stmt->close();
	$conn->close();
}

//Daten aktuallisieren
function updateData($uname, $eMail, $kenn, $id) {
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT username, email, kennwort FROM users WHERE id = " . $id ;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if (empty($uname)){
				$uname = $row["username"];
			}
			if (empty($eMail)){
				$eMail = $row["email"];
			}
			if (empty($kenn)){
				$kenn = $row["kennwort"];
			}
		}
	} else {
		return false;
	}
	
	$sql = "UPDATE users SET username = ?, email = ?, kennwort = ? WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sssi', $uname, $eMail, $kenn, $id);
	$stmt->execute();
	if ($conn->query($sql) === TRUE) {
		return true;
	} else {
		return false;
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

function changeBlog($uname, $blog) {
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "UPDATE users SET kommentar = ? WHERE username = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ss', $blog, $uname);
	$stmt->execute();
	if ($conn->query($sql) === TRUE) {
		return true;
	} else {
		return false;
	}
	$stmt->close();
	$conn->close();
}

function selectPerson($uname) {
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT id, username, email, kennwort, website, kommentar, geschlecht, reg_date FROM users WHERE username ='$uname'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<table id='selectAllTable'>
			  	<tr>
	    			<th>id</th>
	    			<th>username</th> 
	    			<th>email</th>
					<th>kennwort</th>
					<th>website</th>
					<th>kommentar</th>
					<th>geschlecht</th>
					<th>reg_date</th>
	  			</tr>
			 ";
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["id"]. "</td><td>" . $row["username"]. "</td><td>" . $row["email"]. "</td><td>" . $row["kennwort"].
			 "</td><td>" . $row["website"]. "</td><td>" . $row["kommentar"]. "</td><td>" . $row["geschlecht"]. "</td><td>" . $row["reg_date"]. "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	$conn->close();

}

function getKomment($uname) {
	global $servername, $username, $password, $dbname;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT kommentar FROM users WHERE username ='$uname'";	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo "<table id='selectAllTable'>
			  	<tr>	
	    			<th>username</th>
					<th>kommentar</th>	
	  			</tr>
			 ";
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $uname . "</td><td>" . $row["kommentar"]. "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	$conn->close();
}


?> 