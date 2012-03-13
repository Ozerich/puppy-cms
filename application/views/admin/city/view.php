<ul id="crumbs">
    <li><a href="admin/cities">Города</a></li>
    <li><span>Настройки города <?=$city->name?></a></span></li>
</ul>

<input type="hidden" id="city_id" value="<?=$city->id?>"/>

<?=
form_open("admin/cities/" . $city->id)
; ?>
<div id="city-data">
    <div class="main-info">
        <div class="param">
            <label for="name">Название:</label>
            <input type="text" name="name" value="<?=$city->name?>" id="name" maxlength="20"/>
        </div>
        <div class="param">
            <label for="alias">URL-alias:</label>
            <input type="text" name="alias" value="<?=$city->alias?>" id="alias" maxlength="20"/>
        </div>
    </div>
    <div class="finance-block">
        <p class="block-header">Настройки финансов</p>

        <div class="finance-content">
            <div class="param">
                <label for="valute">Денежная еденица:</label>
                <input type="text" name="valute" id="valute" value="<?=$city->valute?>" maxlength="10">
            </div>
            <div class="param">
                <label for="bank">Банковский счет:</label>
                <input type="text" name="bank" id="bank" value="<?=$city->bank?>" maxlength="100">
            </div>
            <div id="commission_list-wr"><?=$commission_list?></div>
            <div class="newcommission-block">
                <p class="block-header">Новая комиссия</p>
                <label for="from">От:</label>
                <input type="text" name="from" id="from" maxlength="9"/>
                <label for="to">До:</label>
                <input type="text" name="to" id="to" maxlength="9"/>
                <label for="value">Комиссия:</label>
                <input type="text" name="value" id="value" maxlength="9"/>
                <button id="newcommission-submit" class="noimg">Добавить</button>
            </div>
        </div>
    </div>

    <div class="organization-block">
        <p class="block-header">Организации:</p>
        <? foreach (Animal::all() as $animal): ?>
        <div class="animal">
            <span class="animal-name"><?=$animal->name?></span>

            <div class="organizations">
                <? foreach ($animal->organizations as $organization): ?>
                <div class="organization-item">
                    <input <?= $organization_enable[$organization->id] ? 'checked' : ''?> name="organization_enable[<?=$organization->id?>]" type="checkbox" id="organization_<?=$organization->id?>"/>
                    <label for="organization_<?=$organization->id?>"><?=$organization->name?></label>
                </div>
                <? endforeach; ?>
            </div>
        </div>
        <? endforeach;?>
    </div>

    <input type="submit" id="city-submit" class="noimg" value="Сохранить"/>
</div>

</form>
