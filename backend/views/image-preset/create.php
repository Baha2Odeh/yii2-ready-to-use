<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ImagePreset */

$this->title = Yii::t('app', 'Create Image Preset');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Presets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-preset-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
