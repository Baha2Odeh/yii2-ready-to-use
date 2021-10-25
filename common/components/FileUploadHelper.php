<?php
/**
 * Created by PhpStorm.
 * User: bahaa
 * Date: 10/24/18
 * Time: 8:10 PM
 */

namespace common\components;


use common\models\Media;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class FileUploadHelper
{

    /**
     * @param $type
     * @return bool|string
     */
    public static function createUploadPath($type){
        $path =  $type.'/'.date("Y").'/'.date("m").'/'.date('d').'/';
        $savePath = Yii::getAlias('@cdn/' . $path);
        if(!file_exists($savePath) && !FileHelper::createDirectory($savePath)){
            return false;
        }

        return $path;
    }
    public static function upload(UploadedFile $file){
        $type = explode('/',$file->type);

        $type = (count($type) == 2 && $type[0] == Media::TYPE_VIDEO) ? Media::TYPE_VIDEO : Media::TYPE_IMAGE;


        $uploadPath = self::createUploadPath($type);
        if(!$uploadPath){
            return false;
        }

        $saveName = $uploadPath . md5($file->baseName.time()).'.'.$file->extension;

        if(!$file->saveAs(Yii::getAlias('@cdn/' . $saveName))){
            return false;
        }

        $media = new Media();
        $media->path = $saveName;
        $media->name = $file->baseName;
        $media->size = $file->size;
        $media->extension = $file->extension;
        $media->type = $type;

        if($media->save()){
            return $media;
        }

        return false;
    }

}