<ul id="crumbs">
    <li>Города</a></li>
</ul>

<table class="item-list" id="city-list">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if (!$cities): ?>
    <tr class="empty">
        <td colspan="10">Нету городов</td>
    </tr>
        <? else: foreach ($cities as $city): ?>
    <tr>
        <td class="id"><?=$city->id?></td>
        <td class="city-name"><?=$city->name?></td>
        <td class="actions">
            <a href="admin/cities/<?=$city->id?>" class="edit-city" title="Настройки города"></a>
            <a href="admin/cities/delete/<?=$city->id?>" class="delete" title="Удалить город"></a>
        </td>
    </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>

<?=form_open('admin/cities/create') ?>
<div class="newcity-block">
    <p class="block-header">Новый город</p>
    <div class="param">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name"/>
    </div>
    <input type="submit" class="noimg" value="Добавить"/>
</div>
</form>