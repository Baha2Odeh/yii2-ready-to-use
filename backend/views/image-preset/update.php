<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePreset */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Image Preset',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Presets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="image-preset-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
