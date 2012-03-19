<ul id="crumbs">
    <li><span>Медали</span></li>
</ul>

<a href="admin/config/medals/create" class="add-medal button">Новая медаль</a>

<table class="item-list" id="medal-list">
    <thead>
    <tr>
        <th>Название</th>
        <th>Аттрибут alt</th>
        <th>Аттрибут title</th>
        <th>Файл</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>
    <? if (!$medals): ?>
    <tr class="empty">
        <td colspan="10">Нету медалей</td>
    </tr>
        <? else: foreach ($medals as $medal): ?>
    <tr>
        <td class="medal-name"><?=$medal->name?></td>
        <td class="medal-name"><?=$medal->alt?></td>
        <td class="medal-name"><?=$medal->title?></td>
        <td class="medal-file"><?=$medal->filename?></td>
        <td class="actions">
            <a href="admin/config/medal/<?=$medal->id?>" class="edit"></a>
            <a href="admin/config/delete_medal/<?=$medal->id?>" class="delete"></a>
        </td>
    </tr>
        <? endforeach; endif; ?>
    </tbody>
</table>

<div id="new-medal-block" class="newitem-block">
    <?=form_open_multipart('admin/config/create_medal');?>
    <p class="block-header">Новая медаль</p>
    <div class="param">
        <label for="name">Название:</label>
        <input type="text" name="name" id="name"/>
    </div>

    <div class="param">
        <label for="alt">Атрибут alt:</label>
        <input type="text" name="alt" id="alt"/>
    </div>

    <div class="param">
        <label for="title">Атрибут title:</label>
        <input type="text" name="title" id="title"/>
    </div>

    <div class="param">
        <label for="image">Картинка</label>
        <input type="file" name="image" id="image"/>
    </div>
    <input type="submit" class="noimg" value="Добавить"/>
    </form>
</div>