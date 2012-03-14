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
        return Kind::find_all_by_parent_id($this->id);
    }

}

?>