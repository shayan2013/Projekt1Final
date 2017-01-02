<?php include 'Microservices_de/session.php';?>
<?php include 'Microservices_de/headerFooter.php';?>
<?php include 'Microservices_de/dbConfig.php';?>
<!DOCTYPE HTML>  
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
				$id = $un = $em = $kenn = "";
				$idErr = $unErr = $emErr = $kennErr = $updateErr = $deleteErr = "";
				
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (test_id($_POST["id"])) {
						if (isset($_POST['delete'])) {
							deleteData($_POST["id"]);
						}elseif (test_update($_POST["username"], $_POST["email"], $_POST["kennwort"])) {
							echo "go to updateData";
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
			<?php selectAll(); ?>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			id: <input type="number" name="id" value="<?php echo $id;?>">
			<span class="error">* <?php echo $idErr;?></span>
			<input type="submit" name="delete" value="delete">
			<input type="submit" name="update" value="update">
			<span class="error">* <?php echo $updateErr;?></span>
			<span class="error">* <?php echo $deleteErr;?></span>
			<br><br>
			username: <input type="text" name="username" value="<?php echo $un;?>">
			<span class="error">* <?php echo $unErr;?></span>
			email: <input type="text" name="email" value="<?php echo $em;?>">
			<span class="error">* <?php echo $emErr;?></span>
			kennwort: <input type="text" name="kennwort" value="<?php echo $kenn;?>">
			</form>
			<br><br>
			<footer><?php footi();?></footer>
		</div>

	</body>
</html>