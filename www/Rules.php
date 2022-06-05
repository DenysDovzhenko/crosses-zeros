<?php
	require ("Session_destroy.php");
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
	<div><!-- Привітання сайту -->
		<div class="decorated-text"><h1>Правила гри</h1></div>
		<div class="decorated-text"><h2>Гравці по черзі ставлять на вільні клітини поля 3х3 знаки (один завжди хрестики, інший завжди нулики). Перший, хто зумів побудувати в ряд 3 своїх фігури по вертикалі, горизонталі або діагоналі, виграє. Зазвичай по завершенні партії сторона, яка виграла закреслює рискою свої три знака (нулики або хрестика), які складають суцільний ряд. </h2></div>
	</div><br>
	
		<div class="buttons row justify-content-center"> <!-- Набір кнопок сайту -->
			<button class="btn btn-outline-primary but" onClick='location.href="Bot.php"'>Грати з ботом</button>
			<button class="btn btn-outline-danger but" onClick='location.href="Robot.php"'>Грати з другом</button>
			<button class="btn btn-outline-primary but" onClick='location.href="index.php"'>Повернутись на початок</button>	
		</div>
	</div>
	<br>
	<footer class="footer"><div class="container"><span class="text-muted">Produced by Postoronka Valeria.</span><!-- Футер сайту -->
      </div></footer>
</body>
</html>