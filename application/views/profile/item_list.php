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

            <div class="action">
                <a href="edit/<?=$item->id?>">Редактировать</a>

                <div class="baloon">После редактирования объявление будет снято с сайта до проверки администратором
                    (проверка может занять от 1 до 16 часов)
                </div>
            </div>

            <div class="action">
                <a href="view/<?=$item->id?>">Посмотреть</a>
            </div>

            <div class="action">
                <a href="#">Снять с продажи</a>

                <div class="baloon">
                    Объявление будет снято с главной страницы сайта, но всегда останется доступно Вам.
                </div>
            </div>

            <div class="action">
                <a href="#">Опубликовать</a>

                <div class="baloon">
                    Нажмите, если нужно опубликовать объявление, срок которого истек.
                    Внимание! Объявление не будет опубликовано, если цена щенка завышена или фотографии устаревшие.
                </div>
            </div>

        </td>
    </tr>
        <? endforeach; ?>
    </tbody>
</table>
<? endif; ?>