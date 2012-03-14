<ul id="crumbs">
    <li>Породы</a></li>
</ul>

<table class="item-list" id="city-list">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Алиас</th>
        <th>Категория</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if (!$kinds): ?>
    <tr class="empty">
        <td colspan="10">Нету пород</td>
    </tr>
        <? else: foreach ($kinds as $kind): ?>
    <tr>
        <td class="id"><?=$kind->id?></td>
        <td class="kind-name"><?=$kind->name?></td>
        <td class="kind-alias"><?=$kind->alias?></td>
        <td class="animal-name"><?=$kind->animal->name?></td>
        <td class="actions">
            <a href="admin/kinds/<?=$kind->id?>" class="edit" title="Настройки породы"></a>
            <a href="admin/kinds/delete/<?=$kind->id?>" class="delete" title="Удалить породу"></a>
        </td>
    </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>

<?=form_open('admin/kinds/create') ?>
<div class="newitem-block">
    <p class="block-header">Новая порода</p>
    <div class="param">
        <label for="animal">Категория:</label>
        <select name="animal" id="animal">
            <? foreach(Animal::all() as $animal): ?>
                <option value="<?=$animal->id?>"><?=$animal->name?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div class="param">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name"/>
    </div>
    <div class="param">
        <label for="name">URL-alias:</label>
        <input type="text" id="alias" name="alias"/>
    </div>
    <input type="submit" class="noimg" value="Добавить"/>
</div>
</form>