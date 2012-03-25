<ul id="crumbs">
    <li><a href="admin/animals">Виды животных</a></li>
    <li><span>Настройки <?=$animal->name?></span></li>
</ul>

<input type="hidden" id="animal_id" value="<?=$animal->id?>"/>

<?=
form_open("admin/animals/" . $animal->id)
; ?>

<div id="animal-data">
    <div class="main-info">
        <div class="param">
            <label for="name">Название:</label>
            <input type="text" name="name" value="<?=$animal->name?>" id="name" maxlength="20"/>
        </div>
        <div class="param">
            <label for="alias">URL-alias:</label>
            <input type="text" name="alias" value="<?=$animal->alias?>" id="alias" maxlength="20"/>
        </div>
    </div>

    <div class="organization-block">
        <p class="block-header">Организации</p>

        <div class="finance-content">
            <div class="no-org">
                <label for="no_org">Нет организации:</label>
                <textarea type="text" name="no_org" id="no_org"><?=$animal->no_organization?></textarea>
            </div>
            <div id="organization_list-wr"><?=$organization_list?></div>
            <div class="new-block neworganization-block">
                <p class="block-header">Новая организация:</p>
                <label for="org_name">Имя организации:</label>
                <input type="text" id="org_name" name="org_name"/><br/>
                <label for="org_descr">Описание</label>
                <textarea name="org_description" id="org_descr"></textarea>
                <button id="neworganization-submit" class="noimg">Добавить</button>
            </div>
        </div>
    </div>

    <div class="organization-block">
        <p class="block-header">Документы</p>

        <div class="finance-content">
            <div id="document_list-wr"><?=$document_list?></div>
            <div class="new-block newdocument-block">
                <p class="block-header">Новый документ:</p>
                <label for="doc_name">Название:</label>
                <input type="text" id="doc_name" name="doc_name"/><br/>
                <button id="newdocument-submit" class="noimg">Добавить</button>
            </div>
        </div>
    </div>

    <input type="submit" id="animal-submit" class="noimg" value="Сохранить"/>
</div>

</form>
