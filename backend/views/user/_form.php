<?php

use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsEducations \common\models\Education[] */

$citesUrls = \yii\helpers\Url::to(['helper/city']);
$selectCity = Yii::t('app', 'Select City');
$this->registerJs(<<<JS
    
    
    $(document).on('change','#user-country-id',function(){
        var country_id = $(this).val();
         jQuery.ajax({
                type : "GET",
                url  : "$citesUrls",
                data : {country_id:country_id},
            }).done(function(response) {
                var new_options = '';
                    new_options += '<option value = "">$selectCity</option>';
                $.each(response, function(id,name) {
                    new_options += '<option value = "'+id+'">'+name+'</option>';
                });
                $('#user-city-list').empty().append(new_options);
            });
        
        
        
    });

JS
    , \yii\web\View::POS_END);
?>

<div class="user-form box box-primary">
    <?php $form = ActiveForm::begin([
        'id' => 'user-form',
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
        'validateOnChange' => true,
        'validateOnBlur' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
            'id' => 'user-form'
        ]
    ]); ?>
    <div class="box-body table-responsive">

        <div class="row">

            <div class="col-md-4">
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'user_type_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \common\models\UserType::getNameList(),
                    'id' => 'user-user_type_id',
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Select User Type'),
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'gender')->widget(\kartik\select2\Select2::className(), [
                    'data' => \common\models\User::getEnumValues('gender'),
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Select Gender'),
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'dob')->widget(\kartik\widgets\DatePicker::className(), [
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Select Date of birth'),
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 phone-number-full-width">
                <?= $form->field($model, 'phone_number')->widget(\borales\extensions\phoneInput\PhoneInput::className(), [
                    'jsOptions' => [
                        'preferredCountries' => [\common\components\GeoHelper::getCurrentCountryIsoCode()],
                    ]
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'country_id')->widget(\kartik\select2\Select2::className(), [
                    'id' => 'user-country-id',
                    'data' => \common\models\Country::getCountryList('ar'),
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Select Country'),
                        'allowClear' => true
                    ],
                    'options' => ['id' => 'user-country-id'],
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'city_id')->widget(\kartik\select2\Select2::className(), [
                    'id' => 'user-city-list',
                    'data' => !empty($model->country->cities) ? ArrayHelper::map($model->country->cities, 'id', 'name') : [],
                    'pluginOptions' => [
                        'placeholder' => Yii::t('app', 'Select City'),
                        'allowClear' => true
                    ],
                    'options' => ['id' => 'user-city-list']
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'confirm_password')->passwordInput() ?>
            </div>

        </div>


       <div class="row">
           <div class="col-md-6">
               <?php
               $modelImage = !empty($model->media) ? $model->media : false;
               $initialPreview = [];
               if ($modelImage) {
                   $pathImg = $modelImage->getThumb();
                   $initialPreview[] = Html::img($pathImg, ['class' => 'file-preview-image']);
               }
               ?>
               <?= $form->field($model, "image")->label(false)->widget(FileInput::classname(), [
                   'options' => [
                       'multiple' => false,
                       'accept' => 'image/*',
                   ],
                   'pluginOptions' => [
                       'previewFileType' => 'image',
                       'showCaption' => false,
                       'showUpload' => false,
                       'browseClass' => 'btn btn-default btn-sm',
                       'browseLabel' => ' Pick image',
                       'browseIcon' => '<i class="glyphicon glyphicon-picture"></i>',
                       'removeClass' => 'btn btn-danger btn-sm',
                       'removeLabel' => ' Delete',
                       'removeIcon' => '<i class="fa fa-trash"></i>',
                       'previewSettings' => [
                           'image' => ['width' => '138px', 'height' => 'auto']
                       ],
                       'initialPreview' => $initialPreview,
                       'layoutTemplates' => ['footer' => '']
                   ]
               ]) ?>
           </div>
           <div class="col-md-6">
               <?= $form->field($model, 'status')->checkbox() ?>
           </div>
       </div>


        <div class="row">
            <div class="col-md-12">
                <?= $this->render('partial/education', ['form' => $form, 'model' => $model, 'modelsEducations' => $modelsEducations]) ?>
            </div>
        </div>

        <?= Html::errorSummary($model) ?>
        <?= Html::errorSummary($modelsEducations) ?>
    </div>

    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
