<?php require 'Microservices_de/session.php';?>
<?php include 'Microservices_de/headerFooter.php';?>
<?php require 'Microservices_de/dbConfig.php';?>

<!DOCTYPE HTML>  

<?php
	if (!isset($_SESSION["uname"])) {
		print '<script>
					if (confirm("first Log-In please!") == true) {
						location.replace("log_In.php");
					} else {
						location.replace("index.php");
					}
				</script>';
	}
?>
<html lang=de>
	<head>
		<?php include 'Microservices_de/meta.php';?>
		<title>Einstellung</title>
	</head>
	<body>  
		<div class="flex-container">
			<header>
				<h1>Einstellung</h1>
				<?php headi();?>
			</header>
			<?php include 'Microservices_de/navigation.php';?>
			<?php 
				$id = $un = $em = $kenn = $kommentar = "";
				$idErr = $unErr = $emErr = $kennErr = $deleteErr = $kommentErr = "";
				
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (isset($_POST['updateK'])) {
						changeBlog($_SESSION["uname"], $_POST["kommentar"]);
					}elseif (test_id($_POST["id"])) {
						if (isset($_POST['delete'])) {
							deleteData($_POST["id"]);
						}elseif (test_update($_POST["username"], $_POST["email"], $_POST["kennwort"])) {
							updateData($_POST["username"], $_POST["email"], $_POST["kennwort"], $_POST["id"]);
						}
					}
				} 
				
				function test_update($un, $em, $kenn){
					global $unErr, $emErr;
					$x = 0;
					if (!empty($un)) {
						if (!(preg_match("/^[a-zA-Z ]*$/",$un))) {
							$unErr = "Nur Buchstaben und Leertaste erlaubt!"; 
						} else {
							$x++;
						}
					}
					if (!empty($em)) {
						if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
							$emErr = "ungültige Email-format";  
						} else {
							$x++;
						}
					}
					if (!empty($kenn)) {
							$x++;
					}
					if ($x > 0) {
						//$x = 0;
						return true;
					} else {
						return false;
					}
				}
				
				function test_id($num) {
					global $idErr;
					if (empty($num)) {
						$idErr = "id erforderlich!";
						return false;
						// testen ob der Name nur aus Buchstaben und Leertaste besteht
					} elseif (preg_match("/^[a-zA-Z ]*$/",$num)) {
						$idErr = "Nur Zahlen erlaubt!"; 
						return false;
					} else {
						return true;
					}
				}
			?>
			<?php 
				if ($_SESSION["uname"] == "Admin"){
					selectAll();
					echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  
					id: <input type="number" name="id" value="'.$id.'">
					<span class="error">*'.$idErr.'</span>
					<input type="submit" name="delete" value="delete">
					<input type="submit" name="update" value="update">
					<span class="error">'.$deleteErr.'</span>
					<br><br>
					username: <input type="text" name="username" value="'.$un.'">
					<span class="error">'.$unErr.'</span>
					email: <input type="text" name="email" value="'.$em.'">
					<span class="error">'.$emErr.'</span>
					kennwort: <input type="text" name="kennwort" value="'.$kenn.'">
					</form>';
				} else {
					selectPerson($_SESSION["uname"]);
					echo '<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">  
					Kommentar: <textarea name="kommentar" rows="5" cols="40">'.$kommentar.'</textarea>
					<input type="submit" name="updateK" value="Update Kommentar">
					<span class="error">'.$kommentErr.'</span>
					<br><br>
					</form>';
				}			
			?>

			
			<br><br>
			<footer><?php footi();?></footer>
		</div>

	</body>
</html>