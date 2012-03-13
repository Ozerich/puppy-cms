<table class="item-list" id="commission-list">
    <thead
    <tr>
        <th>От</th>
        <th>До</th>
        <th>Комиссия</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if ($commissions): foreach ($commissions as $commission): ?>
    <tr>
        <input type="hidden" class="commission_id" value="<?=$commission->id?>"/>
        <td><?=$commission->from?></td>
        <td><?=$commission->to?></td>
        <td><?=$commission->value?></td>
        <td class="actions">
            <a href="#" class="delete-commission delete"></a>
        </td>
    </tr>
        <? endforeach; else: ?>
    <tr class="empty">
        <td colspan="10">Нет комиссии</td>
    </tr>
        <? endif; ?>
    </tbody>
</table>