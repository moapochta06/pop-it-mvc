<h3>Новый сотрудник деканата</h3>
<p><?= $message ?? ''; ?></p>
<form method="POST" action="<?= app()->route->getUrl('/add-user') ?>">
    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" required>
    </div>
    <div>
        <label for="login">Логин:</label>
        <input type="text" name="login" id="login" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Добавить пользователя</button>
</form>