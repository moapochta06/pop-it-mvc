<h3>Добавить кафедру</h3>

<?php if (!empty($errors)): ?>
    <div class="errors">
        <?php foreach ($errors as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="/departments">
    <label>
        Название:
        <input type="text" name="name" />
    </label>

    <label>
        Аббревиатура:
        <input type="text" name="abbreviation" maxlength="10" />
    </label>

    <button type="submit">Сохранить</button>
</form>