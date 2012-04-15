<div id="item_view" class="block">
    <div class="block-header">8 499 608-08-01 бесплатная консультация по выбору щенка, рекомендуем только лучших!</div>
    <div class="block-content item-block">
        <div class="left-wrapper">
            <div class="item-image">
                <a href="<?=$item->preview_image?>"><img src="<?=$item->preview_image?>"/></a>
            </div>
            <div class="item-gallery">
                <p class="gallery-header">
                    <span>Галерея</span>
                    (нажмите на картинке для увеличения)
                </p>

                <div class="gallery-images">

                    <? $img_count = 1; foreach ($item->images as $image): ?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?> href="<?=Config::get('item_images_dir') . $image->image?>"  rel="photo"><img title=""
                            src="<?=Config::get('item_images_dir') . $image->image?>"/></a>
                    <? endforeach; ?>
                    <? if ($item->mother_image): ?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?> href="<?=Config::get('item_images_dir') . $item->mother_image?>" rel="photo"><img title="Папа"
                            src="<?=Config::get('item_images_dir') . $item->mother_image?>"/></a>
                    <? endif; ?>
                    <? if ($item->father_image): ?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?> href="<?=Config::get('item_images_dir') . $item->father_image?>" rel="photo"><img title="Мама"
                            src="<?=Config::get('item_images_dir') . $item->father_image?>"/></a>
                    <? endif; ?>
                </div>
            </div>
        </div>
        <div class="right-wrapper">
		<div class="top-content-wr">
            <div class="item-info">
                <span class="item-price"><?=$item->site_price?> <?=$item->city->valute?></span>

                <div class="item-medals">
                        <? $item_medals = ItemMedal::get_medals($item->id);
                        foreach ($item_medals as $ind => $medal): if (!$medal) continue;
                            $medal = Medal::find_by_id($ind);?>
                            <img alt="<?=$medal->alt?>" title="<?=$medal->title?>"
                                 src="<?=Config::get('medals_dir') . $medal->filename?>"/>
                            <? endforeach; ?>
                </div>
            </div>
            <div class="top-content">
                <h2><?=$item->preview_header?></h2>

                <p><?=$item->preview_text?></p>
            </div>
			<br clear="all"/>
		</div>
            <div class="main-content">

                <?=$item->full_text?>

                <p class="author-word">
                    P.S. Пара слов от создателя сайта, Ольги Куракиной: <br/>
                    Мой сайт создан, чтобы вы могли купить качественного щенка и не переплатить. На сайте мы (комманда
                    проекта) выставляем только лучшие объявления по продаже щенков от проверенных питомников. За годы
                    существования моих сайтов я накопила информацию о питомниках: у кого-то из них получаются удачные
                    мини-щенки, у кого-то отличные стандартные девочки для разведения, у кого-то щенки наследуют
                    велликолепную шерсть или строение от матери, все это учесть при выборе щенка поможет консультант
                    сайта.</br>
                    Наверное, вы задаетесь вопросом, с чего это кто-то бесплатно консультирует?
                    Пока вы довольны и сайт имеет славу, заводчики оплачивают размещение объявлений, что позволяет мне
                    организовывать работу сайта и оплачивать труд консультантов, поэтому мне не все равно какого щенка
                    вы купите и я готова оплачивать труд консультантов, чтобы вы оставались довольны.
                </p>
            </div>
        </div>
        <br clear="all"/>
    </div>
</div>