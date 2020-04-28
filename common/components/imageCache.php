<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/11/17
 * Time: 12:56 PM
 */

namespace common\components;


use common\models\Media;
use Yii;
use yii\helpers\BaseFileHelper;

class imageCache extends \yii\base\Component
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }


    public function url($image,$size=null){
        if(is_object($image) && $image instanceof Media){
            $image = $image->path . ($image->type == Media::TYPE_VIDEO ? '.png' : '');
        }
        if($size) {
            return rtrim(Yii::$app->params['urls']['cdn'], "/") . '/cache/' . $size . '/' . ltrim($image, "/");
        }else{
            return rtrim(Yii::$app->params['urls']['cdn'], "/") . '/' . ltrim($image, "/");
        }
    }

    public function resize404Image($size){
        $srcImagePath = Yii::getAlias("@frontend/web/theme/imgs/404_placeholder.jpg");
        $cachePath = Yii::getAlias("@cdn/cache/".$size.'/404.jpg');
        // image already created
        if(is_file($cachePath)){
            $image = new \Imagick($cachePath);
            return $image;
        }
        // Check whether there is a source file
        if(!is_file($srcImagePath))
            return false;

        $image = $this->createCachedFile ($srcImagePath, $cachePath, $size);

        return $image;
    }

    /**
     * @param $original_image
     * @param $size
     * @return bool|\Imagick|null
     * @throws \ImagickException
     * @throws \yii\base\Exception
     */
    public function resizeImage($original_image, $size) {

        $srcImagePath = Yii::getAlias("@cdn/".$original_image);
        $cachePath = Yii::getAlias("@cdn/cache/".$size.'/'.$original_image);

        // image already created
        if(is_file($cachePath)){
            $image = new \Imagick($cachePath);
            return $image;
        }
        // Check whether there is a source file
        if(!is_file($srcImagePath))
            return false;

        $image = $this->createCachedFile ($srcImagePath, $cachePath, $size);

        return $image;

    }


    /**
     * @param $srcImagePath
     * @param $pathToSave
     * @param $size
     * @return bool|\Imagick
     * @throws \ImagickException
     * @throws \yii\base\Exception
     */
    private function createCachedFile($srcImagePath, $pathToSave, $size)
    {

        if (!file_exists($srcImagePath) || !is_file($srcImagePath)) {
            return false;
        }

        BaseFileHelper::createDirectory(dirname($pathToSave), 0777, true);
        $size =  $this->parseSize($size);
//        if($this->graphicsLibrary == 'Imagick'){
        $image = new \Imagick($srcImagePath);
        $image->setImageCompressionQuality(100);
        if($size){
            if($size['height'] && $size['width']){
                $image->scaleImage($size['width'], $size['height'],true);
            }elseif($size['height']){
                $image->thumbnailImage(0, $size['height']);
            }elseif($size['width']){
                $image->thumbnailImage($size['width'], 0);
            }else{
                throw new \Exception('Error at $this->parseSize($sizeString)');
            }
        }
        $image->writeImage($pathToSave);
//        }
        if(!is_file($pathToSave))
            throw new \Exception('Error while creating cached file');
        return $image;
    }
    /**
     * Parses size string
     * For instance: 400x400, 400x, x400
     * @param $sizeString
     * @return array|null
     */
    private function parseSize($sizeString)
    {
        $sizeArray = explode('x', $sizeString);
        $part1 = (isset($sizeArray[0]) and $sizeArray[0] != '');
        $part2 = (isset($sizeArray[1]) and $sizeArray[1] != '');
        if ($part1 && $part2) {
            if (intval($sizeArray[0]) > 0
                &&
                intval($sizeArray[1]) > 0
            ) {
                $size = [
                    'width' => intval($sizeArray[0]),
                    'height' => intval($sizeArray[1])
                ];
            } else {
                $size = null;
            }
        } elseif ($part1 && !$part2) {
            $size = [
                'width' => intval($sizeArray[0]),
                'height' => null
            ];
        } elseif (!$part1 && $part2) {
            $size = [
                'width' => null,
                'height' => intval($sizeArray[1])
            ];
        } else {
            throw new \Exception('Error parsing size.');
        }
        return $size;
    }

}