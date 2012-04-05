<? if (empty($items)): ?>
<div class="profile-empty">
    У вас нет объявлений
</div>
<? else: ?>
<table id="profile_list">
    <thead>
    <tr>
        <th class="photo">Фотография</th>
        <th class="kind">Порода</th>
        <th class="sex">Пол</th>
        <th class="birthday">Дата рождения</th>
        <th class="price">Цена на сайте</th>
        <th>Вес / рост</th>
        <th>Документы</th>
        <th>Статус и тип объявления</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
        <? foreach ($items as $item): ?>
    <tr>
        <td class="photo"><img src="<?=$image_dir.$item->image?>"</td>
        <td class="kind"><?=$item->kind->name?></td>
        <td class="sex"><?=$item->sex == 'man' ? 'мал.': 'дев.'?></td>
        <td class="birthday"><?=$item->birthday->format('d.m.Y')?></td>
        <td class="price"><?=$item->site_price?></td>
        <td class="weight"><?=$item->weight ? $item->weight .'кг.' : ''?><?=$item->weight && $item->height ? ' / ' : ''?><?=$item->height ? $item->height .'кг.' : ''?></td>
        <td class="documents">
            <? foreach($item->documents as $doc): ?>
                <?=$doc->name."<br/>"?>
            <? endforeach; ?>
        </td>
        <td class="status">
            <? if($item->type == 'free'): ?>Бесплатное объявление<? endif; ?>
            <? if($item->type == 'paid_1'): ?>Платное "недорого"<? endif; ?>
            <? if($item->type == 'paid_2'): ?>Платное "без проблем"<? endif; ?>
        </td>
        <td class="actions">
            <a href="#">Редактировать</a>
            <a href="#">Просмотреть</a>
            <a href="#">Снять с продажи</a>
            <a href="#">Опубликовать</a>
        </td>
    </tr>
        <? endforeach; ?>
    </tbody>
</table>
<? endif; ?>