<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 11/23/18
 * Time: 11:20 PM
 */

namespace common\components;


use common\models\Country;

class GeoHelper
{
    /**
     * @return Country|boolean
     */
    public static function getCurrentCountry()
    {
        if (!empty($_SERVER['HTTP_CF_IPCOUNTRY'])) {
            $country = Country::find()->cache(true)->andWhere(['iso' => $_SERVER['HTTP_CF_IPCOUNTRY']])->one();
            if (!empty($country)) {
                return $country;
            }
        }else{
            return Country::findOne(['id'=>Country::JORDAN]);
        }
        return false;
    }
    public static function getCurrentCountryIsoCode(){
        $currentCountry = self::getCurrentCountry();
        if(!empty($currentCountry)){
            return $currentCountry->iso;
        }

        return 'jo';
    }
    public static function getCurrentCountryId(){
        $currentCountry = self::getCurrentCountry();
        if(!empty($currentCountry)){
            return $currentCountry->id;
        }

        return Country::JORDAN;
    }

}