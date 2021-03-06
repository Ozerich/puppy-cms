<?=isset($admin_filter) ? $admin_filter : '' ?>
<?php //echo $city_alias;
//echo $kind_alias;
?>
<div id="item_list">
<? if (!isset($items) || !$items): ?>
    <div class="no-items">
        <p> Объявлений не найдено</p>
    </div>
<? else: ?>
    <? $counter = 0;
    foreach ($items as $item): ?>
        <div class="item-block">
            <div class="item-image">

                <? if (isset($city_alias_zig) && isset($kind_alias_zig)) { ?>

                    <? if(empty($kind_alias_zig)){
                        $kind_alias_zig = $item->getKindAlias();
                    };
                    ?>
                    <a href="/<?= $city_alias_zig ?>/<?= $kind_alias_zig ?>_<?= $item->id ?>"><img
                            src="<?= $item->preview_image ?>" alt="<?= $item->preview_header ?>"
                            title="<?= $item->preview_header ?>"/></a>
                <? } else if (isset($alias_kind_zig_arr) && isset($alias_city_zig_arr)) { ?>
                    <a href="/<?= $alias_city_zig_arr[$counter] ?>/<?= $alias_kind_zig_arr[$counter] ?>_<?= $item->id ?>"><img
                            alt="<?= $item->preview_header ?>" title="<?= $item->preview_header ?>"
                            src="<?= $item->preview_image ?>"/></a>

                <? } else { ?>
                    <a target="_blank" href="view/<?= $item->id ?>"><img alt="<?= $item->preview_header ?>"
                                                                         title="<?= $item->preview_header ?>"
                                                                         src="<?= $item->preview_image ?>"/></a>
                <? } ?>


            </div>
            <div class="item-content-wr">
                <div class="item-main-content">
                    <div class="item-info">
                        <span class="item-price"><?=$item->site_price?> <?=$item->city->valute?></span>

                        <div class="item-medals">
                            <? $item_medals = ItemMedal::get_medals($item->id);
                            foreach ($item_medals as $ind => $medal): if (!$medal) continue;
                                $medal = Medal::find_by_id($ind);?>
                                <img alt="<?= $medal->alt ?>" title="<?= $medal->title ?>"
                                     src="<?= Config::get('medals_dir') . $medal->filename ?>"/>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="item-content">

                        <? if (isset($city_alias_zig) && isset($kind_alias_zig)) { ?>
                            <a href="/<?= $city_alias_zig ?>/<?= $kind_alias_zig ?>_<?= $item->id ?>">
                                <?=$item->preview_header?></a>
                        <? } else if (isset($alias_kind_zig_arr) && isset($alias_city_zig_arr)) { ?>
                            <a href="/<?= $alias_city_zig_arr[$counter] ?>/<?= $alias_kind_zig_arr[$counter] ?>_<?= $item->id ?>">
                                 <?=$item->preview_header?></a>

                        <? } else { ?>
                            <a target="_blank" class="item-link" href="view/<?= $item->id ?>">
                                 <?=$item->preview_header?></a>
                        <? } ?>



                        <? $text = $item->preview_text;
                        $first = mb_substr($text, 0, 500);
                        $last = mb_substr($text, 500);

                        ?>

                        <p>
                            <?=$first?><? if ($last): ?>

                                <? if (isset($city_alias_zig) && isset($kind_alias_zig)) { ?>
                                    <a href="/<?= $city_alias_zig ?>/<?= $kind_alias_zig ?>_<?= $item->id ?>">далее...</a>
                                <? } else if (isset($alias_kind_zig_arr) && isset($alias_city_zig_arr)) { ?>
                                    <a href="/<?= $alias_city_zig_arr[$counter] ?>/<?= $alias_kind_zig_arr[$counter] ?>_<?= $item->id ?>">далее...</a>

                                <? } else { ?>
                                    <a href="view/<?= $item->id ?>">далее...</a>
                                <? } ?>



                                <span class="more-text" style="display: none"><?=$last?></span>
                            <? endif; ?>
                        </p>

                    </div>
                    <br clear="all"/>
                </div>
                <div class="item-bottom">
                    <div class="item-actions">

                        <? if (isset($city_alias_zig) && isset($kind_alias_zig) && trim($city_alias_zig) != "" && trim($kind_alias_zig) != "") { ?>
                            <a href="/<?= $city_alias_zig ?>/<?= $kind_alias_zig ?>_<?= $item->id ?>">далее...</a>
                        <? } else if (isset($alias_kind_zig_arr) && isset($alias_city_zig_arr)) { ?>
                            <? if (trim($alias_city_zig_arr[$counter]) != "" && trim($alias_kind_zig_arr[$counter]) != "") { ?>
                                <a href="/<?= $alias_city_zig_arr[$counter] ?>/<?= $alias_kind_zig_arr[$counter] ?>_<?= $item->id ?>">далее...</a>
                            <? } else { ?>
                                <a href="view/<?= $item->id ?>">далее...</a>
                            <? }
                        } else { ?>
                            <a href="view/<?= $item->id ?>">далее...</a>
                        <? } ?>


                        <? if ($this->user && $this->user->access_edit): ?>
                            <a class="edit-open" href="view/<?= $item->id ?>">Управление</a>
                        <? endif; ?>
                    </div>
                    <div class="item-bottom-text">
                        <? if ($item->type == "paid_2"): ?>
                            Отправьте смс с текстом "ajp<?= $item->id ?>" (английские буквы!) на короткий номер 4448 и в ответ получите номер телефона владельца щенка. Стоимость смс 60р.
                        <? else: ?>
                            <? if ($this->user && $this->user->access_edit): ?>
                                <?= $item->user->plain_contact . ' - ' . $item->price ?>

                                <br/><br/>
                                <?= $item->user->information ?><br/>
                                <a href="/user/<?= $item->user_id ?>">Редактировать пользователя</a>
                            <? else: ?>
                                <?=
                                $item->type != 'free' ? $item->user->phone . " " . $item->user->name : '';?>
                                  <?//  KindSetting::get($item->main_kind_id, $item->city_id)->phone . ' Консультант по породе бесплатно поможет вам выбрать ' . ($item->animal_id == 1 ? 'щенка' : 'котёнка') . ', посоветует питомник и даст номер телефона заводчика у которого вы сможете посмотреть и купить ' . ($item->animal_id == 1 ? 'щенка' : 'котёнка')?>
                                <br/>
                            <? endif; ?>
                        <? endif; ?>
                    </div>
                    <br clear="all"/>
                </div>
            </div>
        </div>
        <? if ($this->user && $this->user->access_edit): ?>
            <div class="item-admin">
                <input type="hidden" class="item-id" value="<?= $item->id ?>"/>

                <form action="#">
                    <div class="admin-preview">
                        <?=$item->preview_header?>
                        <a href="edit/<?= $item->id ?>">Редактировать</a>
                        <br clear="all"/>
                    </div>
                    <div class="dates">
                        <div class="date">
                            <label>Создано:</label><span><?=$item->created_time ? $item->created_time->format('d.m.y h:i') : '-'?></span>
                        </div>
                        <div class="date">
                            <label>Изменено:</label><span><?=$item->changed_time ? $item->changed_time->format('d.m.y h:i') : '-'?></span>
                        </div>
                        <div class="date"><label>Опубликовано
                                с:</label><span><?=$item->publish_time ? $item->publish_time->format('d.m.y h:i') : '-'?></span>
                        </div>
                        <div class="date"><label>Опубликовано
                                до:</label><span><?=$item->finish_time ? $item->finish_time->format('d.m.y h:i') : '-'?></span>
                        </div>
                        <div class="date">
                            <label>Снято:</label><span><?=$item->closed_time ? $item->closed_time->format('d.m.y h:i') : '-'?></span>
                        </div>
                        <div class="date">
                            <label>Тип объявления:</label>
                            <span><?=$item->plain_paidtype?></span>
                        </div>
                        <br clear="all"/>
                    </div>
                    <div class="status">
                        <label for="status_<?= $item->id ?>">Статус объявления:</label>
                        <select class="item-status" name="status" id="status_<?= $item->id ?>">
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
                            <option <?=$item->status == "finished" ? 'selected' : ''?>  value="finished">Снято</option>
                            <option <?=$item->status == "canceled" ? 'selected' : ''?> value="canceled">Временно снято
                            </option>
                        </select>

                        <div class="status-params"
                             id="status_<?= $item->id ?>_public" <?=$item->status == 'public' ? 'style="display:block"' : ''?>>
                            <label for="publish_<?= $item->id ?>">Опубликовано до:</label>
                            <input name="publish_till" type="text"
                                   value="<?= $item->finish_time ? $item->finish_time->format('d.m.Y') : '' ?>"
                                   class="publish-till" id="publish_<?= $item->id ?>"/>
                        </div>
                        <div class="status-params"
                             id="status_<?= $item->id ?>_saled" <?=$item->status == 'saled' ? 'style="display:block"' : ''?>>
                            <label>Продан:</label>
                            <label
                                for="saledby_site_<?= $item->id ?>"><input <?=$item->saled_by == 'site' ? 'checked="checked"' : ''?>
                                    type="radio" id="saledby_site_<?= $item->id ?>"
                                    name="saled_by" value="site"/>Сайтом</label>
                            <label
                                for="saledby_plant_<?= $item->id ?>"><input <?=$item->saled_by == 'plant' ? 'checked="checked"' : ''?>
                                    type="radio" id="saledby_plant_<?= $item->id ?>"
                                    name="saled_by" value="plant"/>Заводчиком</label>
                        </div>
                    </div>
                    <div class="medals">
                        <? $item_medals = ItemMedal::get_medals($item->id);
                        foreach (Medal::all() as $ind => $medal): ?>
                            <label><input <?=$item_medals[$medal->id] ? 'checked="checked"' : '' ?>
                                    type="checkbox" name="medals[<?= $ind ?>]"
                                    value="<?= $medal->id ?>"/><?=$medal->name?></label>
                        <? endforeach; ?>
                    </div>
                    <div class="options">
                        <div class="option">
                            Отображать на главной <input
                                type="radio" <?=$item->display_mainpage ? 'checked="checked"' : ''?>
                                name="mainpage_show" value="1"/>Да
                            <input type="radio"
                                   name="mainpage_show" <?=!$item->display_mainpage ? 'checked="checked"' : ''?>
                                   value="0">Нет
                        </div>
                        <div class="option">
                            <a href="user/<?= $item->user_id ?>">Написать автору</a></br>
                        </div>
                    </div>
                    <div class="submit-area">
                        <img class="loading" src="img/item-loader.gif"/>
                        <span class="error">Не все данные заполнены</span>
                        <span class="success">Объявление обновлено</span>
                        <button class="save-button" onclick="return update_item(event, '<?= $item->id ?>');">Сохранить
                        </button>
                        <a href="#" class="deleteitem">Удалить</a>
                        <span class="deleteitem deleted" style="display: none">Удалено</span>
                        <br clear="all"/>
                    </div>
                </form>
            </div>
        <? endif; ?>
        <? $counter++; endforeach; endif; ?>
</div>