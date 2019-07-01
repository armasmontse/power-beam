<?php namespace App\Models\Traits\Setting;

trait ContactTrait {

	/**
    * Get the Mail values
    *
    * @return array[] with urls,
    */
    public static function getContact()
    {
        return self::getSetting('contact')->value;
    }

    public static function getContactPhone(){
        return array_get(self::getContact(), "phone");
    }

}
