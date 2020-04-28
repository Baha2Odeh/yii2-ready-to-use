<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 11/23/18
 * Time: 11:20 PM
 */

namespace common\components;


class StringHelper extends \yii\helpers\StringHelper
{
    /**
     * @author Bahaa Odeh
     * @param $string
     * @param string $separator
     * @param null $words_limit
     * @return string
     */
    public static function slug($string, $separator = '-',$words_limit=null) {
        if (is_null($string) || empty($string)) {
            return "";
        }

        if(is_array($string)){
            $string = implode(" ",$string);
        }
        $string = strip_tags(html_entity_decode($string));
        $string = trim($string);
        if(!empty($words_limit)){
            $string = self::truncateWords($string,$words_limit,'');
        }

        $x = hex2bin('c2a0');
        $string = str_replace($x,' ',$string);


        $string = str_replace(
            ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'],
            ['0','1','2','3','4','5','6','7','8','9'],$string);
        // Remove spaces from the beginning and from the end of the string
        $string = trim($string);

        // Lower case everything
        // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
        $string = mb_strtolower($string, "UTF-8");



        // Make alphanumeric (removes all other characters)
        // this makes the string safe especially when used as a part of a URL
        // this keeps latin characters and arabic charactrs as well
        $string = preg_replace("/[^a-z0-9\p{Arabic}\s]/u", "", $string);

        //
        // Remove multiple dashes or whitespaces
//        $string = str_replace("  ", " ", $string);
        $string = preg_replace('/\s+/', ' ', $string);
        $string = str_replace(" ", $separator, $string);

        //var_dump(trim($string));exit;
        // Convert whitespaces and underscore to the given separator
        //$string = preg_replace("/[\s_]/", $separator, $string);

        $string = ltrim($string,"-");
        $string = rtrim($string,"-");

        return $string;
    }


    public static function splitName($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }
}