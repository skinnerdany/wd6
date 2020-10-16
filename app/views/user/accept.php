<table>
    <tr>
        <th>
            Логин
        </th>
        <th>
            Ссылка
        </th>
        <th>
            Статус
        </th>
    </tr>
    <?php foreach ($users as $user) { ?>
    <tr>
        <td><?php echo $user['email']; ?></td>
        <td><a href="/user/login?token=<?php echo $user['token']; ?>"><?php echo $user['token']; ?></a></td>
        <td><?php echo $user['status'] == 1 ? 'Неподтвержденная' : 'Сброс пароля'; ?></td>
    </tr>
    <?php } ?>
</table>