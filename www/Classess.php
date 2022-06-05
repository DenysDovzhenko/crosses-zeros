<?php
//Головний клас - гра. З нього починаються ігрові розрахунки 
class Game
{//Гра ділиться на авторизацію та на власне гру
	protected $authorisation;
	public $startPlaying;
	public function __construct()  {//Якщо користувач тільки перейшов на сторінку, проходить етап авторизації гравця
		if($this->authorisationPassed()){//Якщо користувач пройшов авторизацію, він переходить до гри
			$this->markEmpty();//Запам'ятовування маркера першого гравця
			$this->startPlaying = new Playing;
		}
		else
			$this->authorisation = new Authorisation;//Авторизація
	}
	protected function markEmpty() {//Функція запам'ятовування вибору маркера, якщо він ще не обраний. Допомагає скорегувати ходу по вибору користувача
		if(isset($_POST["FPMarkStage"]) && $_POST["FPMarkStage"]=='x')
			$_SESSION["fTurn"]->changeMark();
	}
	public function authorisationPassed(){
		if(isset($_SESSION["playerName"]) && isset($_SESSION["fTurn"]) && empty($_GET["firstName"]))//Якщо необхідні дані для авторизації зчитані, то авторизація пройдена
			return true;
		return false;
	}
}
//Функція виводу ігрового поля на екран
function cell($num) {//Перше число в сесії то рядок масива, друге число - його стовпчик. Це функція виведення таблиці
	if (isset($_SESSION[serialize($num)]))//Якщо в дану комірку масива щось введено, то це значення виводиться на екран
	{
		if($_SESSION[serialize($num)] == 'X')
			echo "<center><div class=\"x\">".$_SESSION[serialize($num)]."</div></center>";
		else
			echo "<center><div class=\"o\">".$_SESSION[serialize($num)]."</div></center>";
	}
	else 
		echo "<center><input name=\"choose\" type=\"radio\" value=\"".serialize($num)."\"></center>"; //Якщо ні, користувач отримує один із варіантів вводу
}

class FirstTurn //Класс визначення першого ходу
{
	private $turn;//Булеве визначення ходу 

	public function __construct(){//Присвоєння ходу першого гравця до змінної ходів
		$this->turn = NULL;
	}
	public function getTurn(){//Передача значення коду
		return $this->turn;
	}
	public function changeMark(){//Перехід ходу
		$this->turn = !$this->turn;
	}
	private function firstTurn()//Реалізація пошуку винайдення гравця, що перший ходитиме. 
	{
		if(mt_rand(0, 1))
			echo "Хід передається до другого гравця<br>";
		else
			echo "Хід передається до першого гравця<br>";
	}	
}

class Authorisation {//Проходження авторизації
	private $turn;//Змінна, що зберігатиме об'єкт ходу гри

	public function __construct(){
		clearstatcache();
		if($this->checkName())//Якщо Ім'я введено то все тип топ і запускаємо вміст іфа
			$this->saveAuthorisation();//Зберігання даних авторизації
	}
	private function saveAuthorisation(){
		$this->turn = new FirstTurn;//Створення обьекту ходів
		$_SESSION["playerName"] = strip_tags($_GET["firstName"]);//Зберігання імені гравця
		$_SESSION["fTurn"] = $this->turn;//Запис першого гравця
		$this->marker();//Обновлення сторінки після вибору маркера
	}
	private function checkName (){//Функція перевірки введення ім'я.
		if(empty($_GET["firstName"]) && empty($_SESSION["playerName"])){//Перевірка вводу імені від користувача. А вдругбез імені попре)
			echo "Ви не увели ніяких данних щодо нікнейму, спробуйте знову. Натисніть на посилання, щоб повернутись: <br><a href=\"Robot.php\">Ввід нікнейму, гра з другом.</a> <br><a href=\"Bot.php\">Ввід нікнейму, гра з ботом</a>";
			return false;
		}
		echo "Тож розпочнемо гру, ".strip_tags($_GET["firstName"])."<br>";
		return true;
	}
	private function marker(){//Функція вибору маркера
		echo "Оберіть бажаний маркер: <button name=\"FPMarkStage\" value=\"x\" class=\"btn btn-outline-primary mr-2\"><div class=\"x\">x</div></button><button name=\"FPMarkStage\" class=\"btn btn-outline-danger ml-2\"  value=\"o\"><div class=\"o\">o</div></button>";
	}
}
//Негайна перевірка перемоги за ноликами
class TurnO extends CheckWinner
{
	public function __construct(){
		if ($this->checkWin('O'))
			$this->winner = 1;//Якщо перемогли нолики - гра повертає значення одиниці
		if($this->checkDraw() && is_null($this->winner))
			$this->winner = -1;//В випадку нічії повертає значення -1
		}
}
//Негайна перевірка перемоги за хрестики
class TurnX extends CheckWinner
{
	public function __construct(){
		if ($this->checkWin('X'))//Якщо перемагають хрестики встановлюється значення 0
			$this->winner = 0;
		if($this->checkDraw() && is_null($this->winner))
			$this->winner = -1;
	}
}

