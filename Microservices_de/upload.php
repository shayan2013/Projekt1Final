<!DOCTYPE HTML>  
<html>
<body>  

<?php
$target_dir = "../Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Überprüfen des Bildes nach seiner Gültigkeit
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Datei ist ein Bild - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Datei ist kein Bild.";
        $uploadOk = 0;
    }
}
// Überprüfen ob Datei schon existiert
if (file_exists($target_file)) {
    echo "Sorry, Datei existiert schon.";
    $uploadOk = 0;
}
// Dateigröße überprüfen
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, Datei ist zu groß.";
    $uploadOk = 0;
}
// Akzeptabele Formate
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Überprüfung $uploadOk == 0 im Falle eines Fehlers
if ($uploadOk == 0) {
    echo "Sorry, deine Datei wurde nicht hochgeladen.";
// fals alles ok ist, Datei hochladen
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Die Datei ". basename( $_FILES["fileToUpload"]["name"]). " ist hochgeladen.";
    } else {
        echo "Sorry, Es ist ein Fehler während des Hochladens aufgetaucht.";
    }
}
?> 

</body>
</html>