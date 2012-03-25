<?php

class Animal extends ActiveRecord\Model
{
    static $table_name = "animals";

    public function get_organizations()
    {
        return Organization::find_all_by_animal_id($this->id);
    }

    public function get_kinds(){
        return Kind::all(array('conditions' => array('parent_id = 0 AND animal_id = ?', $this->id)));
    }

    public function get_documents(){
        return Document::find_all_by_animal_id($this->id);
    }
}

?>