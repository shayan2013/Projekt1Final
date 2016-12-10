<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Verbindung erstellen
$conn = new mysqli($servername, $username, $password);
// test die Verbindung
if ($conn->connect_error) {
    die("Verbindungsfehler: " . $conn->connect_error);
} 

// Datenbank erstellen
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
    echo "Datenbank erfolgreich erstellt";
} else {
    echo "Error Datenbankerstellung: " . $conn->error;
}

$conn->close();
?> 