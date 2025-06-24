<?php if (!empty($users)): ?>
    <?php foreach ($users as $user): ?>
        <p> Имя: <?= $user['name'] ?></p>
        <p> Фамилия: <?= $user['surname'] ?></p>
        <p> Эл. Почта: <?= $user['email'] ?></p>
        <p> Год рождения: <?= $user['year_of_birth'] ?></p>
        <br>
        <button type="button" value="Удалить"> <a href="/delete/?id=<?=$user['id']?>">Удалить</a></button>
    <?php endforeach; ?>
<?php endif; ?>