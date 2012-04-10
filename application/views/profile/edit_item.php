<?= form_open_multipart('create') ?>
<div class="block" id="new-item">
<div class="block-header">Новое объявление</div>
<div class="block-content">
<div class="top-info">
    <div class="param">
        <label for="kind">Порода:</label>
        <select id="kind" name="kind">
            <? foreach (Animal::all() as $i => $animal): ?>
            <option value="-" disabled="disabled">---<?=$animal->name?></option>
            <? foreach ($animal->kinds as $j => $kind): ?>
                <? if ($kind->subkinds): ?>
                    <option value="-" disabled="disabled">------<?=$kind->name?></option>
                    <? foreach ($kind->subkinds as $z => $subkind): ?>
                                <option <?=((!$i && !$j && !$z) || $item->kind_id == $subkind->id ? 'selected' : '')?>
                                    is_weight="<?=$subkind->is_weight?>" is_height="<?=$subkind->is_height?>"
                                    animal=<?=$animal->id?> value="<?=$subkind->id?>">
                                    <?=$subkind->name?></option>
                                <? endforeach; ?>
                    <? else: ?>
                        <option <?=((!$i && !$j) || $item->kind_id == $kind->id ? 'selected' : '')?>
                            is_weight="<?=$kind->is_weight?>" is_height="<?=$kind->is_height?>"
                            animal=<?=$animal->id?> value="<?=$kind->id?>"><?=$kind->name?></option>
                        <? endif; ?>
                <? endforeach; ?>
            <? endforeach; ?>
        </select>
    </div>
    <div class="param">
        <label for="plant_count">Щенков в помете</label>
        <select id="plant_count" name="plant_count">
            <? for ($i = 1; $i <= 9; $i++): ?>
            <option <?=$item->plant_count == $i ? 'selected="selected"' : ''?> value="<?=$i?>"><?=$i?></option>
            <? endfor; ?>
        </select>
    </div>
    <div class="param plant-param">
        <label for="plant_name">Название питомника:</label>
        <input type="text" id="plant_name" maxlength="100" value="<?=$item->plant_name?>" name="plant_name"/>
    </div>
    <div class="param birthday-param">
        <label for="birthday">Дата рождения:</label>
        <input type="text" id="birthday" value="<?=$item->birthday->format('d.m.Y')?>" maxlength="10" name="birthday"/>
    </div>
</div>
<div class="organizations-wr">
    <? foreach (Animal::all() as $ind => $animal): ?>
    <div class="organization-block" id="organizationblock_<?=$animal->id?>"
         style="display:<?=$animal->id == $item->animal_id ? 'block' : 'none'?>">
        <p class="header">
            <span>Организация к которой относится <?=$animal->name?></span>
            (организация в которой зарегистрирован питомник или которая заверяет своей печатью метрику)
        </p>
        <input type="radio" checked name="organizations[<?=$animal->id?>]" value="0"
               id="organization_<?=$animal->id?>_0"/>
        <label for="organization_<?=$animal->id?>_0'"><?=$animal->no_organization?></label><br/>
        <? foreach ($organizations[$animal->id] as $organization): ?>
        <input <?=$item->organization_id == $organization->id ? 'checked' : ''?> type="radio"
                                                                                 name="organizations[<?=$animal->id?>]"
                                                                                 value="<?=$organization->id?>"
                                                                                 id="organization_<?=$animal->id . '_' . $organization->id?>">
        <label
            for="organization_<?=$animal->id . '_' . $organization->id?>"><?=$organization->plain_text?></label>
        <br/>
        <? endforeach; ?>
    </div>
    <? endforeach; ?>
</div>

