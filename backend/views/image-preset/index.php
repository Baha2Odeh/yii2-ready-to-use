<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ImagePresetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Image Presets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-preset-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Image Preset'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                'width',
                'height',
                'created_at',
                // 'created_by',
                // 'updated_at',
                // 'updated_by',
                // 'is_deleted',
                // 'deleted_at',
                // 'deleted_by',
                // 'ip_address',
                // 'user_agent',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
