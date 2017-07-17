<?php echo ($success) ? 'Задание успешно создано' : false?>

<form id="file-form" action="/default/create" method="post" enctype="multipart/form-data">

    <br>
        Имя пользователя
        <input type="text" id="userName" name="userName">
    </br>
    <br>
        Имеил
        <input type="text" id="email" name="email"></br>
    <br>
        Описание задачи
        <input type="text" id="description" name="description"></br>

    <br>
        Укажите фото (JPG/GIF/PNG)
        <input id="file" type="file" name="photo">
    </br>
    <br>
        <input type="submit" value="Создать">
    </br>
</form>

<button id="viewButton">Посмотреть превью</button>

<div id="previewDiv" style="display: none;">
    <br>Имя
        <span id="prewUserName"></span>
    <br>
    <br>Описание
        <span id="prewDescription"></span>
    <br>
    <br>Имеил
        <span id="prewEmail"></span>
    <br>
    <br>Фото
        <img id="prewPhoto"></img>
    <br>
</div>

