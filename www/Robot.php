<?php
	require ("Session_destroy.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ім'я?</title>
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
	<div class="container mt-5"><!-- Створення контейнеру що трохи центрує текст і створює відступи від країв приблизно на 15-20% -->
		<div class="decorated-text">
			<h1>Привіт! Уведіть Ваші імена, гравці:</h1>
		</div>
		<form action="Robot_script.php" method="GET">
			<div class="row justify-content-center"><!-- Оголошення рядку цьогго контейнеру з центруванням колонок рядка. Тобто початок запису буде вестися з середини -->
				<div class="col-4"><!-- Оголошення колонки цього рядка. розмір колонки становить 100%контейнера/12*4 -->
					<input type="text" class="form-control" placeholder="First username" aria-label="Username" aria-describedby="basic-addon1" name="firstName">
					<br>
					<input type="text" class="form-control" placeholder="Second username" aria-label="Username" aria-describedby="basic-addon1" name="secondName">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-3 offset-2 mt-2"><!-- Розмір цієї колонки становить 100%container/12*2+здвиг на розмір цієї колонки -->
					<button class="btn btn-outline-danger">Завершити ввід</button>
				</div>		
			</div>
		</form>
	</div>
	<footer class="footer"><div class="container"><span class="text-muted">Produced by Postoronka Valeria.</span><!-- Футер сайту --></footer>
</body>
</html>