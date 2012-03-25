<?php

class Kind extends ActiveRecord\Model
{
    static $table_name = "kinds";

    public function get_animal()
    {
        return Animal::find_by_id($this->animal_id);
    }

    public function get_subkinds()
    {
        return Kind::all(array('conditions' => array('parent_id = ?', $this->id)));
    }

    public function get_is_weight()
    {
        $weight_field = Field::weight_field();
        if (!$weight_field)
            return false;

        return KindField::find(array('conditions' => array('kind_id = ? AND field_id = ?', $this->id, $weight_field->id))) ? 1 : 0;
    }

    public function get_is_height()
    {
        $field = Field::height_field();
        if (!$field)
            return false;

        return KindField::find(array('conditions' => array('kind_id = ? AND field_id = ?', $this->id, $field->id))) ? 1 : 0;
    }

    public function get_fields()
    {
        $result = array();

        foreach (KindField::find_all_by_kind_id($this->id) as $kind_field)
            $result[] = $kind_field->field;

        return $result;
    }

}

?>