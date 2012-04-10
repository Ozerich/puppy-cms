<?= $admin_filter ?>

<div id="admin_user_list">
    <? if (!isset($users) || !$users): ?>
    <div class="no-items">
        <p>Пользователей не найдено</p>
    </div>
    <? else: ?>
    <table>
        <thead>
        <tr>
            <th class="name">Имя</th>
            <th class="surname">Фамилия</th>
            <th class="email">email</th>
            <th class="phone">Телефон</th>
            <th class="city">Город</th>
            <th class="sell">Продано</th>
            <th class="best">Лучший</th>
            <th class="items">Щенки</th>
        </tr>
        </thead>
        <tbody>
            <? foreach ($users as $user): ?>
                <tr onclick="document.location='user/<?=$user->id?>'">
                    <td class="name"><?=$user->name?></td>
                    <td class="name"><?=$user->surname?></td>
                    <td class="email"><a href="mailto:<?=$user->email?>"><?=$user->email?></a></td>
                    <td class="phone"><?=$user->phone?></td>
                    <td class="city"><?=$user->city ? $user->city->name : 'Не установлен'?></td>
                    <td class="sell">C-<?=$user->sell_site?>, З-<?=$user->sell_plant?></td>
                    <td class="best"><?=$user->is_best ? 'Да' : 'Нет'?></td>
                    <td class="items">
                        <? foreach($user->items as $item): ?>
                            <a href="view/<?=$item->id?>"><?=$item->id?></a>
                        <? endforeach; ?>
                    </td>
                    <td class="actions">
                        <a href="#" class='edit-link'></a>
                    </td>
                </tr>
            <? endforeach; ?>
        </tbody>
    </table>
    <?endif; ?>
</div>