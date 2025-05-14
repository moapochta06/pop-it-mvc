<h2>Дисциплины</h2>
<form method="GET">
        <button type="submit" name="show_form" value="1" class="button dep-btn">
            <span>Добавить дисциплину</span>
            <img src="img/plus.svg" alt="+" width="22" height="22">
        </button>
</form>
<?php if (!empty($subjects)): ?>
        <div class="subjects-table">
            <div class="table-header">
                <span>название</span>
            </div>
    <?php if (!empty($subjects)): ?>
        <?php $count_sub = count($subjects); ?>
        <?php foreach ($subjects as $subject): ?>
            <div class="table-subjects-row <?= ($count_sub > 1) ? ' has-border' : '' ?>">
                <span><?= htmlspecialchars($subject->name) ?></span>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php endif; ?>