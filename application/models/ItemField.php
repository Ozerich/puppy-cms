<?php

class ItemField extends ActiveRecord\Model
{
    static $table_name = "item_fields";

    public static function reset($item_id = 0)
    {
        ItemField::table()->delete(array('item_id' => $item_id));
    }
}

?>