<?php

/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/15/18
 * Time: 1:57 PM
 */

/* @var $this \yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $category \common\models\Category */


if(!empty($category)) {
    $this->title = Yii::t('title', 'Articles About {category}', ['category' => $category->name]);
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articles'), 'url' => ['index']];
}else{
    $this->title = Yii::t('title', 'Articles');

}
$this->params['breadcrumbs'][] = $this->title;

?>




<?=\frontend\widgets\ListView::widget(['dataProvider' => $dataProvider,'itemView' => 'partial/_article_item'])?>
