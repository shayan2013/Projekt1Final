<?php include 'Microservices_de/session.php';?>
<?php include 'Microservices_de/headerFooter.php';?>
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
			</header>
			<?php include 'Microservices_de/navigation.php';?>
			<form action="Microservices_de/upload.php" method="post" enctype="multipart/form-data">
				Bilder Hochladen:
				<input type="file" name="fileToUpload" id="fileToUpload">
				<input type="submit" value="Upload Image" name="submit">
			</form>
			<footer><?php footi();?></footer>
		</div>
	</body>
</html>