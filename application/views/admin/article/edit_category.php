<ul id="crumbs">
    <li><a href="admin/articles">Статьи</a></li>
    <li><span>Категория "<?=$item->name?>"</span></li>
</ul>

<div id="articlecategory-view">

    <?=form_open('admin/articles/edit/category/' . $item->id);?>
    <div class="main-info">
        <div class="param">
            <label for="name">Название:</label>
            <input type="text" name="name" value="<?=$item->name?>" id="name" maxlength="20"/>
        </div>
        <div class="param">
            <label for="alias">URL-alias:</label>
            <input type="text" name="alias" value="<?=$item->alias?>" id="alias" maxlength="20"/>
        </div>

        <input type="submit" class="noimg" value="Сохранить"/>
    </div>
    </form>

    <div class="subarticles">
        <table class="item-list" id="subarticle-list">
            <thead>
            <tr>
                <th>ID</th>
                <th>URL-alias</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            <? if (!$item->articles): ?>
            <tr class="empty">
                <td colspan="10">Нету статей</td>
            </tr>
                <? else: foreach ($item->articles as $article): ?>
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

        <div class="newitem-block" id="new-article-block">
            <?=form_open('admin/articles/create/article', '', array('category' => $item->id)); ?>
            <p class="block-header">Новая статья</p>

            <div class="param">
                <label for="name">Название:</label>
                <input type="text" id="title" name="title"/>
            </div>
            <div class="param">
                <label for="article_alias">URL-алиас:</label>
                <input type="text" id="article_alias" name="alias"/>
            </div>
            <input type="submit" class="noimg" value="Добавить"/>
            </form>
        </div>
    </div>
</div>
