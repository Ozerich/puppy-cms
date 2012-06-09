<?php

class Organization extends ActiveRecord\Model
{
    static $table_name = "organizations";

    public function get_plain_text(){
        return $this->name.($this->description ? ' ('.$this->description.')' : '');
    }
}

?>