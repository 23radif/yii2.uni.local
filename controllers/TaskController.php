<?php

namespace app\controllers;

use app\models\tables\Task;
use app\models\tables\Users;
use app\models\TaskStatuses;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class TaskController extends Controller
{
    //public $layout = false;

    public function actionIndex()
    {
        //$model = new Task();

        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionOne($id)
    {
        return $this->render('one', [
            'model' => Task::findOne($id),
            'usersList' => Users::getUsersList(),
            'statusesList' => TaskStatuses::getList()
        ]);
    }

}