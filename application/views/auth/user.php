
<div class="block" id="login-block">
    <div class="block-header">Вход:</div>

    <div class="block-content">

        <div class="login-block">
            <div class="login-param">
                <label for="email">E-Mail:</label>
                <input type="text" name="email" id="email"/>
            </div>

            <div class="login-param">
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password"/>
            </div>

            <div class="buttons">
                <input type="submit" value="Войти"/>
                <button id="open_register">Регистрация</button>
            </div>

        </div>

    </div>
</div>

<div class="block" id="register-block">
    <p class="block-header">Регистрация:</p>
    <?=form_open('register');?>
    <div class="block-content">
        <div class="register-block">
            <div class="register-param">
                <label for="register_email">E-Mail:</label>
                <input type="text" name="email" id="register_email"/>
            </div>

            <div class="register-param">
                <label for="register_password">Пароль:</label>
                <input type="password" name="password" id="register_password"/>
            </div>

            <div class="register-param">
                <label for="register_password2">Повторите пароль:</label>
                <input type="password" id="register_password2"/>
            </div>

            <div class="register-param">
                <label for="register_name">Имя:</label>
                <input type="text" name="name" id="register_name"/>
            </div>

            <div class="register-param">
                <label for="register_surname">Фамилия:</label>
                <input type="text" name="surname" id="register_surname"/>
            </div>

            <div class="register-param">
                <label for="register_city">Город:</label>
                <select id="register_city" name="city">
                    <?foreach (City::all() as $city): ?>
                    <option value="<?=$city->id?>"><?=$city->name?></option>
                    <? endforeach; ?>
                </select>
            </div>

            <div class="register-param">
                <label for="register_metro">Ст. метро:</label>
                <input type="text" name="metro" id="register_metro"/>
            </div>

            <div class="register-param">
                <label for="register_phone">Телефоны:</label>
                <textarea id="register_phone" name="phone"></textarea>
            </div>

            <div class="register-param">
                <label for="register_address">Адрес:</label>
                <textarea id="register_address" name="address"></textarea>
            </div>

            <div class="buttons">
                <input type="submit" id="register_submit" value="Зарегистрироваться"/>
            </div>

        </div>
    </div>
    </form>
</div>