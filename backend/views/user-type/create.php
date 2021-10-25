<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserType */

$this->title = Yii::t('app', 'Create User Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-type-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
