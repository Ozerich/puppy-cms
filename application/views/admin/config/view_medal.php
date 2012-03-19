<ul id="crumbs">
    <li><a href="admin/config/medals">Медали</a></li>
    <li><span>Медаль "<?=$medal->name?>"</span></li>
</ul>

<div id="view-medal-block" class="config-data">
    <?=form_open_multipart('admin/config/medal/' . $medal->id)?>
    <div class="param">
        <label for="name">Название:</label>
        <input type="text" name="name" id="name" value="<?=$medal->name?>"/>
    </div>

    <div class="param">
        <label for="alt">Атрибут alt:</label>
        <input type="text" name="alt" id="alt" value="<?=$medal->alt?>"/>
    </div>

    <div class="param">
        <label for="title">Атрибут title:</label>
        <input type="text" name="title" id="title" value="<?=$medal->title?>"/>
    </div>

    <div class="image-param">
        <label>Текущая картинка:</label>
        <div class="image"><?=$medal->img?></div>
        <label for="new-image">Новая картинка:</label>
        <input type="file" name="image" id="new-image"/>
    </div>

    <div class="buttons">
        <input type="submit" class="noimg" value="Сохранить"/>
        <a href="admin/medals" class="noimg button">Отмена</a>
    </div>

    </form>

</div>