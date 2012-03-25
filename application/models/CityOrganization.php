<?php

class CityOrganization extends ActiveRecord\Model
{
    static $table_name = "city_organizations";

    public static function check($city_id, $org_id)
    {
        return CityOrganization::find(array('conditions' => array('city_id = ? AND organization_id = ?', $city_id, $org_id)))
            ? true : false;
    }
}

?>