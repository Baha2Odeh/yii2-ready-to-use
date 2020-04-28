<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ImagePreset */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Image Presets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-preset-view box box-primary">
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'width',
                'height',
                'created_at:datetime',
                'created_by',
                'updated_at:datetime',
                'updated_by',
                'is_deleted',
                'deleted_at',
                'deleted_by',
                'ip_address',
                'user_agent',
            ],
        ]) ?>
    </div>
</div>
