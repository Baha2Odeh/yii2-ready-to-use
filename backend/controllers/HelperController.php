<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/1/18
 * Time: 1:10 AM
 */

namespace backend\controllers;


use common\components\FileUploadHelper;
use common\models\Media;

class HelperController extends \common\controllers\HelperController
{




    /**to use only for file browser (picker) for tinymce**/
    public function actionFileBrowser(){

        $media = new Media();
        if(\Yii::$app->request->isPost){
            $media->file = \yii\web\UploadedFile::getInstance( $media,"file");
            if($media->validate('file')) {
                $media = FileUploadHelper::upload($media->file);
            }
        }

        return $this->renderAjax('file-browser',['model'=>$media]);
    }
}