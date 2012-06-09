<?php

class ItemMedal extends ActiveRecord\Model
{
    static $table_name = "item_medals";

    public static function reset($item_id = 0)
    {
        ItemMedal::table()->delete(array('item_id' => $item_id));
    }

    public static function get_medals($item_id = 0)
    {
        $result = array();

        $item_medals = ItemMedal::find_all_by_item_id($item_id);
        $medals_enable = array();
        foreach($item_medals as $item_medal)
            $medals_enable[] = $item_medal->medal_id;

        foreach(Medal::all() as $medal)
            $result[$medal->id] = in_array($medal->id, $medals_enable) ? 1 : 0;

        return $result;
    }
}

?>