<?php

class KindField extends ActiveRecord\Model
{
    static $table_name = "kind_fields";

    public function get_field()
    {
        return Field::find_by_id($this->field_id);
    }
}

?>