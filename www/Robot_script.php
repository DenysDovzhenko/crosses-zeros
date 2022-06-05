<?php
require ("Classess.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Гра з другом</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="icon.png" type="image/png">
	<link rel="stylesheet" href="bootstrap.css"><!-- Підключення bootstrap -->
	<link rel="stylesheet" href="bootstrap-grid.css">
	<link rel="stylesheet" href="bootstrap-reboot.css">
	<link rel="stylesheet" href="all_styles.css"><!-- Власні стилі -->
	<link rel="stylesheet" href="Robot_style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com"><!-- Підключення нових шрифтів -->
	<link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Yatra+One&display=swap" rel="stylesheet">
</head>
<body>
	<header><a href="index.php">Crosses-Zeros.ua</a></header><!-- Шапка сайту -->
	<form action="Robot_script.php" method="POST">
		<div class="decorated-text"><h1>
			<?php $newGame = new Game;?>	
		</h1></div>
		<?php if($newGame->authorisationPassed()){?>
		<div class="container mt-5">
			<div class="row row justify-content-center">
				<div class="col-3">			
					<table class="table">
						<tbody>
							<tr scope="row">
								<td><?php cell(31);?></td>
								<td><?php cell(32);?></td>
								<td><?php cell(33);?></td>
							</tr>
							<tr scope="row">
								<td><?php cell(21);?></td>
								<td><?php cell(22);?></td>
								<td><?php cell(23);?></td>
							</tr>
							<tr scope="row">
								<td><?php cell(11);?></td>
								<td><?php cell(12);?></td>
								<td><?php cell(13);?></td>
							</tr>
						</tbody>
					</table>
					<centre>
					<?php if($newGame->startPlaying->getW() === NULL){ ?>
					<center><button class="btn btn-outline-danger align-middle">Зробити хід</button></center>	
					<?php } else {?>
						<center><a href="Robot.php" class="align-middle">Грати знову</a></center>
						<?php } ?>	
					<?php } ?>
					</centre>	
				</div>
			</div>
		</div>
	 </form>
	<footer class="footer"><div class="container"><span class="text-muted">Produced by Postoronka Valeria.</span><!-- Футер сайту -->
      </div></footer>
</body>
</html>