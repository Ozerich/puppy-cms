<div id="item_view" class="block">
    <div class="block-header"><?=$item->type == 'free' ? KindSetting::get($item->kind_id, $item->city_id)->phone.' бесплатная консультация по выбору щенка, рекомендуем только лучших!' : $item->user->phone?></div>
    <div class="block-content item-block">
        <div class="left-wrapper">
            <div class="item-image">
                <a rel="photo" href="<?=$item->preview_image?>"><img src="<?=$item->preview_image?>"/></a>
            </div>
            <div class="item-gallery">
                <p class="gallery-header">
                    <span>Галерея</span>
                    (нажмите на картинке для увеличения)
                </p>

                <div class="gallery-images">

                    <? $img_count = 1; foreach ($item->images as $image): if($image->image):?>
                    <a <?=$img_count++ % 2 == 0 ? 'class="odd"' : ''?> href="<?=Config::get('item_images_dir') . $image->image?>"  rel="photo"><img title=""
                            src="<?=Config::get('item_images_dir') . $image->image?>"/></a>
                    <? endif; endforeach; ?>
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


            </div>
        </div>
        <br clear="all"/>
    </div>
</div>