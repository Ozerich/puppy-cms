<?php

class KindSetting extends ActiveRecord\Model
{
    static $table_name = "kind_settings";

    public static function get($kind_id = 0, $city_id = 0)
    {
        return KindSetting::find(array('conditions' => array('kind_id = ? AND city_id = ?', $kind_id, $city_id)));
    }
}

?>