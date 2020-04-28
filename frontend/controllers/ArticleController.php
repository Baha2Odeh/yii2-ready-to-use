<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/15/18
 * Time: 1:54 PM
 */

namespace frontend\controllers;


use common\models\Article;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ArticleController extends Controller
{

    public function actionIndex($category=null){
        $articles = Article::find()->andWhere(['status' => Article::STATUS_ACTIVE]);

        if(!empty($category)){
            $category = Category::findOne(['slug'=>$category]);
            if(empty($category)){
                return $this->redirect(['article/index']);
            }
            $articles->andWhere(['category_id'=>$category->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $articles,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);


        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'category'=>$category
        ]);
    }
    public function actionView($id,$slug=null,$category=null){
        $model = $this->findModel($id);

        $route = $model->getRoute();

        if($route['slug'] != $slug || $route['category'] != $category){
            return $this->redirect($model->getRoute(),301);
        }



        return $this->render('view',[
           'model'=>$model,
        ]);
    }



    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne(['id'=>$id,'status'=>Article::STATUS_ACTIVE])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}