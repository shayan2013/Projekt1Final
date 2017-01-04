<?php include 'Microservices_de/headerFooter.php';?>
<!DOCTYPE HTML>  
<html lang=de>
	<head>
		<?php include 'Microservices_de/meta.php';?>
		<title>Photos</title>
	</head>
	<body> 
		<div class="flex-container">
			<header>
				<h1>Bilder</h1>
				<?php headi();?>
			</header>
			<?php include 'Microservices_de/navigation.php';?>	
			<?php require 'Microservices_de/imageConf.php';?>
			<footer><?php footi();?></footer>
		</div>
	</body>
</html>