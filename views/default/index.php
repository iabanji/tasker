Список задач

<style>
    .pagination {
        display: inline-block;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .pagination a:hover:not(.active) {background-color: #ddd;}
</style>

<br><a href="?sort=user_name">Сортировать по имени пользователя</a></br>
<br><a href="?sort=email">Сортировать по имейлу</a></br>
<br><a href="?sort=stat">Сортировать по Статусу</a></br>
<table>
    <tr>
        <th>Имя пользователя</th>
        <th>Имеил</th>
        <th>Описание</th>
        <th>Статус</th>
        <th>Изображение</th>
    </tr>

    <?php foreach($tasks as $task): ?>
        <?php $src =  '/uploads/' . $task['img_path'];?>
        <tr>
            <td><?=$task['user_name']; ?></td>
            <td><?=$task['email']; ?></td>
            <td><?=$task['description']; ?></td>
            <td><?=($task['stat'] == 1) ? 'Сделано' : 'В процессе'; ?></td>
            <td><img src="<?=$src ?>" alt=""></td>
        </tr>
    <?php endforeach;?>


</table>

<?php // var_dump($_SERVER['REQUEST_URI'])?>
<br>
<div class="pagination">
    <?php for($i=1; $i <= $pagination->range; $i++):?>
        <?php
            if(isset($_GET['sort']))
            {
                $href = '?sort=' . $_GET['sort'] . '&curPage=' . $i;
            }else{
                $href = '?curPage=' . $i;
            }
           // echo $href;
        ?>
        <?php if(isset($_GET['curPage']) && $_GET['curPage'] == $i)
        {
            echo "<a class='active' href='{$href}'>$i</a>";
        }else{
            echo "<a href='{$href}'>$i</a>";
        } ?>

    <?php endfor;?>


</div>