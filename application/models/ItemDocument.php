<?php

class ItemDocument extends ActiveRecord\Model
{
    static $table_name = "item_documents";

    public static function reset($item_id = 0)
    {
        ItemDocument::table()->delete(array('item_id' => $item_id));
    }
}

?>