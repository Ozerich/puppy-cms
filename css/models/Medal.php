<?php

class Medal extends ActiveRecord\Model
{
    static $table_name = "medals";

    public function get_img()
    {
        return '<img src="' . Config::get('medals_dir') . $this->filename . '" alt="' . $this->alt.'" title="' . $this->title . '"/>';
    }
}

?>