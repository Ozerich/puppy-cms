<ul id="crumbs">
    <li><span>Управление контентом</span></li>
</ul>

<div id="content-view" class="content-data">
    <?=form_open('admin/config/content');?>
    <div class="param">
        <label for="copyright">Строка «Copyright»:</label>
        <input type="text" name="copyright" id="copyright" value="<?=Config::find_by_param('copyright')->value?>"/>
    </div>

    <div class="param">
        <label for="site_title">Заголовок сайта:</label>
        <input type="text" name="site_title" id="site_title" value="<?=Config::find_by_param('site_title')->value?>"/>
    </div>

    <div class="param">
        <label for="meta_keywords">META Keywords:</label>
        <input type="text" name="meta_keywords" id="meta_keywords" value="<?=Config::find_by_param('meta_keywords')->value?>"/>
    </div>

    <div class="param">
        <label for="meta_description">META Description:</label>
        <input type="text" name="meta_description" id="meta_description" value="<?=Config::find_by_param('meta_description')->value?>"/>
    </div>

    <div class="param text">
        <label for="html_left">HTML в левом блоке:</label>
        <textarea id="html_left" name="html_left"><?=Config::find_by_param('html_left')->value?></textarea>
    </div>

    <div class="param text">
        <label for="html_bottom_1">HTML в первом нижнем блоке:</label>
        <textarea id="html_bottom_1" name="html_bottom_1"><?=Config::find_by_param('html_bottom_1')->value?></textarea>
    </div>

    <div class="param text">
        <label for="html_bottom_2">HTML в левом блоке:</label>
        <textarea id="html_bottom_2" name="html_bottom_2"><?=Config::find_by_param('html_bottom_2')->value?></textarea>
    </div>
    <div class="buttons">
        <input type="submit" class="noimg" value="Сохранить"/>
        <a href="admin/articles" class="noimg button">Отмена</a>
    </div>
    </form>
</div>