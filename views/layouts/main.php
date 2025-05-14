<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-
    scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/pop-it-mvc/public/styles/styles.css?v=1.0.12">
    <title>Main site</title>
</head>
<body>
<header>
<?php
    if (app()->auth::check()):
    ?>
<div class="sidebar">
    <nav>
        <a href="<?= app()->route->getUrl('/departments') ?>">Кафедры</a>
        <a href="<?= app()->route->getUrl('/hello') ?>">Сотрудники</a>
        <a href="<?= app()->route->getUrl('/subjects') ?>">Дисциплины</a>
    </nav>
    <?php
    endif;
    ?>
    <?php
        if (!app()->auth::check()):
            ?>
            <!-- <a class="btn-login" href="<?= app()->route->getUrl('/login') ?>">Вход</a> -->
            <!-- <a href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a> -->
        <?php
        else:
            ?>
            <a class="btn-logout" href="<?= app()->route->getUrl('/logout') ?>">Выход</a>
        <?php
        endif;
        ?>
</div>
</header>
<main>
   <?= $content ?? '' ?>
</main>

</body>
</html>