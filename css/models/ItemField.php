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
        $field_type = Field::find_by_id($field_id)->type;
        $field = ItemField::find(array('conditions' => array('item_id = ? AND field_id = ?', $item_id, $field_id)));
        if(!$field)
            return '0';
        else
            return $field_type == "select" ? FieldVariant::find_by_id($field->value)->value : $field->value;

    }
}

?>