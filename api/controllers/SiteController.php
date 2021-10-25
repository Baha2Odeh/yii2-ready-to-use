<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/7/18
 * Time: 5:16 PM
 */

namespace api\controllers;


class SiteController extends Controller
{

    protected function authOptional()
    {
        return ['error'];
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
}