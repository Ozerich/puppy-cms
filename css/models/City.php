<?php

class City extends ActiveRecord\Model
{
    static $table_name = "cities";

    public function get_commissions()
    {
        return Commission::all(array(
            'conditions' => array('city_id = ?', $this->id),
            "order" => '`from` ASC'));
    }
}

?>