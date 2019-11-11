<?php
//
// Конттроллер страницы чтения.
//
session_start();
include_once('m/M_User.php');

class C_User extends C_Base
{
	private $user;
	function __construct() {
		$this->user = new M_User();
	}
	
	function action_index() {
		if ($this->IsGet() && $_GET['user'] === $_SESSION['registered']) {
				$registered = true;
				$welcome = new C_DataBase();
				$userData = $welcome->selectFromDB('id, name, login', 'user', 'WHERE login=\''.$_GET['user'].'\'');
				if ($_SESSION['readTexts']) {
					foreach (array_slice($_SESSION['readTexts'], -3, 3) as $val) {
						$texts[] = $welcome->selectFromDB('id, name', 'books', 'WHERE id='.$val);
					}
				}
				$this->content = $this->Template('v/v_user.php', ['registered' => $registered, 'user' => $userData, 'texts' => $texts]);
		} else {
			$this->content = $this->Template('v/v_register.php');
		}
	}

	function action_register() {
		if($this->IsPost()) {
			$register = $this->user->userRegister($_POST['name'], $_POST['login'], $_POST['password']);
			if ($register === true) {
				$_SESSION['registered'] = $_POST['login'];
				header('location: index.php?c=users&user='.$_POST['login']);
			}
		}
		$this->content = $this->Template('v/v_register.php');
	}

	function action_login() {
		if($this->IsPost()) {
			$login = $this->user->userLogin($_POST['login'], $_POST['password']);
			if ($login) {
				$_SESSION['registered'] = $_POST['login'];
				header('location: index.php?c=users&user='.$_POST['login']);
			} else {
				header('location: index.php?c=users&act=register');
			}
		}
		$this->content = $this->Template('v/v_login.php');
	}

	function action_logout() {
		session_destroy();
		header('location: /');
	}
}