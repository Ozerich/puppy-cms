<div id="item_view" class="block">

    <div
        class="block-header"><? if($item->type == "paid2"): ?>
		<?=
		$item->type == 'free' ? KindSetting::get($item->main_kind_id, $item->city_id)->phone . ' бесплатная консультация по выбору щенка, рекомендуем только лучших!' : $item->user->phone
		?>
		<? endif; ?>
		</div>

    <div class="block-content item-block">
        <div class="left-wrapper">
            <div class="item-image">
                <a rel="photo" href="<?=$item->preview_image?>"><img src="<?=$item->preview_image?>" alt="<?=$item->preview_header?>" title="<?=$item->preview_header?>" /></a>
            </div>
            <div class="item-gallery">
                <p class="gallery-header">
                    <span>Галерея</span>
                    (нажмите на картинке для увеличения)
                </p>

                <div class="gallery-images">

                    <? $img_count = 1; foreach ($item->images as $image): if ($image->image): ?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?>
                        href="<?=Config::get('item_images_dir') . $image->image?>" rel="photo"><img title="<?=$item->preview_header?>" alt="<?=$item->preview_header?>" 
                                                                                                    src="<?=Config::get('item_images_dir') . $image->image?>"/></a>
                    <? endif; endforeach; ?>
                    <? if ($item->mother_image): ?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?>
                        href="<?=Config::get('item_images_dir') . $item->mother_image?>" rel="photo"><img title="Мама"
                                                                                                          src="<?=Config::get('item_images_dir') . $item->mother_image?>"/></a>
                    <? endif; ?>
                    <? if ($item->father_image): ?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?>
                        href="<?=Config::get('item_images_dir') . $item->father_image?>" rel="photo"><img title="Папа"
                                                                                                          src="<?=Config::get('item_images_dir') . $item->father_image?>"/></a>
                    <? endif; ?>
                </div>
            </div>
        </div>
        <div class="right-wrapper">
            <div class="top-content-wr">
                <div class="item-info">
                    <span class="item-price"><?=$item->site_price?> <?=$item->city->valute?></span>

                    <div class="item-medals">
                        <? $item_medals = ItemMedal::get_medals($item->id);
                        foreach ($item_medals as $ind => $medal): if (!$medal) continue;
                            $medal = Medal::find_by_id($ind);?>
                            <img alt="<?=$medal->alt?>" title="<?=$medal->title?>"
                                 src="<?=Config::get('medals_dir') . $medal->filename?>"/>
                            <? endforeach; ?>
                    </div>
                </div>
                <div class="top-content">
                    <h2><?=$item->preview_header?></h2>

                    <p><?=$item->preview_text?></p>
                </div>
               
				
		<?php //		<div class="item-bottom-text"> ?>
					<? //if($item->type == "paid_2"): ?>
			<?php //		Отправьте смс с текстом "ajp<?=$item->id?> <?php //" ?> <?php //(английские буквы!) на короткий номер 4448 и в ответ получите номер телефона владельца щенка. Стоимость смс 50-60р. в зависимости от оператора ?>
					<? //else: ?>
                    <? //if ($this->user && $this->user->access_edit): ?>
                    <?//= $item->user->plain_contact.' - '.$item->price ?>
                    <? //else: ?>
                    <?//=
                    //$item->type != 'free' ?  $item->user->phone . " " . $item->user->name :
                    //    KindSetting::get($item->main_kind_id, $item->city_id)->phone . ' Консультант по породе бесплатно поможет вам выбрать '.($item->animal_id == 1 ? 'щенка' : 'котёнка').', посоветует питомник и даст номер телефона заводчика у которого вы сможете посмотреть и купить '.($item->animal_id == 1 ? 'щенка' : 'котёнка')?>
                    <? //endif; ?>
                    <? //endif; ?>
    <?php //            </div> ?>
				
				
				
                <br clear="all"/>
            </div>
            <div class="main-content">

                <?=$item->full_text?>


            </div>

        </div>
    </div>
    <? if ($this->user && $this->user->access_edit): ?>
    <div class="item-admin" style="display:block; margin-top:10px;">
        <form action="#">
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
                <label for="status_<?=$item->id?>">Статус объявления:</label>
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
                    <option <?=$item->status == "finished" ? 'selected' : ''?>  value="finished">Снято</option>
                    <option <?=$item->status == "canceled" ? 'selected' : ''?> value="canceled">Временно снято
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
                    <label
                        for="saledby_site_<?=$item->id?>"><input <?=$item->saled_by == 'site' ? 'checked="checked"' : ''?>
                        type="radio" id="saledby_site_<?=$item->id?>"
                        name="saled_by" value="site"/>Сайтом</label>
                    <label
                        for="saledby_plant_<?=$item->id?>"><input <?=$item->saled_by == 'plant' ? 'checked="checked"' : ''?>
                        type="radio" id="saledby_plant_<?=$item->id?>"
                        name="saled_by" value="plant"/>Заводчиком</label>
                </div>
            </div>
            <div class="medals">
                <? $item_medals = ItemMedal::get_medals($item->id);
                foreach (Medal::all() as $ind => $medal): ?>
                    <label><input <?=$item_medals[$medal->id] ? 'checked="checked"' : '' ?>
                        type="checkbox" name="medals[<?=$ind?>]"
                        value="<?=$medal->id?>"/><?=$medal->name?></label>
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
                    <a href="user/<?=$item->user_id?>">Написать автору</a>
                </div>
            </div>
            <div class="submit-area">
                <img class="loading" src="img/item-loader.gif"/>
                <span class="error">Не все данные заполнены</span>
                <span class="success">Объявление обновлено</span>
                <button class="save-button" onclick="return update_item(event, '<?=$item->id?>');">Сохранить
                </button>
                <br clear="all"/>
            </div>
        </form>
    </div>
    <? endif; ?>
</div>