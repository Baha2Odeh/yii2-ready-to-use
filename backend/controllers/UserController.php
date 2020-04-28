<?php

namespace backend\controllers;

use common\components\FileUploadHelper;
use common\models\ActiveRecord;
use common\models\Education;
use common\models\UserType;
use Yii;
use common\models\User;
use common\models\search\UserSearch;
use backend\controllers\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function verbs()
    {
        return [
            'delete' => ['POST'],
        ];
    }
    public function rules()
    {
        return [
            [
                'actions' => ['index','view','create','update','delete','profile'],
                'allow' => true,
                'roles' => ['manageUser'],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'educationDataProvider' => new ActiveDataProvider(['query' => $model->getEducations()])
        ]);
    }

    public function actionProfile(){
        return $this->actionUpdate(Yii::$app->user->identity->id);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => 'create']);
        $modelsEducations = [new Education()];
        if ($model->load(Yii::$app->request->post())) {


######
            /** @var Education[] $modelsEducations */
            $modelsEducations = ActiveRecord::createMultiple(Education::classname());
            ActiveRecord::loadMultiple($modelsEducations, Yii::$app->request->post());
            foreach ($modelsEducations as $index => $education) {
                $education->image = \yii\web\UploadedFile::getInstance($education, "[{$index}]image");
            }

            $model->image = \yii\web\UploadedFile::getInstance($model, "image");




            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsEducations),
                        ActiveForm::validate($model)
                    );

            }


            // validate all models
            $valid = $model->validate();
            $valid = ActiveRecord::validateMultiple($modelsEducations) && $valid;



            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if(!empty($model->image)){
                        $media = FileUploadHelper::upload($model->image);
                        if(!empty($media)){
                            $model->media_id = $media->id;
                        }
                    }
                    if ($flag = $model->save(false)) {




                        foreach ($modelsEducations as $education) {
                            $education->user_id = $model->id;
                            if(!empty($education->image)){
                                $media = FileUploadHelper::upload($education->image);
                                if(!empty($media)){
                                    $education->media_id = $media->id;
                                }
                            }
                            if (($flag = $education->save(false)) === false) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }


            ######


        }

        return $this->render('create', [
            'model' => $model,
            'modelsEducations' => (empty($modelsEducations)) ? [new Education] : $modelsEducations,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelsEducations = $model->educations;
        if ($model->load(Yii::$app->request->post())) {


            $oldIDs = ArrayHelper::map($modelsEducations, 'id', 'id');
            /** @var Education[] $modelsEducations */
            $modelsEducations = ActiveRecord::createMultiple(Education::classname(), $modelsEducations);
            Education::loadMultiple($modelsEducations, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsEducations, 'id', 'id')));

            foreach ($modelsEducations as $index => $education) {
                $education->image = \yii\web\UploadedFile::getInstance($education, "[{$index}]image");
            }
            $model->image = \yii\web\UploadedFile::getInstance($model, "image");





            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                    return ArrayHelper::merge(
                        ActiveForm::validateMultiple($modelsEducations),
                        ActiveForm::validate($model)
                    );

            }


            $valid = $model->validate();
            $valid = ActiveRecord::validateMultiple($modelsEducations) && $valid;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if(!empty($model->image)){
                        $media = FileUploadHelper::upload($model->image);
                        if(!empty($media)){

                            if(!empty($model->media)){
                                //delete old image from database only from database
                                $model->media->delete();
                            }

                            $model->media_id = $media->id;
                        }
                    }
                    if ($flag = $model->save(false)) {


                        if (!empty($deletedIDs)) {
                           $deletedEducations = Education::find()->andWhere(['id'=>$deletedIDs])->all();
                           foreach ($deletedEducations as $deletedEducation){
                                   if (!empty($deletedEducation->media)) {
                                       //delete old image from database only from database
                                       $deletedEducation->media->delete();
                                   }
                               $deletedEducation->delete();
                           }
                        }

                        if ($flag) {
                            foreach ($modelsEducations as $education) {
                                $education->user_id = $model->id;
                                if(!empty($education->image)){
                                    $media = FileUploadHelper::upload($education->image);
                                    if(!empty($media)){
                                        if (!empty($education->media)) {
                                            //delete old image from database only from database
                                            $education->media->delete();
                                        }
                                        $education->media_id = $media->id;
                                    }
                                }
                                if (($flag = $education->save(false)) === false) {
                                    $transaction->rollBack();
                                    break;
                                }
                            }
                        }

                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }

                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }

            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelsEducations' => (empty($modelsEducations)) ? [new Education] : $modelsEducations,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(!empty($model->media)){
            $model->media->delete();
        }
        if(!empty($model->educations)){
            foreach ($model->educations as $education){
                if(!empty($education->media)){
                    $education->media->delete();
                }
                $education->delete();
            }
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
