<?php

class Config extends ActiveRecord\Model
{
    static $table_name = "config";

    public static function set($param = '', $value = '')
    {
        $item = Config::find_by_param($param);
        if (!$item)
            $item = Config::create(array('param' => $param));

        $item->value = $value;
        $item->save();

        return true;
    }

    public static function get($param = '')
    {
        $item = Config::find_by_param($param);
        return $item ? $item->value : '';
    }
}

?>