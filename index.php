<?php include 'Microservices_de/headerFooter.php';?>
<!DOCTYPE html>

<?php
define("GREETING", "Welcome to ShaBlog.de!");
echo GREETING;
?>

<html lang=de>
	<head>
		<meta charset=UTF-8>
		<title>Home</title>
		<link rel="stylesheet" href="Design/style.css">
	</head>
	<body>
		<div class="flex-container">
			<header>
				<?php headi();?>
			</header>
			<nav class="nav">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="Microservices_de/log_In.php">An-Abmeldung</a></li>
					<li><a href="#">Einstellung</a></li>
					<li><a href="#">Photos/Videos</a></li>
				</ul>
			</nav>
			<form action="Microservices_de/upload.php" method="post" enctype="multipart/form-data">
				Bilder Hochladen:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
			</form>			
			<footer><?php footi();?></footer>
		</div>
	</body>
</html>