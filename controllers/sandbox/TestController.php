<?php

namespace app\controllers;

use app\models\Task;
use yii\web\Controller;

class TestController extends Controller
{
    //public $layout = false;

    public function actionIndex()
    {
        /* $model = new Task([
             'title' => 'Знакомство с Йии',
             'description' => 'sjfdsklj',
             'status' => 'В работе'
         ]);*/
        $model = new Task();

        $model->setAttributes([
            'title' => 'Знакомство',
            'description' => 'sjfdsklj',
            'status' => 'Тестируется',
            'author' => 1,
            'responsible' => 200,
        ]);

        /* $model->load([
             'Task' =>[
                 'title' => 'Знакомство с Йии',
                 'description' => 'sjfdsklj',
                 'status' => 'В работе'
             ]
             ]
         );*/

        /*var_dump($model->validate());
        var_dump($model->getErrors());*/
        var_dump($model->toArray());
        exit;
    }

    public function actionHello()
    {
        return $this->render('hello', [
            'title' => 'Hello, world',
            'content' => 'Lesson Yii 1'
        ]);
    }


}