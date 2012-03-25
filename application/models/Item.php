<?php

class Item extends ActiveRecord\Model
{
    static $table_name = "items";

    public function get_documents()
    {
        return ItemDocument::find_all_by_item_id($this->id);
    }
}

?>