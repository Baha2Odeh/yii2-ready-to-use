<?php

namespace backend\controllers;

use backend\models\DashboardModel;

use common\models\User;
use common\models\UserType;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function verbs()
    {
        return [
            'logout' => ['post'],
        ];
    }

    public function rules()
    {
        return [
            [
                'actions' => ['login'],
                'allow' => true,
            ],
            [
                'actions' => ['logout', 'index', 'error'],
                'allow' => true,
                'roles' => ['@'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $data = DashboardModel::getDashboard();



        return $this->render('index', $data);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout = 'main-login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $model->user_type_id = UserType::ADMIN;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
