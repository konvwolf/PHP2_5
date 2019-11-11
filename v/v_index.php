<?php if (isset($links)): ?>
    <?php foreach ($links as $val): ?>
        <a href="index.php?textId=<?= $val['id'] ?>" class="to_read"><?= $val['name'] ?></a>
    <?php endforeach; ?>
<?php else: ?>
    <?= $text ?>
<?php endif; ?>