<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/2/18
 * Time: 10:57 PM
 */
/** @var $model \common\models\User */
/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->registerCss(<<<CSS
.avatar-wrapper img{
max-width:200px;
}
CSS
);
?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'value' => 'institution.name',
            'label' => Yii::t('app', 'institution name')
        ],
        'type',
        'date',
        'description',
        [
            'value' => 'media.url',
            'format' => 'image',
            'contentOptions' => ['class' => 'avatar-wrapper']

        ],
    ]
]) ?>
