<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-type-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create User Type'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'status:boolean',
                [
                    'attribute' => 'created_at',
                    'filterOptions' => ['style'=>'min-width:200px'],
                    //'format' => 'datetime',
                    'filter' => \kartik\widgets\DatePicker::widget([
                      'model' => $searchModel,
                      'attribute' => 'created_at',
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ])
                ],
                [
                    'attribute' => 'updated_at',
                    'filterOptions' => ['style'=>'min-width:200px'],
                    //'format' => 'datetime',
                    'filter' => \kartik\widgets\DatePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'updated_at',
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ])
                ],
//                'created_by',
//                 'updated_by',
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
