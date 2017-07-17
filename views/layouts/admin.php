<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Панель администратора</title>

    <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="/views/css/style.css">
    <script type="text/javascript" src="/views/js/preview.js"></script>
</head>
<body>

<?php
    if($_SESSION['isLoggedIn'] == true):?>
        <ul>
            <li><a href="/admin/index?sort=user_name">Главная</a></li>
        </ul>
    <?php endif;?>

<?php include $this->app->getParam('viewsPath') . '/'  . $this->childCName . '/' . $this->view . '.php';?>
</body>
</html>