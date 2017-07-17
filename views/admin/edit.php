<form method="post" action="/admin/update?id=<?=$task['id']; ?>">

    <br>Описание<input name="description" type="text" value="<?=$task['description']; ?>"></br>
    <br>
        <select name="status" id="">
            <option value="1">Сделано</option>
            <option value="0"<?php echo ($task['stat'] == 0) ? 'selected' : '';?>>В процессе</option>
        </select>
    </br>
    <input type="submit" value="Сохранить">
</form>