<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\InstitutionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institution-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'alternative_names') ?>

    <?= $form->field($model, 'type_id') ?>

    <?= $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'ranking_id') ?>

    <?php // echo $form->field($model, 'ivy_league') ?>

    <?php // echo $form->field($model, 'global_rank') ?>

    <?php // echo $form->field($model, 'language_id') ?>

    <?php // echo $form->field($model, 'adder_type_id') ?>

    <?php // echo $form->field($model, 'sector') ?>

    <?php // echo $form->field($model, 'name_ar') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'ip_address') ?>

    <?php // echo $form->field($model, 'user_agent') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
