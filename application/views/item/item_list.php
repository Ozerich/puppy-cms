<div id="item_list">
    <? foreach ($items as $item): ?>
    <div class="item-block">
        <div class="item-image">
            <img src="<?=$item->preview_image?>"/>
        </div>
        <div class="item-content-wr">
            <div class="item-info">
                <span class="item-price"><?=$item->site_price?> <?=$item->city->valute?></span>

                <div class="item-medals">

                </div>
            </div>
            <div class="item-content">
                <h2><?=$item->preview_header?></h2>

                <p><?=$item->preview_text?></p>
            </div>
            <div class="item-bottom">
                <div class="item-actions">
                    <a href="view/<?=$item->id?>">Смотреть</a>
                    <a href="view/<?=$item->id?>">Управление</a>
                </div>
                <div class="item-bottom-text">
                    +7 499 608-08-91 Консультант по породе бесплатно поможет вам выбрать щенка, пососветует питомник и
                    даст номер телефона заводчикау которого вы сможете посмотреть и купить щенка
                </div>
                <br clear="all"/>
            </div>
        </div>
    </div>
    <div class="item-admin">
        
    </div>
    <? endforeach; ?>
</div>