<?php

/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/1/18
 * Time: 10:58 AM
 */

use kartik\widgets\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\JsExpression;

/* @var $this \yii\web\View */
/* @var $form \yii\widgets\ActiveForm|static */
/* @var $modelsEducations \common\models\Education[] */
/* @var $model \common\models\User|\yii\db\ActiveRecord */


?>
<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'limit' => 4, // the maximum times, an element can be added (default 999)
    'min' => 0, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $modelsEducations[0],
    'formId' => $form->id,
    'formFields' => [
        'institution_id',
        'type',
        'description',
        'date',
        'image',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <i class="glyphicon glyphicon-envelope"></i> <?=Yii::t('app','Educations')?>
            <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> <?=Yii::t('app','Add')?></button>
        </h4>
    </div>
    <div class="panel-body">
        <div class="container-items"><!-- widgetBody -->
            <?php foreach ($modelsEducations as $i => $education): ?>
                <div class="item panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"><?=Yii::t('app','Education')?></h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        // necessary for update action.
                        if (!$education->isNewRecord) {
                            echo Html::activeHiddenInput($education, "[{$i}]id");
                            echo Html::activeHiddenInput($education, "[{$i}]media_id");
//                            echo Html::activeHiddenInput($education, "[{$i}]deleteImg");
                        }
                        ?>
                       <div class="row">
                           <div class="col-md-6">
                               <?= $form->field($education,  "[{$i}]institution_id")->widget(\kartik\select2\Select2::className(), [
                                   'data' => !empty($education->institution) ? ArrayHelper::map([$education->institution],'id','name'): [],
                                   'pluginOptions' => [
                                       'minimumInputLength' => 3,
                                       'placeholder' => Yii::t('app', 'Select institution'),
                                       'allowClear' => true,
                                       'ajax' => [
                                           'url' => \yii\helpers\Url::to(['helper/institution']),
                                           'dataType' => 'json',
                                           'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                       ],
                                   ],
                               ]) ?>
                               <?= $form->field($education, "[{$i}]type")->dropDownList(\common\models\Education::getEnumValues('type')) ?>
                               <?= $form->field($education, "[{$i}]description")->textInput(['maxlength' => true]) ?>
                               <?= $form->field($education, "[{$i}]date")->widget(\kartik\widgets\DatePicker::className(), [
                                       'options' => ['class'=>'date-input'],
                                   'pluginOptions' => [
                                       'placeholder' => Yii::t('app', 'Select Date'),
                                       'autoclose' => true,
                                       'format' => 'yyyy-mm-dd'
                                   ]
                               ]) ?>
                           </div>
                           <div class="col-md-6">
                               <?php
                               $modelImage = !empty($education->media) ? $education->media : false;
                               $initialPreview = [];
                               if ($modelImage) {
                                   $pathImg = $modelImage->getThumb();
                                   $initialPreview[] = Html::img($pathImg, ['class' => 'file-preview-image']);
                               }
                               ?>
                               <?= $form->field($education, "[{$i}]image")->label(false)->widget(FileInput::classname(), [
                                   'options' => [
                                       'multiple' => false,
                                       'accept' => 'image/*',
                                       'class' => 'education-image'
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

                       </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div><!-- .panel -->
<?php DynamicFormWidget::end(); ?>


<?php
$this->registerJs(<<<JS
// function initSelect2Loading(a,b){ initS2Loading(a,b); }
// function initSelect2DropStyle(id, kvClose, ev){ initS2ToggleAll(id, kvClose, ev); }


JS
,\yii\web\View::POS_HEAD);
$this->registerJs(<<<JS
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    
    
    $( ".date-input" ).each(function() {
            $( this ).kvDatepicker({
            format : 'yyyy-mm-dd',
            autoclose:true,
            placeholder:'select date',
          });
            
            initDPRemove($( this ).attr('id'));
            initDPAddon($( this ).attr('id'));

        });
    
    
    // console.log("afterInsert");
    // console.log(item);
    // let  iss_id = $(item).find('[data-type="select2"]');//.select2();
    // //$('#user-city-list').select2();
    // let placeholder = $(iss_id).attr('data-placeholder');
    // let select2_id = $(iss_id).attr('id');
    // $.when($(iss_id).select2({
    // "placeholder":placeholder,
    // "allowClear":true,
    // "theme":"krajee",
    // "width":"100%",
    // "language":"en-US"
    // })).done(initS2Loading(select2_id,{
    //     "themeCss":".select2-container--krajee",
    //     "sizeCss":"",
    //     "doReset":true,
    //     "doToggle":false,
    //     "doOrder":false
    // }));

    
});
JS
,\yii\web\View::POS_END);
?>
