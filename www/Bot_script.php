<?php
require ("Classess.php");
class machineTurn extends Turn{//Хід комп'ютера
	protected $winner;
	protected $choosingWinner;

	public function __construct(){
		$choosing = NULL;
		while($choosing == NULL)//Доки комп'ютер не попаде в пусту ячейку не буде переходу в інший хід
			$choosing = $this->detectChoosing();
		$this->choosingWinner = new ChoosingWinner($choosing);//Перехід до визначення гравця та його ходу
		$this->winner = $this->choosingWinner->getWinner();//Отримати перемогу за її наявності
	}
	private function detectChoosing(){//Функція визначення ходу машини. Машина не перевіряє небезпечні ходи, проте в пріоритеті має заповнити найбільш виграшні позиції
		if(mt_rand(0, 1)){//В пріоритеті машина ставить маркер по центру
			if(empty($_SESSION[serialize(22)]))
				return serialize(22);
		}
		else{//Далі по пріоритету ідуть кутові значення
			$this->chooseCell();
		}
		$i = mt_rand(1, 3);//Якщо комп'ютер не зміг обрати з переможних значень, то він переходить до усіх значень 
		$j = mt_rand(1, 3) * 10;
		if(empty($_SESSION[serialize($i+$j)]))
			return serialize($i + $j);
		return NULL;//Комп'ютер не зміг обрати серед випадкових значень
	}
	private function chooseCell(){//Функція вибору кутових значень
		switch(mt_rand(0,3)){
			case 0:
				if(empty($_SESSION[serialize(11)]))
					return serialize(11);
				break;
			case 1:
				if(empty($_SESSION[serialize(13)]))
					return serialize(13);
				break;
			case 2:
				if(empty($_SESSION[serialize(31)]))
					return serialize(31);
				break;
			case 3:
				if(empty($_SESSION[serialize(33)]))
					return serialize(33);
				break;
		}
	}
}
//Образ гри з машиною
class machinePlaying extends Playing{
	 protected function takeWin(){//Перевірка на перемогу
		if($this->winning->getWin() !== NULL){
			switch($this->winning->getWin()){
				case 1:
					echo "<span class=\"align-middle\"><br>Переміг гравець 'O'!</span>";
					return 1;
					break;
				case 0:
					echo "<span class=\"align-middle\"><br>Переміг гравець 'X'!</span>";
					return 1;
					break;
				case -1:
					echo "<br><span class=\"align-middle\">Нічия.</span>";
					return 1;
					break;
			}
		}
	}
	public function __construct(){//Цикл ходу
		$this->echoFirstTurn();
		if(isset($_POST["choose"])){
			$this->winning = new Turn;
			$this->ifWin();
		}	
	}
	private function ifWin(){//Варіанти продовження гри відносно перемоги
		if($this->takeWin() !== 1){//Перемоги не було
			$this->winning = new machineTurn();
			if($this->takeWin() === 1){//Перемога пройшла
				$this->nowWin = 1;
				session_destroy();
			}
			$_SESSION["fTurn"]->changeMark();	
		}
		else{
			$this->nowWin = 1;
			session_destroy();
		}
	}
	protected function echoFirstTurn(){
	if(!$_SESSION["fTurn"]->getTurn())
		echo "Хід гравця O";
	else
		echo "Хід гравця X";
	$_SESSION["firstTime"] = true;
	}
}
class machineGame extends Game{//Класс обьекту гри, що використовуватиме компьютерні обьєкти 
	public function __construct()  {//Якщо 	користувач тільки перейшов на сторінку, проходить етап авторизації гравця
		if($this->authorisationPassed()){//Якщо користувач пройшов авторизацію, він переходить до гри
			$this->markEmpty();//Запам'ятовування маркера першого гравця
			$this->startPlaying = new machinePlaying;
		}
		else
			$this->authorisation = new Authorisation;//Авторизація
	}
}
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Гра з роботом</title>
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
	<form action="Bot_script.php" method="POST">
		<div class="decorated-text"><h1>
			<?php $newGame = new machineGame;?>	
		</div>
		<?php if($newGame->authorisationPassed()){?>
		<div class="container mt-5">
			<div class="row row justify-content-center">
				<div class="col-3">			
					<table class="table">
						<tbody>
							<tr>
								<td><?php cell(31);?></td>
								<td><?php cell(32);?></td>
								<td><?php cell(33);?></td>
							</tr>
							<tr>
								<td><?php cell(21);?></td>
								<td><?php cell(22);?></td>
								<td><?php cell(23);?></td>
							</tr>
							<tr>
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
						<center><a href="Bot.php" class="align-middle">Грати знову</a></center>
						<?php } ?>	
					<?php } ?>
					</centre>	
				</div>
			</div>
		</div>
	 </form>
	<footer class="footer"><div class="container"><span class="text-muted">Produced by Dovzhenko Denis.</span><!-- Футер сайту -->
      </div></footer>
</body>
</html>
