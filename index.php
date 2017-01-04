<?php require 'Microservices_de/session.php';?>
<?php include 'Microservices_de/headerFooter.php';?>
<?php require 'Microservices_de/dbConfig.php';?>
<!DOCTYPE html>

<?php
	if (!isset($_SESSION["welcome"])) {
		echo '<script>
				window.alert("Welcome to ShaBlog");
			</script>';
		sessionWelcome("welc");
	}
?>
<html lang=de>
	<head>
		<?php include 'Microservices_de/meta.php';?>
		<title>Home</title>
	</head>
	<body>
		<div class="flex-container">
			<header>
				<h1>ShaBlog</h1>
				<?php headi();?>
				<?php include 'Microservices_de/navigation.php';?>
			</header>
			<h1>Satz des Tages</h1>
			<h3>
			<?php
				$myfile = fopen("tagesblog.txt", "r") or die("Unable to open file!");
				echo fread($myfile,filesize("tagesblog.txt"));
				fclose($myfile);
			?>
			</h3>
			<form action="Microservices_de/upload.php" method="post" enctype="multipart/form-data">
				<?php
					if (isset($_SESSION["uname"])) {
						echo "Willkommen " . $_SESSION["uname"] . " !<br>";
					}
					getKomment($_SESSION["uname"]);
				?>
				<br><br>
				Bilder Hochladen:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
			</form>
			<footer><?php footi();?></footer>
		</div>
	</body>
</html>