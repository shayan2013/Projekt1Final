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
			<?php selectAll(); ?>
			
			<footer><?php footi();?></footer>
		</div>

	</body>
</html>