<ul id="crumbs">
    <li>Виды животных</a></li>
</ul>

<table class="item-list" id="animal-list">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if (!$animals): ?>
    <tr class="empty">
        <td colspan="10">Нету животных</td>
    </tr>
        <? else: foreach ($animals as $animal): ?>
    <tr>
        <td class="id"><?=$animal->id?></td>
        <td class="animal-name"><?=$animal->name?></td>
        <td class="actions">
            <a href="admin/animals/<?=$animal->id?>" class="edit"></a>
        </td>
    </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>

<?=form_open('admin/animals/create') ?>
<div class="newcity-block">
    <p class="block-header">Новый вид</p>
    <div class="param">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name"/>
    </div>
    <input type="submit" class="noimg" value="Добавить"/>
</div>
</form>