<thead>
<tr>
    <th class="num">№</th>
    <th class="status">Статус</th>
    <th class="date">Создано</th>
    <th class="date">Снято (время прод.)</th>
    <th class="date">Опубл. до</th>
    <th class="date">Отредакт.</th>
</tr>
</thead>
<tbody>
<?if (!$items): ?>
<tr class="empty">
    <td colspan="10">Нету объявлений</td>
</tr>
    <? else: foreach ($items as $item): ?>
<tr class="item-line">
    <td class="num"><a href="view/<?=$item->id?>"><?=$item->id?></a></td>
    <td class="status"><?=$item->plain_status?></td>
    <td class="date"><?=$item->created_time ? $item->created_time->format('d.M.y') : '-'?></td>
    <td class="date"><?=$item->closed_time ? $item->closed_time->format('d.M.y') : '-'?></td>
    <td class="date"><?=$item->finish_time ? $item->finish_time->format('d.M.y') : '-'?></td>
    <td class="date"><?=$item->changed_time ? $item->changed_time->format('d.M.y') : '-'?></td>
</tr>
<tr class="item-admin" style="display: none;">
    <td colspan="10">
        <div class="item-admin-block">
            <form>
                <span class="item-header"><?=$item->preview_header?></span><a class="edit-link"
                                                                              href="edit/<?=$item->id?>">Редактировать</a>
                <select class="item-status" name="status" id="status_<?=$item->id?>">
                    <option <?=$item->status == "created" ? 'selected' : ''?> value="created">Новое. Ждет
                        модерации
                    </option>
                    <option <?=$item->status == "edited" ? 'selected' : ''?> value="edited">Отредактировано.
                        Ждет
                        модерации
                    </option>
                    <option <?=$item->status == "saled" ? 'selected' : ''?> value="saled">Щенок продан.
                        Редактирование не возможно
                    </option>
                    <option <?=$item->status == "public" ? 'selected' : ''?> value="public">Опубликовано
                    </option>
                    <option <?=$item->status == "finished" ? 'selected' : ''?>  value="finished">Снято
                    </option>
                    <option <?=$item->status == "canceled" ? 'selected' : ''?> value="canceled">Временно
                        снято
                    </option>
                </select>

                <div class="status-params"
                     id="status_<?=$item->id?>_public" <?=$item->status == 'public' ? 'style="display:block"' : ''?>>
                    <label for="publish_<?=$item->id?>">Опубликовано до:</label>
                    <input name="publish_till" type="text"
                           value="<?=$item->finish_time ? $item->finish_time->format('d.m.Y') : ''?>"
                           class="publish-till" id="publish_<?=$item->id?>"/>
                </div>
                <div class="status-params"
                     id="status_<?=$item->id?>_saled" <?=$item->status == 'saled' ? 'style="display:block"' : ''?>>
                    <label>Продан:</label>
                    <label for="saledby_site_<?=$item->id?>"><input <?=$item->saled_by == 'site' ? 'checked="checked"' : ''?>
                            type="radio" id="saledby_site_<?=$item->id?>"
                            name="saled_by" value="site"/>Сайтом</label>
                    <label for="saledby_plant_<?=$item->id?>"><input <?=$item->saled_by == 'plant' ? 'checked="checked"' : ''?>
                            type="radio" id="saledby_plant_<?=$item->id?>"
                            name="saled_by" value="plant"/>Заводчиком</label>
                </div>
                <div class="medals">
                    <? $item_medals = ItemMedal::get_medals($item->id);
                    foreach (Medal::all() as $ind => $medal): ?>
                        <label><?=$medal->name?>
                            <input <?=$item_medals[$medal->id] ? 'checked="checked"' : '' ?>
                                    type="checkbox" name="medals[<?=$ind?>]"
                                    value="<?=$medal->id?>"/></label>
                        <? endforeach; ?>
                </div>
                <div class="options">
                    <div class="option">
                        Отображать на главной <input
                            type="radio" <?=$item->display_mainpage ? 'checked="checked"' : ''?>
                            name="mainpage_show" value="1"/>Да
                        <input type="radio" name="mainpage_show"
                            <?=!$item->display_mainpage ? 'checked="checked"' : ''?>
                               value="0">Нет
                    </div>
                </div>

                <input type="hidden" class="item_id" value="<?=$item->id?>"/>

                <div class="item-bottom">
                    <img class="loading" src="img/item-loader.gif"/>
                    <button class="save-item">Сохранить</button>
                    <br clear="all"/>
                </div>
            </form>
        </div>
    </td>
</tr>
    <? endforeach; ?>
    <? endif; ?>
</tbody>