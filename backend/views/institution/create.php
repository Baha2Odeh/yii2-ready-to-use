<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Institution */

$this->title = Yii::t('app', 'Create Institution');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Institutions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
