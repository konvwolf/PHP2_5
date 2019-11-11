<?php if ($registered === true): ?>
	Приветствуем, <?= $user[0]['name'] ?>!
	<br>
	Ваш порядковый номер в системе — <?= $user[0]['id'] ?>. Для входа на сайт вы используете логин <?= $user[0]['login'] ?>.
	<br>
	<a href="?c=users&act=logout">Разлогиниться</a>
	<br><br>
	<?php if ($texts): ?>
		Вы прочитали:
		<?php foreach($texts as $text): ?>
			<a href="index.php?c=page&textId=<?= $text[0]['id'] ?>" class="to_read"><?= $text[0]['name'] ?></a>
		<?php endforeach; ?>
	<?php endif; ?>
<?php else: ?>
	<?= 'Залогиньтесь или зарегистрируйтесь' ?>
<?php endif; ?>