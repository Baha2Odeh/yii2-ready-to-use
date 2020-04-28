<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Institution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="institution-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name_ar')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'alternative_names')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'country_id')->widget(\kartik\select2\Select2::className(),[
                    'data' => \common\models\Country::getCountryList('ar'),
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'type_id')->widget(\kartik\select2\Select2::className(),[
                    'data' => \common\models\Institution::getEnumValues('type_id'),
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'ranking_id')->widget(\kartik\select2\Select2::className(),[
                    'data' => \common\models\Institution::getEnumValues('ranking_id'),
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'ivy_league')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'global_rank')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'language_id')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'adder_type_id')->widget(\kartik\select2\Select2::className(),[
                    'data' => \common\models\Institution::getEnumValues('adder_type_id'),
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'sector')->widget(\kartik\select2\Select2::className(),[
                    'data' => \common\models\Institution::getEnumValues('sector'),
                ]) ?>
            </div>

        </div>















    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
