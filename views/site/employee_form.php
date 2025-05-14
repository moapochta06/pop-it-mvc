<h3>добавление сотрудника</h3>

<form action="<?= app()->route->getUrl('/add-employee') ?>" method="POST">
    <div class="form-group">
        <label for="last_name">Фамилия:</label>
        <input type="text" name="last_name" id="last_name" required>
    </div>

    <div class="form-group">
        <label for="first_name">Имя:</label>
        <input type="text" name="first_name" id="first_name" required>
    </div>

    <div class="form-group">
        <label for="patronymic">Отчество:</label>
        <input type="text" name="patronymic" id="patronymic">
    </div>

    <div class="form-group">
        <label for="gender">Пол:</label>
        <select name="gender" id="gender" required>
            <option value="">Выберите пол</option>
            <option value="мужской">Мужской</option>
            <option value="женский">Женский</option>
        </select>
    </div>

    <div class="form-group">
        <label for="birth_date">Дата рождения:</label>
        <input type="date" name="birth_date" id="birth_date" required>
    </div>

    <div class="form-group">
        <label for="department_id">Кафедра:</label>
        <select name="department_id" id="department_id" required>
            <option value="">Выберите кафедру</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department->id ?>">
                    <?= htmlspecialchars($department->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn-submit">Сохранить</button>
</form>