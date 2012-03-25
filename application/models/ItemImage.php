<?php

class ItemImage extends ActiveRecord\Model
{
    static $table_name = "item_images";

    public static function reset($item_id = 0)
    {
        ItemImage::table()->delete(array('item_id' => $item_id));
    }
}

?>