//Зберігання параметрів та функццій, необхідні для перемоги
abstract class CheckWinner 
{
	protected $winner;//Головний запис перемоги
	private $winCombo = array(array(11, 12, 13),//Можливі варіанти перемоги по масиву
	array(21, 22, 23),
	array(31, 32, 33),
	array(11, 21, 31),
	array(12, 22, 32),
	array(13, 23, 33),
	array(11, 22, 33),
	array(13, 22, 31),
	);

	protected function checkWin($player){//Функція перевірки перемоги
		for ($i = 0; $i < 8; $i++)
		{
			$count = 0;
			for ($j = 0; $j <= 2; $j++)
			{
				if(isset($_SESSION[serialize($this->winCombo[$i][$j])]))//Виконується проходження по усіх записаних значень порівнюючи їх з виграшними комбінаціями
					if ($_SESSION[serialize($this->winCombo[$i][$j])] == $player)
						$count++;
				if ($count==3)
					return true;//В грі є переможець
			}
		}
		return false;//Переможця не виявлено
	}
	protected function checkDraw(){//Перевірка нічиї
		$count = 0;
		for ($i = 10; $i <= 30; $i += 10){//Цикл проходження по рядкам ігрового поля
			for ($j = 1; $j <= 3; $j++){//Цикл проходження по стовпчикам ігрового поля
				if(isset($_SESSION[serialize($i+$j)]))//Рахування заповнених частин масиву
					$count++;//Лічильник
			}
		}
		if($count == 9)
			return true;//Нічия виявлена
		return false;//Нічиї не було
	}
	public function getWins(){
		return $this->winner;
	}
}

class ChoosingWinner{//Функція, що ділить ход як x та о
	private $turnw;

	public function __construct($takeChoose){
		if ($_SESSION["fTurn"]->getTurn() % 2 == 0){
			$this->issetChoose($takeChoose, 'O');
			$this->turnw = new TurnO;//Перевірити зміну характеристик гравців 
		}
		else{
			$this->issetChoose($takeChoose, 'X');
			$this->turnw = new TurnX;
		}
	}
	public function getWinner(){
		return $this->turnw->getWins();
	}
	private function issetChoose($takeChoose, $player){//Перевірка на ввід
		if(isset($takeChoose))//В випадку введених даних виконуємо запам'ятовування 
			$_SESSION[$takeChoose] = $player;//Запис даних на ігрове поле
	}
}
//Загальне визначення ходу в грі
class Turn extends CheckWinner{
	private $choosingWinner;

	public function getWin(){
		return $this->winner;
	}	
	public function __construct(){
		$i = 0;
		while (!$this->checkWin('X') && !$this->checkWin('O') && $i < 9)//Цикл перевірки стану перемоги
		{
			$this->choosingWinner = new ChoosingWinner($_POST["choose"]);//Виконання рішень по ходу в залежності від обраної комірки
			$this->winner = $this->choosingWinner->getWinner();
			if($this->winner)//Якщо переможець існує, не має сенсу перевіряти на перемогу
				break;
			$i++;
		}
		if(isset($_POST["choose"]))//Поміняти хід, якщо минулий був зроблений
			$_SESSION["fTurn"]->changeMark();
	}
}
//Визначення плину гри
class Playing extends Game{
	protected $winning;//Об'єкт перемоги	
	protected $nowWin;//Фіксація перемоги

	public function __construct()//Конструктор власне гри
	{
		$this->echoFirstTurn();//Вивід першого кроку, коли ще не було ніякого вводу
		if(isset($_POST["choose"])){//Якщо уже був виконаний ввід, переходимо до логічних операцій, визначень
			$this->echoTurn();//Вивід ходу
			$this->winning = new Turn;//Ходимо
			$this->takeWin();//Перевіряємо на перемогу
		}	
	}
	protected function takeWin(){
		if($this->winning->getWin() !== NULL){//Кінець гри, та повідомлення про перемогу відповідного гравця або нічиї
			$this->whatWinning();
			$this->nowWin = $this->winning->getWin();
			session_destroy();
		}
	}
	protected function whatWinning(){
		switch($this->winning->getWin()){
			case 1:
				echo "<span class=\"align-middle\"><br>Переміг гравець 'O'!</span>";
				break;
			case 0:
				echo "<span class=\"align-middle\"><br>Переміг гравець 'X'!</span>";
				break;
			case -1:
				echo "<br><center>Нічия.</center>";
				break;
		}
	}
	public function getW(){
		return $this->nowWin;
	}
	protected function echoTurn(){
		if($_SESSION["fTurn"]->getTurn())
			echo "Хід гравця O";
		else
			echo "Хід гравця X";
	}
	protected function echoFirstTurn(){
		if(empty($_SESSION["firstTime"])){
			if(!$_SESSION["fTurn"]->getTurn())
				echo "Хід гравця O";
			else
				echo "Хід гравця X";
		}
		$_SESSION["firstTime"] = true;
	}
}
?>