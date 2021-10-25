<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/15/18
 * Time: 1:58 PM
 */

/* @var $this \yii\web\View */
/* @var $model \common\models\Article */

?>


<a href="<?=$model->getUrl()?>">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?=$model->title?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-2">
                    <?=\yii\helpers\Html::img($model->getAvatar(),['class'=>'img-responsive','style'=>'width:100%'])?>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-10">
                    <?=$model->description?>
                </div>
                <div class="col-md-12">
                    <?=$model->user->username?>
                </div>
            </div>
        </div>
    </div>
</a>
