<?php

class ItemDocument extends ActiveRecord\Model
{
    static $table_name = "item_documents";

    public static function reset($item_id = 0)
    {
        ItemDocument::table()->delete(array('item_id' => $item_id));
    }

    public function get_document()
    {
        return Document::find_by_id($this->document_id);
    }

    public static function get($item_id = 0)
    {
        $docs = ItemDocument::find_all_by_item_id($item_id);

        $result = array();
        foreach ($docs as $doc)
            if ($doc->document_id)
                $result[] = $doc->document->name;

        return $result;
    }
}

?>