<div class="parents">
    <div class="parent" id="mother">
        <p class="header">Мама</p>

        <? if ($item->mother_image): ?>
        <div class="current-photo"><img width="120" src="<?=Config::get('item_images_dir') . $item->mother_image?>"/>
        </div>
        <? endif; ?>

        <div class="param">
            <label for="mother_image">Новое Фото</label>
            <input type="file" id="mother_image" name="mother_image"/>
            <input type="hidden" id="mother_image_filename" name="mother_image_filename"/>
        </div>

        <div class="params-block">

            <div class="param name">
                <label for="mother_name">Имя</label>
                <input type="text" id="mother_name" value="<?=$item->mother_name?>" name="mother_name"/>
            </div>

            <div class="param age">
                <label for="mother_age">Возраст</label>
                <input type="text" id="mother_age" value="<?=$item->mother_age?>" name="mother_age"/>
            </div>

        </div>

        <div class="params-block">
            <div class="param weight" style="display:<?=$item->kind->is_weight ? 'inline-block' : 'none'?>">
                <label for="mother_weight">Вес кг.</label>
                <input type="text" name="mother_weight" value="<?=$item->kind->is_weight ? $item->mother_weight : ''?>"
                       id="mother_weight"/>
            </div>

            <div class="param height" style="display:<?=$item->kind->is_height ? 'inline-block' : 'none'?>">
                <label for="mother_height">Рост cм.</label>
                <input type="text" name="mother_height" value="<?=$item->kind->is_height ? $item->mother_height : ''?>"
                       id="mother_height"/>
            </div>
        </div>


        <div class="param">
            <label for="mother_prizes">Титулы или оценка</label>
            <input type="text" id="mother_prizes" value="<?=$item->mother_prizes?>" name="mother_prizes"/>
        </div>

    </div>
    <div class="parent" id="father">
        <p class="header">Папа</p>

        <? if ($item->father_image): ?>
        <div class="current-photo"><img width="120" src="<?=Config::get('item_images_dir') . $item->father_image?>"/>
        </div>
        <? endif; ?>

        <div class="param">
            <label for="father_image">Новое фото</label>
            <input type="file" id="father_image" name="father_image"/>
            <input type="hidden" id="father_image_filename" name="father_image_filename"/>
        </div>

        <div class="params-block">

            <div class="param name">
                <label for="father_name">Имя</label>
                <input type="text" id="father_name" value="<?=$item->father_name?>" name="father_name"/>
            </div>

            <div class="param age">
                <label for="father_age">Возраст</label>
                <input type="text" id="father_age" value="<?=$item->father_age?>" name="father_age"/>
            </div>
        </div>

        <div class="params-block">
            <div class="param weight" style="display:<?=$item->kind->is_weight ? 'inline-block' : 'none'?>">
                <label for="father_weight">Вес кг.</label>
                <input type="text" name="father_weight" value="<?=$item->kind->is_weight ? $item->father_weight : ''?>"
                       id="father_weight"/>
            </div>

            <div class="param height" style="display:<?=$item->kind->is_height ? 'inline-block' : 'none'?>">
                <label for="father_height">Рост cм.</label>
                <input type="text" name="father_height" value="<?=$item->kind->is_height ? $item->father_height : ''?>"
                       id="father_height"/>
            </div>
        </div>

        <div class="param">
            <label for="father_prizes">Титулы или оценка</label>
            <input type="text" value="<?=$item->father_prizes?>" id="father_prizes" name="father_prizes"/>
        </div>

    </div>
</div>

<div class="main-params-wr">
    <? foreach (Kind::all() as $kind): if ($kind->subkinds) continue; ?>
    <div class="main-params" style="display:<?=$item->parent_kind->id == $kind->id ? 'block' : 'none'?>"
         id="main_params_<?=$kind->id?>">
        <div class="param sex">
            <label for="sex_<?=$kind->id?>">Пол</label>
            <select name="sex" id="sex_<?=$kind->id?>">
                <option <?=$item->sex == 'man' ? 'selected="selected"' : ''?> value="man">Мальчик</option>
                <option <?=$item->sex == 'girl' ? 'selected="selected"' : ''?> value="girl">Девочка</option>
            </select>
        </div>
        <? foreach ($kind->fields as $field): $val = ItemField::get($item->id, $field->id); ?>
        <div class="param <?=$field->code?>">
            <label for="field_<?=$field->id?>"><?=$field->name?></label>
            <? if ($field->type == 'select'): ?>
            <select name="param_<?=$field->id?>" id="field_<?=$field->id?>">
                <? foreach ($field->values as $value): ?>
                <option <?=$val == $value->id ? 'selected="selected"' : ''?>
                    value="<?=$value->id?>"><?=$value->value?></option>
                <? endforeach; ?>
            </select>
            <? else: ?>
            <input type="text" value="<?=$val?>" name="param_<?=$field->id?>" id="field_<?=$field->id?>"/>
            <? endif; ?>
        </div>
        <? endforeach; ?>
    </div>
    <? endforeach; ?>
</div>
<div class="documents-wr">
    <? foreach (Animal::all() as $animal): ?>
    <div class="documents" style="display:<?=$animal->id == $item->animal_id ? 'block' : 'none'?>"
         id="documents_<?=$animal->id?>">
        <label class="header">Документы</label>
        <? foreach ($animal->documents as $doc): ?>
        <label class="document" for="doc_<?=$animal->id?>_<?=$doc->id?>">
            <input type="checkbox" value="<?=$doc->id?>" <?=$item->check_document($doc->id) ? 'checked' : ''?>
                   id="doc_<?=$animal->id?>_<?=$doc->id?>"/>
            <?=$doc->name?>
        </label>
        <? endforeach; ?>
    </div>
    <? endforeach; ?>
</div>
<div class="bottom-params">
    <div class="param video">
        <label for="video">Ссылка на видео:</label>
        <input type="text" name="video" id="video" value="<?=$item->video?>"/>
    </div>
    <div class="param text">
        <label for="description">Описание, которое будет видно на главной странице:</label>
        <textarea name="description" id="description"><?=$item->description?></textarea>
    </div>
