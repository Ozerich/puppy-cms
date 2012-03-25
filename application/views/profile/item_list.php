<? if (empty($items)): ?>
<div class="profile-empty">
    У вас нет объявлений
</div>
<? else: ?>
<table id="profile-list">
    <thead>
    <tr>
        <th>Фотография</th>
        <th>Порода</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>Цена на сайте</th>
        <th>Вес/рост кг/cм</th>
        <th>Документы</th>
        <th>Статус и тип объявления</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        <? foreach ($items as $item): ?>
    <tr>

    </tr>
        <? endforeach; ?>
    </tbody>
</table>
<? endif; ?>