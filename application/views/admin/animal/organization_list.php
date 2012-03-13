<table class="item-list" id="organization-list">
    <thead
    <tr>
        <th class="id">№</th>
        <th class="organization-name">Название</th>
        <th class="organization-description">Описание</th>
        <th class="actions">Действия</th>
    </tr>
    </thead>
    <tbody>
        <? if(!$organizations): ?>
            <tr class="empty"><td colspan="10">Нету организаций</td></tr>
        <? else: foreach($organizations as $ind => $org): ?>
            <tr>
                <input type="hidden" class="organization_id" value="<?=$org->id?>"/>
                <td class="id"><?=($ind + 1)?></td>
                <td class="organization-name"><?=$org->name?></td>
                <td class="organization-description"><?=$org->description?></td>
                <td class="actions">
                    <a href="#" class="delete delete-organization"></a>
                </td>
            </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>