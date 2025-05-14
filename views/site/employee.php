<h3>подробные сведения</h3>
<div class="employee-details">
    <div class="">
    <div class="detail-name">фамилия</div>
    <div class="detail-info"><?= htmlspecialchars($employee->last_name) ?></div>

    <div class="detail-name">имя</div>
    <div class="detail-info"><?= htmlspecialchars($employee->first_name) ?></div>

    <div class="detail-name">отчество</div>
    <div class="detail-info"><?= htmlspecialchars($employee->patronymic ?? '-') ?></div>
    </div>
    
    <div class="">
    <div class="detail-name">пол</div>
    <div class="detail-info"><?= $employee->gender === 'M' ? 'муж.' : 'жен.' ?></div>

    <div class="detail-name">дата рождения</div>
    <div class="detail-info"><?= date('d.m.Y', strtotime($employee->birth_date)) ?></div>

    <div class="detail-name">адрес прописки</div>
    <div class="detail-info"><?= htmlspecialchars($employee->address) ?></div>
    </div>
</div>
<div class="detail-name">кафедра</div>
    <div class="detail-info">
        <?= htmlspecialchars($employee->department->name ?? 'Не указана') ?>
    </div>

    <div class="detail-name">преподаваемые дисциплины</div>
    
    <div class="detail-info">
    <?php if (!$employee->subjects->isEmpty()): ?>
        <ul>
            <?php foreach ($employee->subjects as $subject): ?>
                <li><?= htmlspecialchars($subject->name) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Нет предметов</p>
    <?php endif; ?>

        <a href="<?= app()->route->getUrl('/employee/' . $employee->id . '/attach-subjects') ?>" class="button add-dis-btn">
            <span>Добавить дисциплину</span>
        </a>
 
    </div>
</div>
