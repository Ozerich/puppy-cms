<ul id="crumbs">
    <li><span>Статьи</span></li>
</ul>

<table class="item-list" id="article-list">
    <thead>
    <tr>
        <th>ID</th>
        <th>URL-alias</th>
        <th>Название</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <tr class="subtable-header">
        <td colspan="10">Категории</td>
    </tr>
    <? if (!$categories): ?>
    <tr class="empty">
        <td colspan="10">Нету категорий</td>
    </tr>
        <? else: foreach ($categories as $category): ?>
    <tr>
        <td class="id"><?=$category->id?></td>
        <td class="alias"><?=$category->alias?></td>
        <td class="article-name"><?=$category->name?></td>
        <td class="actions">
            <a href="admin/articles/edit/category/<?=$category->id?>" class="edit"></a>
            <a href="admin/articles/delete/category/<?=$category->id?>" class="delete"></a>
        </td>
    </tr>
        <? endforeach; endif; ?>
    <tr class="subtable-header">
        <td colspan="10">Статьи</td>
    </tr>
    <? if (!$articles): ?>
    <tr class="empty">
        <td colspan="10">Нету статей</td>
    </tr>
        <? else: foreach ($articles as $article): ?>
    <tr>
        <td class="id"><?=$article->id?></td>
        <td class="alias"><?=$article->alias?></td>
        <td class="article-name"><?=$article->title?></td>
        <td class="actions">
            <a href="admin/articles/edit/article/<?=$article->id?>" class="edit"></a>
            <a href="admin/articles/delete/article/<?=$article->id?>" class="delete"></a>
        </td>
    </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>


<div class="newitem-block" id="new-articlecategory-block">
    <?=form_open('admin/articles/create/category') ?>
    <p class="block-header">Новая категория</p>

    <div class="param">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name"/>
    </div>

    <div class="param">
        <label for="alias">URL-алиас:</label>
        <input type="text" id="alias" name="alias"/>
    </div>
    <input type="submit" class="noimg" value="Добавить"/>
    </form>
</div>

<div class="newitem-block" id="new-article-block">
    <?=form_open_multipart('admin/articles/create/article') ?>
    <p class="block-header">Новая статья</p>

    <div class="param">
        <label for="category">Категория:</label>
        <select id="category" name="category">
            <option value="0">Без категории</option>
            <? foreach (ArticleCategory::all() as $article): ?>
            <option value="<?=$article->id?>"><?=$article->name?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div class="param">
        <label for="name">Название:</label>
        <input type="text" id="title" name="title"/>
    </div>
    <div class="param">
        <label for="article_alias">URL-алиас:</label>
        <input type="text" id="article_alias" name="alias"/>
    </div>
    <div class="param">
        <label for="article_image">Превью-картинка</label>
        <input type="file" id="article_image" name="image"/>
    </div>
    <input type="submit" class="noimg" value="Добавить"/>
    </form>
</div>
