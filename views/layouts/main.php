<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Список задач</title>

    <meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="/views/css/style.css">
    <script type="text/javascript" src="/views/js/preview.js"></script>
</head>
<body>
    <ul>
        <li><a href="/default/index?sort=user_name">Главная</a></li>
        <li><a href="/default/create">Создать</a></li>
    </ul>


    <?php include $this->app->getParam('viewsPath') . '/'  . $this->childCName . '/' . $this->view . '.php';?>
</body>
</html>