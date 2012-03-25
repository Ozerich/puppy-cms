<?php

class Field extends ActiveRecord\Model
{
    static $table_name = "fields";

    public static function weight_field()
    {
        return Field::find_by_code('weight');
    }

    public static function height_field()
    {
        return Field::find_by_code('height');
    }

    public function get_values()
    {
        if ($this->type != 'select') return array();

        return FieldVariant::find_all_by_field_id($this->id);
    }
}

?>