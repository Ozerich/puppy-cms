<div class="block">
    <div class="block-header">Статьи</div>
    <div class="block-content" id="article_list">
        <? if (!isset($articles) || !$articles): ?>
        <div class="no-articles">
            Нету статей
        </div>
        <? else: foreach ($articles as $article): ?>
        <div class="article">
            <div class="article-image">
                <a href="statji/<?=$article->category ? $article->category->alias . '/' : ''?><?=$article->alias?>">
                    <img src="<?=Config::get('article_images_dir') . $article->image?>"/></a>
            </div>
            <div class="article-content">
                <h2><?=$article->title?></h2>

                <p><?=$article->preview?></p>
                <a class="view-article" href="statji/<?=$article->category ? $article->category->alias . '/' : ''?><?=$article->alias?>">Прочитать</a>
                <br clear="all"/>
            </div>
            <br clear="all"/>
        </div>
        <? endforeach; endif; ?>
    </div>
</div>