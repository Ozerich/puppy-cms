<ul id="crumbs">
    <li><a href="admin/articles">Статьи</a></li>
    <? if ($item->category_id != 0): ?>
    <li><a href="admin/articles/edit/category/<?=$item->category->id?>">Категория "<?=$item->category->name?>"</a></li>
    <? endif; ?>
    <li><span>Статья "<?=$item->title?>"</span></li>
</ul>

<div id="article-view">
    <?=form_open_multipart('admin/articles/edit/article/' . $item->id);?>

    <div class="param">
        <label for="title">Название:</label>
        <input type="text" name="title" value="<?=$item->title?>" id="title" maxlength="255"/>
    </div>
    <div class="param">
        <label for="alias">URL-alias:</label>
        <input type="text" name="alias" value="<?=$item->alias?>" id="alias" maxlength="100"/>
    </div>
    <div class="param">
        <label for="category">Категория:</label>
        <select id="category" name="category">
            <option <?=$item->category_id == 0 ? 'selected' : ''?>value="0">Без категории</option>
            <? foreach (ArticleCategory::all() as $article): ?>
            <option <?=$item->category_id == $article->id ? 'selected' : ''?>
                    value="<?=$article->id?>"><?=$article->name?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div class="param">
        <label for="meta_keywords">META Keywords:</label>
        <input type="text" name="meta_keywords" value="<?=$item->meta_keywords?>" id="meta_keywords" maxlength="2000"/>
    </div>
    <div class="param">
        <label for="meta_description">META Description:</label>
        <input type="text" name="meta_description" value="<?=$item->meta_description?>" id="meta_description"
               maxlength="2000"/>
    </div>

    <div class="param">
        <label for="image">Картинка:</label>
        <div class="image"><img src="<?=Config::get('article_images_dir').$item->image?>"/></div>
        <label for="new_image">Новая картинка:</label>
        <input type="file" name="image" id="new_image"/>
    </div>

    <div class="param text">
        <label for="preview">Краткий анонс:</label>
        <textarea id="preview" class="wysiwyg" name="preview"><?=$item->preview?></textarea>
    </div>

    <div class="param text">
        <label for="text">Полное содержание:</label>
        <textarea id="text" class="wysiwyg" name="text"><?=$item->text?></textarea>
    </div>

    <div class="buttons">
        <input type="submit" class="noimg" value="Сохранить"/>
        <a href="admin/articles" class="noimg button">Отмена</a>
    </div>
    </form>

</div>