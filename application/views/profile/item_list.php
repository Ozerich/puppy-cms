<? if (empty($items)): ?>
<div class="profile-empty">
    У вас нет объявлений
</div>
<? else: ?>
<table id="profile_list">
    <thead>
    <tr>
        <th class="photo-col">Фотография</th>
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
        <td class="photo-col"><img width="80" src="<?=Config::get('item_images_dir') . $item->image?>"</td>
        <td class="kind-col"><?=$item->kind->name?>
        <td class="sex-col"><?=$item->sex == 'man' ? 'муж.' : 'жен.'?></td>
        <td class="birthday-col"><?=$item->birthday->format('d.m.Y');?></td>
        <td class="price-col"><?=$item->site_price?></td>
        <td class="weight-col">
            <?=$item->kind->is_weight ? $item->weight . ' кг.' : ''?>
            <?=$item->kind->is_height && $item->kind->is_weight ? ' / ' : ''?>
            <?=$item->kind->is_height ? $item->height . ' см.' : ''?>
        </td>
        <td class="documents-col">
            <? foreach (ItemDocument::get($item->id) as $document): ?>
            <?= $document ?><br/>
            <? endforeach; ?>
        </td>
        <td class="status-col">
            <?=$item->plain_status?>
            </br>
            <?=$item->plain_paidtype?>
        </td>
        <td class="actions-col">

            <? if ($item->status == 'created' || $item->status == 'edited' || $item->status == 'public' || $item->status == 'canceled'): ?>
            <div class="action">
                <a href="edit/<?=$item->id?>">Редактировать</a>

                <div class="baloon">После редактирования объявление будет снято с сайта до проверки администратором
                    (проверка может занять от 1 до 16 часов)
                </div>
            </div>
            <? endif; ?>

            <div class="action">
                <a href="view/<?=$item->id?>">Посмотреть</a>
            </div>

            <? if ($item->status == 'public'): ?>
            <div class="action">
                <a href="#" onclick="return profile_change_status(event, '<?=$item->id?>', 'canceled')">Снять с
                    продажи</a>
                <span class="result-status">Снято</span>

                <div class="baloon">
                    Объявление будет снято с главной страницы сайта, но всегда останется доступно Вам.
                </div>
            </div>
            <? endif; ?>
            <? if ($item->status == 'canceled'): ?>

            <div class="action">
                <a href="#" onclick="return profile_change_status(event, '<?=$item->id?>', 'public')">Опубликовать</a>
                <span class="result-status">На проверке</span>

                <div class="baloon">
                    Нажмите, если нужно опубликовать объявление, срок которого истек.
                    Внимание! Объявление не будет опубликовано, если цена щенка завышена или фотографии устаревшие.
                </div>
            </div>

            <? endif; ?>

        </td>
    </tr>
        <? endforeach; ?>
    </tbody>
</table>
<? endif; ?>