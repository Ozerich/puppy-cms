<div class="block">
    <div class="block-header">
        <div class="header-left">Личный кабинет <span id="header_email"><?=$this->user->email?></span></div>
        <div class="header-right">Для оплат <?=$this->user->city->bank?></div>
        <br/>
    </div>
    <div class="block-content">

        <div id="profile_data">
            <div class="profile-param">
                <label for="person_email">E-mail:</label>
                <span><?=$this->user->email?></span>
                <input type="text" name="email" id="person_email" value="<?=$this->user->email?>"/>
            </div>

            <div class="profile-param">
                <label for="person_name">Имя:</label>
                <span><?=$this->user->name?></span>
                <input type="text" name="name" id="person_name" value="<?=$this->user->name?>"/>
            </div>

            <div class="profile-param">
                <label for="person_surname">Фамилия:</label>
                <span><?=$this->user->surname?></span>
                <input type="text" name="surname" id="person_surname" value="<?=$this->user->surname?>"/>
            </div>

            <div class="profile-param">
                <label for="person_city">Город</label>
                <span><?=$this->user->city->name?></span>
                <select id="person_city" name="city">
                    <? foreach (City::all() as $city): ?>
                    <option <?=$city->id == $this->user->city_id ? 'selected' : ''?>
                        value="<?=$city->id?>"><?=$city->name?></option>
                    <? endforeach; ?>
                </select>
            </div>

            <div class="profile-param">
                <label for="person_metro">Ст. метро:</label>
                <span><?=$this->user->metro?></span>
                <input type="text" name="metro" id="person_metro" value="<?=$this->user->metro?>"/>
                <button id="save_profile" style="display:none">Сохранить</button>
            </div>

            <div class="profile-param text">
                <label for="person_phone">Телефоны:</label>
                <span><?=$this->user->phone?></span>
                <textarea id="person_phone" name="phone"><?=$this->user->phone?></textarea>
            </div>

            <div class="profile-param text">
                <label for="person_address">Адрес:</label>
                <span><?=$this->user->address?></span>
                <textarea id="person_address" name="address"><?=$this->user->address?></textarea>
            </div>

        </div>

        <button id="edit_profile">Редактировать</button>

    </div>
</div>

<div class="block">
    <div class="block-header">Ваши объявления</div>
    <div class="block-content">
        <?=$item_list?>
    </div>
</div>

<a href="create" class="button">Добавить объявление</a>