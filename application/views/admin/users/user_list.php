<table class="item-list" id="user-list">
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя, Фамилия</th>
        <th>Тип</th>
        <th>E-mail</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if (isset($users) && $users):
        foreach ($users as $user): ?>
        <tr>
            <td class="id"><?=$user->id?></td>
            <td class="name"><?=$user->name.' '.$user->surname?></td>
            <td class="type"><?=$user->plain_type?></td>
            <td class="email"><?=$user->email?></td>
            <td class="address"><?=$user->plain_address?></td>
            <td class="phone"><?=$user->phone?></td>
            <td class="actions">
                <a href="admin/users/<?=$user->id?>" class="edit-user" title="Редактировать"></a>
                <a href="admin/users/delete/<?=$user->id?>" class="delete-user" title="Удалить пользователя"></a>
            </td>
        </tr>
            <? endforeach;
    else: ?>
    <tr class="empty">
        <td colspan="20">Нету пользователей</td>
    </tr>
        <? endif; ?>
    </tbody>
</table>