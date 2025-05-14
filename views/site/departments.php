<!-- Форма показывается, если был GET-запрос -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['show_form'])): ?>
    <h3>добавление кафедры</h3>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>
            Название:
            <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
        </label>

        <label>
            Аббревиатура:
            <input type="text" name="abbreviation" maxlength="10" value="<?= htmlspecialchars($old['abbreviation'] ?? '') ?>">
        </label>
        <div class="subjects">
        <?php foreach ($subjects as $subject): ?>
            <label>
                <input type="checkbox" name="subjects[]" value="<?= htmlspecialchars($subject->id) ?>">
                <?= htmlspecialchars($subject->name) ?>
            </label>
        <?php endforeach; ?>
        </div>

        <button type="submit">Сохранить</button>
    </form>

<!-- Кнопка отправляет POST-запрос -->
<?php else: ?>
    <h2>Кафедры</h2>
    <form method="GET">
        <button type="submit" name="show_form" value="1" class="button dep-btn">
            <span>Добавить кафедру</span>
            <img src="img/plus.svg" alt="+" width="22" height="22">
        </button>
    </form>
    <?php if (!empty($departments)): ?>
        <div class="department-table">
            <div class="table-header">
                <span>название</span>
                <span>аббревиатура</span>
            </div>
    <?php if (!empty($departments)): ?>
        <?php foreach ($departments as $department): ?>
            <div class="table-row">
                <span><?= htmlspecialchars($department->name) ?></span>
                <span><?= htmlspecialchars($department->abbreviation) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>