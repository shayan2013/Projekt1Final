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
				$id = $idErr = "";
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (test_input($_POST["id"])) {
						if (isset($_POST['delete'])) {
							deleteData($_POST["id"]);
						}/*else {
							updateData($_POST["id"]);
						}	*/					
					}
				}
				
				function test_input($num) {
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
			<br><br>
			<footer><?php footi();?></footer>
		</div>

	</body>
</html>