<?php
//
// Конттроллер страницы чтения.
//
class C_Page extends C_Base
{	
	private $sql;
	//
	// Конструктор.
	//
	function __construct() {
		$this->sql = new C_DataBase();
	}
	
	public function action_index(){
		if (isset($_GET['textId']) && $this->IsGet()) {
			$read = $this->sql->selectFromDB('name, contents', 'books', 'WHERE id='.$_GET['textId']);
			$readTexts = [];
			if (isset($_SESSION['readTexts'])) {
				$readTexts = $_SESSION['readTexts'];
				if (!array_keys($readTexts, $_GET['textId'])) {
					$readTexts[] = $_GET['textId'];
				}
			} else {
				$readTexts[] = $_GET['textId'];
				$_SESSION['readTexts'] = $readTexts;
			}
			$_SESSION['readTexts'] = $readTexts;
			setcookie("registered", $_POST['login'], time()+86400);
			$this->title .= '::'.$read[0]['name'];
			$this->content = $this->Template('v/v_index.php', ['text' => $read[0]['contents']]);
		} else {
			$this->title .= '::Чтение';
			$links = $this->sql->selectFromDB('id, name', 'books');
			$this->content = $this->Template('v/v_index.php', ['links' => $links]);
		}
	}
	
    
	// public function action_edit(){
	// 	$this->title .= '::Редактирование';
		
	// 	if($this->isPost())
	// 	{
	// 		text_set($_POST['text']);
	// 		header('location: index.php');
	// 		exit();
	// 	}
		
	// 	$text = text_get();
	// 	$this->content = $this->Template('v/v_edit.php', array('text' => $text));		
	// }
}
