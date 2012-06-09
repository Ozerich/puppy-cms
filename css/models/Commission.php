<?php

class Commission extends ActiveRecord\Model
{
    static $table_name = "commissions";

    public static function get_commission($city_id, $price)
    {
        $commission = Commission::find(array('conditions' => array('city_id = ? AND `from` <= ? AND `to` >= ?', $city_id, $price, $price)));
        return $commission ? $commission->value : 0;
    }
}

?>