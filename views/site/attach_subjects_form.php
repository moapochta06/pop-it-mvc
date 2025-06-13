<h3>Выберите дисциплины для <?= htmlspecialchars($employee->last_name) ?></h3>

<form method="POST" action="<?= app()->route->getUrl('/employee/attach-subjects') ?>">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
    <input type="hidden" name="employee_id" value="<?= $employee->id ?>">

    <?php foreach ($subjects as $subject): ?>
        <label>
            <input type="checkbox" name="subjects[]" value="<?= $subject->id ?>">
            <?= htmlspecialchars($subject->name) ?>
        </label><br>
    <?php endforeach; ?>

    <button type="submit">Сохранить</button>
</form>

<a href="<?= app()->route->getUrl('/employee/' . $employee->id) ?>">Назад</a>
