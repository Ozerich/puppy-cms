<ul id="crumbs">
    <li><a href="admin/kinds">Породы</a></li>
    <li><span>Настройки породы "<?=$kind->name?>"</a></span></li>
</ul>

<input type="hidden" id="kind_id" value="<?=$kind->id?>"/>

<?=
form_open("admin/kinds/" . $kind->id)
; ?>
<div id="kind-data">
    <div class="main-info">
        <div class="param">
            <label for="animal">Категория:</label>
            <select name="animal" id="animal">
                <? foreach (Animal::all() as $animal): ?>
                <option <?=$animal->id == $kind->animal_id ? 'selected' : ''?>
                        value="<?=$animal->id?>"><?=$animal->name?></option>
                <? endforeach; ?>
            </select>
        </div>
        <div class="param">
            <label for="name">Название:</label>
            <input type="text" name="name" value="<?=$kind->name?>" id="name" maxlength="20"/>
        </div>
        <div class="param">
            <label for="alias">URL-alias:</label>
            <input type="text" name="alias" value="<?=$kind->alias?>" id="alias" maxlength="20"/>
        </div>
        <div class="param text">
            <label for="header_template">Шаблон для заголовка объявления</label>
            <textarea name="header_template" id="header_template"><?=$kind->header_template?></textarea>
        </div>
        <div class="param text">
            <label for="preview_template">Шаблон для текста короткого объявления</label>
            <textarea name="preview_template" id="preview_template"><?=$kind->preview_template?></textarea>
        </div>
    </div>

    <div id="subkind_list-wr"><?=$subkind_list?></div>
    <div class="newsubkind-block">
        <p class="block-header">Новая под-порода:</p>

        <div class="newsubkind-content">
            <label for="subkind_name">Название породы:</label>
            <input type="text" id="subkind_name" name="subkind_name"/><br/>
            <button id="newsubkind-submit" class="noimg">Добавить</button>
        </div>
    </div>

    <div class="fields">
        <p class="block-header">Используемые параметры:</p>
        <? foreach (Field::all() as $field): ?>
        <div class="field-item">
            <label for="field_<?=$field->id?>"><?=$field->name?></label>
            <input <?=$fields[$field->id] == 1 ? 'checked' : ''?> type="checkbox" id="field_<?=$field->id?>"
                                                                  name="fields[<?=$field->id?>]">
        </div>
        <? endforeach; ?>
        <br class="clear"/>
    </div>

    <div class="kind-settings">

        <? foreach (City::all() as $city): ?>
        <div class="kind-city">
            <div class="block-header">
                <span><?=$city->name?></span>
                <a href="#" class="arrow arrow-up"></a>
                <br class="clear"/>
            </div>
            <div class="block-content">
                <div class="item">
                    <label for="title_<?=$city->id?>">Заголовок сайта:</label>
                    <input type="text" name="title[<?=$city->id?>]" id="title_<?=$city->id?>"
                           value="<?=$kind_settings[$city->id] ? $kind_settings[$city->id]->title : ''?>"/>
                </div>
                <div class="item">
                    <label for="metakeywords_<?=$city->id?>">META Keywords:</label>
                    <input type="text" name="meta_keywords[<?=$city->id?>]" id="metakeywords_<?=$city->id?>"
                           value="<?=$kind_settings[$city->id] ? $kind_settings[$city->id]->meta_keywords : ''?>"/>
                </div>
                <div class="item">
                    <label for="metadescription_<?=$city->id?>">META Description:</label>
                    <input type="text" name="meta_description[<?=$city->id?>]" id="metadescription_<?=$city->id?>"
                           value="<?=$kind_settings[$city->id] ? $kind_settings[$city->id]->meta_description : ''?>"/>
                </div>
                <div class="item">
                    <label for="phone_<?=$city->id?>">Телефон:</label>
                    <input type="text" name="phone[<?=$city->id?>]" id="phone_<?=$city->id?>"
                           value="<?=$kind_settings[$city->id] ? $kind_settings[$city->id]->phone : ''?>"/>
                </div>
                <div class="text-item">
                    <label for="before_<?=$city->id?>">До таблицы:</label>
                    <textarea id="before_<?=$city->id?>"
                              name="before[<?=$city->id?>]"><?=$kind_settings[$city->id] ? $kind_settings[$city->id]->beforelist_text : ''?></textarea>
                </div>
                <div class="text-item">
                    <label for="after_<?=$city->id?>">После таблицы:</label>
                    <textarea id="after_<?=$city->id?>"
                              name="after[<?=$city->id?>]"><?=$kind_settings[$city->id] ? $kind_settings[$city->id]->afterlist_text : ''?></textarea>
                </div>
                <div class="text-item">
                    <label for="free_agreement_<?=$city->id?>">Текст соглашения для типа объявления "Бесплатно"</label>
                    <textarea class="agreement" name="free_agreement[<?=$city->id?>]"
                              id="free_agreement_<?=$city->id?>"><?=$kind_settings[$city->id] ? $kind_settings[$city->id]->free_agreement : ''?></textarea>
                </div>
                <div class="text-item">
                    <label for="paid1_agreement_<?=$city->id?>">Текст соглашения для типа объявления "Платное
                        Недорого"</label>
                    <textarea class="agreement" name="paid1_agreement[<?=$city->id?>]"
                              id="paid1_agreement_<?=$city->id?>"><?=$kind_settings[$city->id] ? $kind_settings[$city->id]->paid1_agreement : ''?></textarea>
                </div>
                <div class="text-item">
                    <label for="paid2_agreement_<?=$city->id?>">Текст соглашения для типа объявления "Платное Без
                        Проблем"</label>
                    <textarea class="agreement" name="paid2_agreement[<?=$city->id?>]"
                              id="paid2_agreement_<?=$city->id?>"><?=$kind_settings[$city->id] ? $kind_settings[$city->id]->paid2_agreement : ''?></textarea>
                </div>
                <br class="clear"/>
            </div>
        </div>
        <? endforeach; ?>

    </div>

    <input type="submit" id="kind-submit" class="noimg" value="Сохранить"/>
</div>

</form>
