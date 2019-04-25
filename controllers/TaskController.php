<?php

namespace app\controllers;

use app\models\Task;
use yii\web\Controller;

class TaskController extends Controller
{
    //public $layout = false;

    public function actionIndex()
    {
        $model = new Task();

        $model->setAttributes([
            'title' => 'Знакомство',
            'description' => 'здесь описание',
            'status' => 'Тестируется',
            'author' => 1,
            'responsible' => 200,
        ]);

        /*var_dump($model->validate());
        var_dump($model->getErrors());*/
        var_dump($model->toArray());
        exit;
    }

    public function actionHello()
    {
        return $this->render('hello', [
            'title' => 'Таск-менеджер',
            'subtitle' => 'Тут много инфы',
            'content' => 'и даже есть календарь...',
            'info' => HtmlGet::html_get('../views/task/info.php')
        ]);
    }

}