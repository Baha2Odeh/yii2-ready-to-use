<?php

use common\lib\i18nModule\models\SourceMessage;
use common\lib\i18nModule\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\i18nModule\models\SourceMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('Source Messages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="element-box box box-primary">

    <div class="box-header with-border">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="box-body table-responsive">
        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $searchModel->getColumns(),
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
