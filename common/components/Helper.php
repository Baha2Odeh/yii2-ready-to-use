<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 11/24/18
 * Time: 1:50 PM
 */

namespace common\components;


use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

class Helper
{

    public static function formatMobileNumber($phone, $country_code = null)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $mobileNumber = preg_replace(array('/[^0-9]/', '/^0*/'), '', $phone);
            if (!empty($country_code)) {
                $cleanCountryCode = preg_replace(array('/[^0-9]/', '/^0*/'), '', $country_code);
                $mobileNumber = $cleanCountryCode . $mobileNumber;
            }
            $parsedPhone = $phoneUtil->parse('+' . $mobileNumber);
            $isValid = $phoneUtil->isValidNumber($parsedPhone);
            if ($isValid) {
                return '+' . $parsedPhone->getCountryCode() . $parsedPhone->getNationalNumber();
            }

        } catch (NumberParseException $e) {

        }

        if (empty($country_code)) {
            $currentCountry = GeoHelper::getCurrentCountry();
            if (!empty($currentCountry) && !empty($currentCountry->iso)) {
                return self::formatMobileNumber($phone, $currentCountry->dialing_code_1);
            }
        }
        return false;
    }
}