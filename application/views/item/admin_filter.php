<? if ($this->user && $this->user->access_edit): ?>
<div id="admin_filter">
	
    <?=form_open('list', array('id' => 'admin_filter_form'))?>
    <div class="status-filter">
        <a href="#" <?=isset($filter_type) && $filter_type == "new_and_edit" ? 'class="current"' : ''?>
           filter="new_and_edit">Новые и отредакт., ждут модерации</a>
        <a href="#" <?=isset($filter_type) && $filter_type == "finished" ? 'class="current"' : ''?> filter="finished">
            Cнятые</a>
        <a href="#" <?=isset($filter_type) && $filter_type == "closed" ? 'class="current"' : ''?> filter="closed">Временно
            снятые</a>
        <a href="#" <?=isset($filter_type) && $filter_type == "near_finish" ? 'class="current"' : ''?>
           filter="near_finish">10 дней до снятия (бес- и платные)</a>
        Снятые <a href="#" <?=isset($filter_type) && $filter_type == "sell_plant" ? 'class="current"' : ''?>
                  filter="sell_plant">З</a>/
        <a <?=isset($filter_type) && $filter_type == "sell_site" ? 'class="current"' : ''?> filter="sell_site" href="#">C</a>/
        <a <?=isset($filter_type) && $filter_type == "sell_null" ? 'class="current"' : ''?> filter="sell_null" href="#">Д</a>
        <a <?=isset($filter_type) && $filter_type == "users" ? 'class="current"' : ''?> filter="users" href="#">Пользователи</a>
    </div>
    <? if(!isset($filter_type) || $filter_type != 'users'): ?>
    <div class="city-filter">
        <span class="filter-type">Город:</span>
        <? foreach (City::all() as $city): ?>
        <label for="city_<?=$city->id?>"><input type="checkbox"
                                                name="city[<?=$city->id?>]" <?=!isset($cities) || in_array($city->id, $cities) ? 'checked' : ''?>
                                                id="city_<?=$city->id?>"><?=$city->name?></label>
        <? endforeach; ?>
    </div>
    <div class="kind-filter">
        <span class="filter-type">Порода:</span>
        <? foreach (Kind::all() as $kind): if ($kind->parent_id == 0): ?>
        <label for="kind_<?=$kind->id?>"><input type="checkbox"
                                                name="kind[<?=$kind->id?>]" <?=!isset($kinds) || in_array($kind->id, $kinds) ? 'checked' : ''?>
                                                id="kind_<?=$kind->id?>"><?=$kind->name?></label>
        <? endif; endforeach; ?>
    </div>
    <? else: ?>
    <div class="users-filter">
        <label for="public_exist"><input type="checkbox" <?=$user_filter['public_exist'] ? 'checked' : ''?> name="public_exist" id="public_exist"/>Есть опубликованные</label>
        <label for="closed_exist"><input type="checkbox" <?=$user_filter['closed_exist'] ? 'checked' : ''?> name="closed_exist" id="closed_exist"/>Есть временно снятые</label>
        <label for="best_users"><input type="checkbox" <?=$user_filter['best_users'] ? 'checked' : ''?> name="best_users" id="best_users"/>Лучшие</label>
        <label for="user_email">Найти по e-mail:</label>
        <input type="text" name="user_email" id="user_email" value="<?=$user_filter['email']?>"/>
    </div>
    <? endif; ?>

    <input type="hidden" name="filter_type" value="<?=isset($filter_type) ? $filter_type : ''?>" id="filter_type"/>
    <input type="submit" value="Применить" id="filter_submit"/>
    </form>
</div>
<? endif; ?>