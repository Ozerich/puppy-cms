<ul id="crumbs">
    <li><span>Настройки писем электронной почты</span></li>
</ul>

<div id="mail-config" class="config-data">
    <?=form_open('admin/config/mails');?>
    <div class="param">
        <label for="site_email">E-mail сайта</label>
        <input type="text" name="site_email" id="site_email" value="<?=Config::get('site_email')?>" maxlength="30"/>
    </div>

    <div class="param text">
        <label for="publish_mail">Шаблон e-mail письма, отправляемого когда объявление опубликовано</label>
        <textarea name="publish_mail" id="publish_mail"><?=Config::get('publish_mail')?></textarea>
    </div>

    <div class="param text">
        <label for="endtime_mail">Шаблон e-mail письма, отправляемого когда время объявления истекло</label>
        <textarea name="endtime_mail" id="endtime_mail"><?=Config::get('endtime_mail')?></textarea>
    </div>

    <div class="param text">
        <label for="stoped_mail">Шаблон e-mail письма, отправляемого когда объявление было временно приостановлено</label>
        <textarea name="stoped_mail" id="stoped_mail"><?=Config::get('stoped_mail')?></textarea>
    </div>

    <div class="buttons">
        <input type="submit" class="noimg" value="Сохранить"/>
        <a href="admin/articles" class="noimg button">Отмена</a>
    </div>
    </form>

</div>