<?php

class ItemField extends ActiveRecord\Model
{
    static $table_name = "item_fields";

    public static function reset($item_id = 0)
    {
        ItemField::table()->delete(array('item_id' => $item_id));
    }

    public static function get($item_id = 0, $field_id = 0)
    {
        $field = ItemField::find(array('conditions' => array('item_id = ? AND field_id = ?', $item_id, $field_id)));
        return $field ? $field->value : '0';
    }
}

?>