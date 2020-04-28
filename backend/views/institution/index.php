<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\InstitutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Institutions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="institution-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Institution'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
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
                'name_ar',
                'alternative_names:ntext',
                'type_id',
                [
                    'attribute' => 'country_id',
                    'value' => 'country.arabic_name',
                    'filter' => \kartik\select2\Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'country_id',
                            'data' => \common\models\Country::getCountryList('ar'),
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                            'options' => [
                                'placeholder' => Yii::t('app', 'Country'),
                            ]
                        ]
                    ),
                ],
                //'country_id',
                // 'ranking_id',
                // 'ivy_league',
                // 'global_rank',
                // 'language_id',
                // 'adder_type_id',
                // 'sector',
                // 'created_at',
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
