<ul id="crumbs">
    <li><a href="admin/users">Управление пользователями</a></li>
    <? if ($type == "admin"): ?>
    <li><a href="admin/users/admin">Администраторы</a></li>
    <li><span class="current">Новый администратор</span></li>
    <? elseif ($type == "manager"): ?>
    <li><a href="admin/users/manager">Менеджеры</a></li>
    <li><span class="current">Новый менеджер</span></li>
    <? elseif ($type == "user"): ?>
    <li><a href="admin/users/user">Пользователи</a></li>
    <li><span class="current">Новый пользователь</span></li>
    <? else: ?>
    <li><span class="current">Новый пользователь</span></li>
    <? endif; ?>
</ul>

<div id="userdata-page">

    <?= form_open('admin/users/create') ?>

    <table class="user-data">
        <tbody>
        <tr>
            <td class="param-name"><label for="login">Логин:</label>
            <td class="param-input"><input type="text" name="login" id="login" maxlength="255"/></td>
            <td class="param-name"><label for="email">E-mail:</label></td>
            <td class="param-input"><input type="text" name="email" id="email"/></td>
        </tr>
        <tr>
            <td class="param-name"><label for="password">Пароль:</label></td>
            <td class="param-input"><input type="password" name="password" id="password"/></td>
            <td class="param-name"><label for="password2">Повторите пароль:</label></td>
            <td class="param-input"><input type="password" id="password2"/></td>
        </tr>
        <tr>
            <td class="param-name"><label for="type">Тип пользователя:</label></td>
            <td class="param-input">
                <select id="type" <?= $type ? 'disabled' : 'name="type"' ?>>
                    <option value="admin" <?= $type == 'admin' ? 'selected' : '' ?>>Администратор</option>
                    <option value="manager" <?= $type == 'manager' ? 'selected' : '' ?>>Менеджер</option>
                    <option value="user" <?= $type == 'user' || !$type ? 'selected' : '' ?>>Пользователь</option>
                </select>
                <? if ($type): ?>
                <input type="hidden" name="type" value="<?=$type?>"/>
                <? endif; ?>
            </td>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="empty">
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td class="param-name"><label for="name">Имя:</label></td>
            <td class="param-input"><input type="text" name="name" id="name"/></td>
            <td class="param-name"><label for="surname">Фамилия:</label></td>
            <td class="param-input"><input type="text" name="surname" id="surname"/></td>
        </tr>
        <tr>
            <td class="param-name"><label for="country">Страна:</label></td>
            <td class="param-input"><input type="text" name="country" id="country"/></td>
            <td class="param-name"><label for="city">Город:</label></td>
            <td class="param-input"><input type="text" name="city" id="city"/></td>
        </tr>
        <tr>
            <td class="param-name"><label for="address">Адрес:</label></td>
            <td class="param-input"><textarea name="address" id="address"></textarea></td>
            <td class="param-name"><label for="metro">Метро:</label></td>
            <td class="param-input"><input type="text" name="metro" id="metro"/></td>
        </tr>
        <tr>
            <td class="param-name"><label for="phone">Телефон:</label></td>
            <td class="param-input"><input type="text" name="phone" id="phone"/></td>
        </tr>
        <tr>
            <td class="param-name"><label for="information">Доп. информация:</label></td>
            <td class="param-input" colspan="3"><textarea name="information" id="information"></textarea></td>
        </tr>
        </tbody>
    </table>


    <div class="statuses">
        <label for="is_checked">Проверен</label>
        <div class="checkbox"><input type="checkbox" id="is_checked" name="is_checked"/></div>
        <label for="is_best">Лучший</label>
        <div class="checkbox"><input type="checkbox" id="is_best" name="is_best"/></div>
        <label for="is_agreed">Условия принял</label>
        <div class="checkbox"><input type="checkbox" id="is_agreed" name="is_agreed"/></div>
        <br class="clear"/>
    </div>

    <div class="buttons">
        <input type="submit" class="noimg" id="useradd-submit" value="Добавить"/>
        <a href="admin/users" class="button noimg">Отмена</a>
    </div>
    </form>
</div>