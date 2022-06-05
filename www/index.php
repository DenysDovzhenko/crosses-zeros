<?php
	require ("Session_destroy.php");//Відображення імені по ходу,  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Головне меню</title>
	<link rel="shortcut icon" href="icon.png" type="image/png">
	<link rel="stylesheet" href="bootstrap.css"><!-- Підключення bootstrap -->
	<link rel="stylesheet" href="bootstrap-grid.css">
	<link rel="stylesheet" href="bootstrap-reboot.css">
	<link rel="stylesheet" href="style.css"><!-- Власні стилі -->
	<link rel="stylesheet" href="all_styles.css">
	<link rel="preconnect" href="https://fonts.gstatic.com"><!-- Підключення нових шрифтів -->
	<link href="https://fonts.googleapis.com/css2?family=Sofadi+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Yatra+One&display=swap" rel="stylesheet">
</head>
<body>
	<header><a href="index.php">Crosses-Zeros.ua</a></header><!-- Шапка сайту -->
	<div class="container">
		<div class="top"><!-- Привітання сайту -->
			<div class="decorated-text"><h1>Ми раді вітати вас у грі!</h1></div>
			<div class="decorated-text"><h2>Оберіть бажану вкладку меню:</h2></div>
		</div>
		<br>
		<div class="buttons row justify-content-center"> <!-- Набір кнопок сайту -->
			<button class="btn btn-outline-primary but" onClick='location.href="Bot.php"'>Гра з ботом</button>
			<button class="btn btn-outline-danger but" onClick='location.href="Robot.php"'>Гра з другом</button>
			<button class="btn btn-outline-primary but" onClick='location.href="Rules.php"'>Правила гри</button>	
		</div>
	</div>
	<br>
	<footer class="footer"><div class="container"><span class="text-muted">Produced by Dovzhenko Denis.</span><!-- Футер сайту -->
      </div></footer>
</body>
</html>
