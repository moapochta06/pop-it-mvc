<h2>Сотрудники</h2>
<button name="show_form" value="1" class="button choice-btn">
        <span>Выберите кафедру</span>
        <img src="img/arrow.svg" alt="+" width="22" height="22">
</button>
<a href="<?= app()->route->getUrl('/employee-form') ?>" class="button dep-btn add-btn">
    <span>Добавить сотрудника</span>
    <img src="img/plus.svg" alt="+" width="22" height="22">
</a>
<?php if (!empty($employees)): ?>
        <div class="employees-table">
            <div class="table-header-emp">
                <span>фамилия</span>
                <span>имя</span>
                <span>отчество</span>
                <span>кафедра</span>
                <span></span>
            </div>
    <?php if (!empty($employees)): ?>
        <?php $count = count($employees); ?>
        <?php foreach ($employees as $employee): ?>
            <div class="table-row-emp <?= ($count > 1) ? 'has-border' : '' ?>">
                <span><?= htmlspecialchars($employee->last_name) ?></span>
                <span><?= htmlspecialchars($employee->first_name) ?></span>
                <span><?= htmlspecialchars($employee->patronymic) ?></span>
                <span><?= htmlspecialchars($employee->department->abbreviation ?? 'Не указана') ?></span>
                <span><a href="<?= app()->route->getUrl('/employee/' . $employee->id) ?>">подробнее</a></span>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php endif; ?>