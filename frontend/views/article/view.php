<?php

/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/15/18
 * Time: 3:20 PM
 */

/* @var $this \yii\web\View */
/* @var $model \common\models\Article */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('title', 'Articles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('title', 'Articles About {category}', ['category' => $model->category->name]), 'url' => ['index','category'=>$model->category->slug]];
$this->params['breadcrumbs'][] = $model->title;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <div class="row">
                <div class="col-md-8">
                    <?=$model->title?>
                </div>
                <div class="col-md-4">
                    <?=Yii::$app->formatter->asDate($model->created_at)?>
                </div>
            </div>
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?=\yii\helpers\Html::img($model->getAvatar(null),['class'=>'img-responsive','style'=>'width:100%'])?>
            </div>
            <div class="col-md-12">
                <?=$model->user->username?>
            </div>
            <div class="col-md-12">
                <?=$model->body?>
            </div>
        </div>
    </div>
</div>
