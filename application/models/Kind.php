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

}

?>