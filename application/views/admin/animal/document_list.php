<table class="item-list" id="organization-list">
    <thead
    <tr>
        <th class="id">№</th>
        <th class="document-name">Название</th>
        <th class="actions">Действия</th>
    </tr>
    </thead>
    <tbody>
        <? if(!$documents): ?>
            <tr class="empty"><td colspan="10">Нету документов</td></tr>
        <? else: foreach($documents as $ind => $doc): ?>
            <tr>
                <td class="id"><?=($ind + 1)?></td>
                <td class="document-name"><?=$doc->name?></td>
                <td class="actions">
                    <a href="#" onclick="return delete_document(event,'<?=$doc->id?>')" class="delete"></a>
                </td>
            </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>