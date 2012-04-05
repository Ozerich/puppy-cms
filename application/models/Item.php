<?php

class Item extends ActiveRecord\Model
{
    static $table_name = "items";

    public function get_documents()
    {
        $result = array();
        $item_docs = ItemDocument::find_all_by_item_id($this->id);

        foreach ($item_docs as $doc)
            $result[] = Document::find_by_id($doc->document_id);

        return $result;
    }

    public function get_kind()
    {
        return Kind::find_by_id($this->kind_id);
    }
}

?>