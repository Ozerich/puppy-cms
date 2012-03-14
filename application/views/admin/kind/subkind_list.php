<table class="item-list" id="subkind-list">
    <thead
    <tr>
        <th>№</th>
        <th>Название</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if ($subkinds): foreach ($subkinds as $ind=>$subkind): ?>
    <tr>
        <input type="hidden" class="subkind_id" value="<?=$subkind->id?>"/>
        <td><?=($ind + 1)?></td>
        <td><?=$subkind->name?></td>
        <td class="actions">
            <a href="#" class="delete-subkind delete"></a>
        </td>
    </tr>
        <? endforeach; else: ?>
    <tr class="empty">
        <td colspan="10">Нет под-пород</td>
    </tr>
        <? endif; ?>
    </tbody>
</table>