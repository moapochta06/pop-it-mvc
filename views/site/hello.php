<h2>Сотрудники</h2>
    <pre><?= $message ?? ''; ?></pre>
    <button name="show_form" value="1" onclick="document.getElementById('search-form').style.display = 'inline-flex'" class="button choice-btn">
    <span>Найти сотрудника</span>
    <img src="<?= app()->route->getUrl('/img/arrow.svg') ?>" alt="+" width="22" height="22">
</button>

<!-- Форма поиска -->
<div id="search-form" style="display: none;">
    <form method="GET" action="<?= app()->route->getUrl('/employee/search') ?>">
        <input type="text" name="query" placeholder="Введите параметры" >
        <button type="submit">Поиск</button>
    </form>
</div>

<a href="<?= app()->route->getUrl('/employee-form') ?>" class="button dep-btn add-btn">
    <span>Добавить сотрудника</span>
    <img src="<?= app()->route->getUrl('/img/plus.svg') ?>" alt="+" width="22" height="22">
</a>

<?php if (!empty($search_query)): ?>
    <p>Результаты поиска по запросу: <strong><?= htmlspecialchars($search_query) ?></strong></p>
<?php endif; ?>

<?php if (!empty($employees)): ?>
    <div class="employees-table">
        <div class="table-header-emp">
            <span>Фамилия</span>
            <span>Имя</span>
            <span>Отчество</span>
            <span>Кафедра</span>
            <span>Подробнее</span>
        </div>

        <?php foreach ($employees as $employee): ?>
            <div class="table-row-emp">
                <span><?= htmlspecialchars($employee->last_name) ?></span>
                <span><?= htmlspecialchars($employee->first_name) ?></span>
                <span><?= htmlspecialchars($employee->patronymic ?? '') ?></span>
                <span><?= htmlspecialchars($employee->department->abbreviation ?? 'Не указана') ?></span>
                <span><a href="<?= app()->route->getUrl('/employee/' . $employee->id) ?>">подробнее</a></span>
            </div>
        <?php endforeach; ?>
    </div>
<?php elseif (!empty($search_query)): ?>
    <p>Ничего не найдено по запросу: <?= htmlspecialchars($search_query) ?></p>
<?php endif; ?>



