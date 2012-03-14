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
        <? foreach(ItemField::all() as $field): ?>
            <div class="field-item">
                <label for="field_<?=$field->id?>"><?=$field->name?></label>
                <input <?=$fields[$field->id] == 1 ? 'checked' : ''?> type="checkbox" id="field_<?=$field->id?>" name="fields[<?=$field->id?>]">
            </div>
        <? endforeach; ?>
        <br class="clear"/>
    </div>

    <div class="kind-texts">

        <? foreach (City::all() as $city): ?>
        <div class="kind-city">
            <p class="block-header"><?=$city->name?></p>

            <div class="text-item">
                <label for="before_<?=$city->id?>">До таблицы:</label>
                <textarea id="before_<?=$city->id?>" name="before[<?=$city->id?>]"><?=$before[$city->id]?></textarea>
            </div>
            <div class="text-item">
                <label for="after_<?=$city->id?>">После таблицы:</label>
                <textarea id="after_<?=$city->id?>" name="after[<?=$city->id?>]"><?=$after[$city->id]?></textarea>
            </div>
            <br class="clear"/>
        </div>
        <? endforeach; ?>

    </div>

    <input type="submit" id="kind-submit" class="noimg" value="Сохранить"/>
</div>

</form>
