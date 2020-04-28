<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'country_id')->widget(\kartik\select2\Select2::className(),[
                    'data' => \common\models\Country::getCountryList('ar'),
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'arabic_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'alternate_names')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'position')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'province_id')->textInput() ?>
            </div>
        </div>












    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
