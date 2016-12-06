<!DOCTYPE HTML>  
<html lang=de>
	<head>
		<meta charset=UTF-8>
		<title>Home</title>
		<link rel="stylesheet" href="../Design/style.css">
	</head>
	<body>  

	<?php
	// define variables and set to empty values
	$nameErr = $emailErr = $geschlechtErr = $kennwortErr = $kennwort2Err = $websiteErr = "";
	$name = $email = $geschlecht = $kennwort = $kennwort2 = $kommentar = $website = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["name"])) {
		$nameErr = "Name erforderlich!";
		 // check if name only contains letters and whitespace
	  } elseif (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		  $nameErr = "Nur Buchstaben und Leertaste erlaubt!"; 
		}else {
		$name = test_input($_POST["name"]);
	  }
	  
	  if (empty($_POST["email"])) {
		$emailErr = "Email erforderlich!";
			// check if e-mail address is well-formed
	  } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "ungültige Email-format"; 
		}else {
		$email = test_input($_POST["email"]);
		}
		
		

	  if (empty($_POST["kennwort"])) {
		$kennwortErr = "kennwort erforderlich!";
	  } else {
		$kennwort = $_POST["kennwort"];
	  }
	  
	  if (empty($_POST["kennwort2"])) {
		$kennwort2Err = "kennwort wiederholen bitte!";
	  } elseif ($kennwort != $_POST["kennwort2"]) {
		$kennwort2Err = "Kennwort stimmt nicht überein!";
	  }else {
		  $kennwort2 = $_POST["kennwort2"];
	  }
	  
	  if (empty($_POST["website"])) {
		$website = "";
	  } else {
		$website = test_input($_POST["website"]);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
		  $websiteErr = "ungültige URL"; 
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
	  }
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	?>
		<div class="flex-container">
			<header>
				<h1>Anmeldeformular</h1>
			</header>
		
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
			<footer>Copyright © Projekt1</footer>
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
	?>

	</body>
</html>