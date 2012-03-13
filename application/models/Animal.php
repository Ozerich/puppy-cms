<?php

class Animal extends ActiveRecord\Model
{
    static $table_name = "animals";

    public function get_organizations()
    {
        return Organization::find_all_by_animal_id($this->id);
    }
}

?>