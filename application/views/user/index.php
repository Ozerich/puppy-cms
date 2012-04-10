<div class="block">
    <div class="block-header">
        Пользователь <?=$user->fullname?> (<?=$user->city->name?>)
    </div>
    <div class="block-content">
        <div id="admin_user">
            <?=form_open('user/' . $user->id)?>
            <div class="params">
                <div class="param">
                    <label for="name">Имя:</label>
                    <input type="text" name="name" id="name" value="<?=$user->name?>"/>
                </div>
                <div class="param">
                    <label for="name">Фамилия:</label>
                    <input type="text" name="surname" id="surname" value="<?=$user->surname?>"/>
                </div>
                <div class="param">
                    <label for="name">email:</label>
                    <input type="text" name="email" id="email" value="<?=$user->email?>"/>
                </div>
                <div class="param">
                    <label for="name">Телефон:</label>
                    <input type="text" name="phone" id="phone" value="<?=$user->phone?>"/>
                </div>
            </div>
            <div class="checkbox-params">
                <div class="param">
                    <label for="best">Лучший:</label>
                    <input type="checkbox" name="best" id="best" <?=$user->is_best ? 'checked' : ''?>/>
                </div>
                <div class="param">
                    <label for="checked">Проверен:</label>
                    <input type="checkbox" name="checked" id="checked" <?=$user->is_checked ? 'checked' : ''?>/>
                </div>
                <div class="param">
                    <label for="accept">Условия принял:</label>
                    <input type="checkbox" name="accept" id="accept" <?=$user->is_agreed ? 'checked' : ''?>/>
                </div>
            </div>
            <div class="information">
                <label for="information">Дополнительная информация:</label>
                <textarea id="information" name="information"><?=$user->information?></textarea>
            </div>

            <input type="submit" value="Сохранить"/>
            </form>

            <table class="user-items">
               <?=$user_items?>
            </table>
        </div>
    </div>
</div>