</div>
<div class="images">
    <? if ($item->image): ?>
    <div class="current-photo"><img width="120" src="<?=Config::get('item_images_dir') . $item->image?>"/></div>
    <? endif; ?>
    <div class="image mainimage">
        <label for="main_image">Основная фотография (будет видна на главной странице):</label>
        <input type="file" name="main_image" id="main_image"/>
        <input type="hidden" name="main_image_filename" id="main_image_filename"/>
    </div>

    <? for ($i = 1; $i <= Config::get('item_images_count'); $i++): ?>

    <? if (isset($item->images[$i - 1]) && $item->images[$i - 1]->image): ?>
        <div class="current-photo"><img width="120" src="<?=Config::get('item_images_dir') . $item->images[$i - 1]->image?>"/></div>
    <? endif; ?>
    <div class="image">
        <label for="image<?=$i?>">Фотография <?=$i?>:</label>
        <input type="file" name="image_<?=$i?>" id="image<?=$i?>"/>
        <input type="hidden" name="image<?=$i?>_filename" id="image<?=$i?>_filename"/>
    </div>
    <? endfor; ?>
</div>
<div class="param another">
    <label for="another">Что еще есть для продажи:</label>
    <input type="text" name="another" id="another" value="<?=$item->another?>"/>

    <p class="sample"><b>Пример</b>: Из этого помета еще есть для продажи 1 девочка с будущим весом 2 кг,
        мальчик 2,2 кг и мальчик 2,2-2,4 кг. (Цену тут НЕ указывайте)</p>
</div>
<div class="param price">
    <label for="item_price">Цена:</label>
    <input type="text" name="price" id="item_price" value="<?=$item->price?>"/><span
    class="valute"><?=$item->city->valute?></span>

    <div class="price-commission">Цена на сайте с учетом суммы оплаты за услуги сайта:
        <span class="value"><span
            id="addprice_value"><?=$item->site_price?></span> <?=$this->user->city->valute?></span>

        <div id="price-loader"></div>
    </div>
</div>

<div class="agreements-wr">
    <? foreach (Kind::all() as $ind => $kind): if ($kind->subkinds) continue; ?>
    <div class="agreement" style="display:<?=$item->parent_kind->id == $kind->id ? 'block' : 'none'?>"
         id="agreement1_<?=$kind->id?>">
        <div class="agreement-type">
            <label for="agreement_type">Тип объявления:</label>
            <select name="pay_type" id="agreement_type">
                <option <?=$item->type == 'free' ? 'selected' : ''?> value="free">Бесплатное объявление</option>
                <option <?=$item->type == 'paid_1' ? 'selected' : ''?> value="paid_1">Платное "Недорого"</option>
                <option <?=$item->type == 'paid_2' ? 'selected' : ''?> value="paid_2">Платное "Без проблем"</option>
            </select>
        </div>

        <div class="agreement-content" style="display:<?=$item->type == 'free' ? 'block' : 'none'?>"
             id="agreement_free"><?=isset($settings[$kind->id]) ? $settings[$kind->id]->free_agreement : ''?></div>
        <div class="agreement-content" style="display:<?=$item->type == 'paid_1' ? 'block' : 'none'?>"
             id="agreement_paid_1"><?=isset($settings[$kind->id]) ? $settings[$kind->id]->paid1_agreement : ''?></div>
        <div class="agreement-content" style="display:<?=$item->type == 'paid_2' ? 'block' : 'none'?>"
             id="agreement_paid_2"><?=isset($settings[$kind->id]) ? $settings[$kind->id]->paid2_agreement : ''?></div>

        <div class="agreement-checkbox">

            <label for="agreement_1"><input type="checkbox" id="agreement_1"/>Поставьте галочку, если согласны с этими
                условиями, прописанными в Договоре,
                который вы, ставя галочку, подписываете в электронном виде.</label>
        </div>
    </div>
    <div class="agreement" style="display:<?=$ind ? 'none' : 'block'?>" id="agreement2_<?=$kind->id?>">
        <div class="agreement-checkbox">
            <label for="agreement_2"><input type="checkbox" id="agreement_2"/>Поставьте галочку, если согласны с
                условиями</label>
        </div>
    </div>
    <? endforeach; ?>
</div>

</div>

<div class="error-block">
    <ul>
    </ul>
</div>

<div id="file_loader" class="load-status">
    <p class="status">Загрузка файлов</p>
    <img src="img/item-loader.gif"/>
</div>

<div id="data_loader" class="load-status">
    <p class="status">Сохранение данных</p>
    <img src="img/item-loader.gif"/>
</div>

<input type="hidden" id="item_id" value="<?=$item->id?>"/>
<input type="submit" class="item-submit" id="edit_item_submit" value="Сохранить данные и опубликовать объявление"/>
</div>
</form>