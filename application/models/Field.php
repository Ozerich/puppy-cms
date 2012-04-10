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

    public static function wool_field_id(){
        return Field::find_by_code('wool_length')->id;
    }

    public static function tail_field_id(){
        return Field::find_by_code('tail')->id;
    }

    public static function okras_field_id(){
        return Field::find_by_code('okras')->id;
    }

    public static function ears_field_id(){
        return Field::find_by_code('ears')->id;
    }

    public static function bite_field_id(){
        return Field::find_by_code('bite')->id;
    }

    public function get_values()
    {
        if ($this->type != 'select') return array();

        return FieldVariant::find_all_by_field_id($this->id);
    }
}

?>