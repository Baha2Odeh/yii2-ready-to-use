<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 11/23/18
 * Time: 11:40 PM
 */

namespace backend\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class Controller extends \common\controllers\Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => $this->rules(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
        ];
    }

    public function rules(){
        return [];
    }
    public function verbs(){
        return [];
    }
}