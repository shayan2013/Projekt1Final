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
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			id: <input type="number" name="id" value="<?php echo $id;?>">
			<input type="submit" name="delete" value="delete">
			<input type="submit" name="update" value="update">
			<br><br>
			<footer><?php footi();?></footer>
		</div>

	</body>
</html>