<?php include 'Microservices_de/headerFooter.php';?>
<?php include 'Microservices_de/dbConfig.php';?>
<!DOCTYPE HTML>  
<html lang=de>
	<head>
		<?php include 'Microservices_de/meta.php';?>
		<title>Log In/Out</title>
	</head>
	<body>  

	<?php
	// Variablen mit leeren Values erstellen
	$nameErr = $kennwortErr = "";
	$name = $kennwort = "";
	$x = 0;

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["name"])) {
		$nameErr = "Name erforderlich!";
		 // testen ob der Name nur aus Buchstaben und Leertaste besteht
	  } elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		  $nameErr = "Nur Buchstaben und Leertaste erlaubt!"; 
		}else {
		$name = test_input($_POST["name"]);
		$x++;
	  }
	  
	  if (empty($_POST["kennwort"])) {
		$kennwortErr = "kennwort erforderlich!";
	  } else {
		$kennwort = $_POST["kennwort"];
		$x++;
	  }
	}
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	if ($x == 5) {
		create();
		createData($name, $email, $kennwort, $website, $kommentar, $geschlecht);
		$x = 0;
	}
	
	?>
		<div class="flex-container">
			<header>
				<h1>Log In</h1>
				<?php headi();?>
			</header>
			<?php include 'Microservices_de/navigation.php';?>
			<p><span class="error">* Pflichtfeld.</span></p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			  Username: <input type="text" name="name" value="<?php echo $name;?>">
			  <span class="error">* <?php echo $nameErr;?></span>
			  <br><br>
			  Kennwort: <input type="password" name="kennwort" value="<?php echo $kennwort;?>">
			  <span class="error">* <?php echo $kennwortErr;?></span>
			  <br><br>
			  <input type="submit" name="submit" value="Absenden">  
			  <p>noch nicht registiert? <a href="register.php"> klick hier!</a></P>
			</form>
			<footer><?php footi();?></footer>
		</div>

	<?php
	echo "<h2>Deine Eingabe:</h2>";
	echo $name;
	echo "<br>";
	echo $kennwort;
	echo "<br>";
	echo $x;
	?>

	</body>
</html>