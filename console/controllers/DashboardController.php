<?php
/**
 * Created by PhpStorm.
 * User: bahaaodeh
 * Date: 12/7/18
 * Time: 2:47 PM
 */

namespace console\controllers;


use backend\models\DashboardModel;

class DashboardController extends Controller
{
    public function actionBackendHomePage(){
        echo "hello world";
        DashboardModel::getDashboard(true); // we dont care about response here just to recache
    }
}