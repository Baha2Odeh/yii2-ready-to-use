<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 9/18/18
 * Time: 11:04 PM
 */

namespace common\controllers;


use common\models\ImagePreset;
use Yii;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ImageResizeController extends Controller
{

    public function actionIndex($size,$path){
        $imagePreset = ImagePreset::findOne(['name'=>$size]);

        if(empty($imagePreset)){
            throw new NotFoundHttpException('Not Allowed image preset');
        }





        if(StringHelper::endsWith($path,'.mp4.png') || StringHelper::endsWith($path,'.wov.png')){
            $videoPath = str_replace('.mp4.png','.mp4',$path);
            $videoPath = str_replace('.wov.png','.wov',$videoPath);
            $videoPath = Yii::getAlias("@cdn/".$videoPath);
            if(file_exists($videoPath) && !file_exists($videoPath.'.png')){
                shell_exec(Yii::$app->params['ffmpeg']." -i $videoPath -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $videoPath.png 2>&1");
            }
        }

        if(!file_exists(Yii::getAlias('@cdn/'.$path))){
            $result =  Yii::$app->imageCache->resize404Image($imagePreset->width.'x'.$imagePreset->height);
            header("HTTP/1.0 404 Not Found");
            header('Content-type: ' . $result->getImageMimeType());
            echo $result->getImageBlob();
            exit;
        }

        $result = Yii::$app->imageCache->resizeImage($path,$imagePreset->width.'x'.$imagePreset->height);
        if(!$result){
            throw new NotFoundHttpException('invalid service configuration');
        }

        header('Content-type: ' . $result->getImageMimeType());
        echo $result->getImageBlob();
        exit;
    }
}