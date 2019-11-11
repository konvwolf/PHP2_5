<?php
/**
 * Основной шаблон
 * ===============
 * $title - заголовок
 * $content - HTML страницы
 */
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?=$title?></title>
	<meta content="text/html; charset=Windows-1251" http-equiv="content-type">	
	<link rel="stylesheet" type="text/css" media="screen" href="v/style.css" /> 	
</head>
<body>
	<div id="header">
		<h1><?=$title?></h1>
	</div>
	
	<div id="menu">
		| <a href="/">Главная</a> |
		<?php if ($_SESSION['registered']): ?>
			<a href="index.php?c=users&user=<?= $login ?>">Личный кабинет</a> |
		<?php else: ?>
			<a href="index.php?c=users&act=register">Зарегистрироваться</a> |
			<a href="index.php?c=users&act=login">Залогиниться</a> |
		<?php endif; ?>
	</div>
	
	<div id="content">
		<?=$content?>
	</div>
	
	<div id="footer">
		Все права защищены. Адрес. Телефон.
	</div>
</body>
</html>
