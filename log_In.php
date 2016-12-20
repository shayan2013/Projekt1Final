<?php include 'Microservices_de/headerFooter.php';?>
<?php include 'Microservices_de/dbConfig.php';?>
<!DOCTYPE HTML>  
<html lang=de>
	<head>
		<?php include 'Microservices_de/meta.php';?>
		<title>Register</title>
	</head>
	<body>  

	<?php
	// Variablen mit leeren Values erstellen
	$nameErr = $emailErr = $geschlechtErr = $kennwortErr = $kennwort2Err = $websiteErr = "";
	$name = $email = $geschlecht = $kennwort = $kennwort2 = $kommentar = $website = "";
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
	  
	  if (empty($_POST["email"])) {
		$emailErr = "Email erforderlich!";
			// testen ob Emailadresse gültige Form entspricht
	  } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "ungültige Email-format"; 
		}else {
		$email = test_input($_POST["email"]);
		$x++;
		}
		
		

	  if (empty($_POST["kennwort"])) {
		$kennwortErr = "kennwort erforderlich!";
	  } else {
		$kennwort = $_POST["kennwort"];
		$x++;
	  }
	  
	  if (empty($_POST["kennwort2"])) {
		$kennwort2Err = "kennwort wiederholen bitte!";
	  } elseif ($kennwort != $_POST["kennwort2"]) {
		$kennwort2Err = "Kennwort stimmt nicht überein!";
	  }else {
		  $kennwort2 = $_POST["kennwort2"];
		  $x++;
	  }
	  
	  if (empty($_POST["website"])) {
		$website = "";
	  } else {
		$website = test_input($_POST["website"]);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
		  $websiteErr = "ungültige URL"; 
		  $x--;
		}
	  }

	  if (empty($_POST["kommentar"])) {
		$kommentar = "";
	  } else {
		$kommentar = test_input($_POST["kommentar"]);
	  }

	  if (empty($_POST["geschlecht"])) {
		$geschlechtErr = "Geschlecht erforderlich!";
	  } else {
		$geschlecht = test_input($_POST["geschlecht"]);
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
				<h1>Anmeldeformular</h1>
				<?php headi();?>
			</header>
			<?php include 'Microservices_de/navigation.php';?>
			<p><span class="error">* Pflichtfeld.</span></p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			  Username: <input type="text" name="name" value="<?php echo $name;?>">
			  <span class="error">* <?php echo $nameErr;?></span>
			  <br><br>
			  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
			  <span class="error">* <?php echo $emailErr;?></span>
			  <br><br>
			  Kennwort: <input type="password" name="kennwort" value="<?php echo $kennwort;?>">
			  <span class="error">* <?php echo $kennwortErr;?></span>
			  <br><br>
			  Kennwort(Wiederholung): <input type="password" name="kennwort2" value="<?php echo $kennwort2;?>">
			  <span class="error">* <?php echo $kennwort2Err;?></span>
			  <br><br>
			   Website: <input type="text" name="website" value="<?php echo $website;?>">
			  <span class="error"><?php echo $websiteErr;?></span>
			  <br><br>
			   Kommentar: <textarea name="kommentar" rows="5" cols="40"><?php echo $kommentar;?></textarea>
			  <br><br>
			  geschlecht:
			  <input type="radio" name="geschlecht" <?php if (isset($geschlecht) && $geschlecht=="weiblich") echo "checked";?> value="weiblich">weiblich
			  <input type="radio" name="geschlecht" <?php if (isset($geschlecht) && $geschlecht=="männlich") echo "checked";?> value="männlich">männlich
			  <span class="error">* <?php echo $geschlechtErr;?></span>
			  <br><br>
			  <input type="submit" name="submit" value="Absenden">  
			</form>
			<footer><?php footi();?></footer>
		</div>

	<?php
	echo "<h2>Deine Eingabe:</h2>";
	echo $name;
	echo "<br>";
	echo $email;
	echo "<br>";
	echo $kennwort;
	echo "<br>";
	echo $website;
	echo "<br>";
	echo $kommentar;
	echo "<br>";
	echo $geschlecht;
	echo $x;
	?>

	</body>
</html>