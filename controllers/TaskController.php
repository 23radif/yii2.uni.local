<?php

namespace app\controllers;

use app\models\filters\TasksFilter;
use app\models\tables\Task;
use app\models\tables\TaskStatuses;
use app\models\tables\Users;
use Yii;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TaskController extends Controller
{
    //public $layout = false;

    public function actionIndex()
    {
        //2. На главной странице сделать возможность фильтровать задачи по месяцам
        $months = \app\models\Task::getMonths();
        $request = Yii::$app->request;
        $month = $request->post('months') ?: 5;

//        "SELECT * FROM task WHERE MONTH(deadline) = {$month}";

        $dataProvider = new ActiveDataProvider([
            'query' => Task::find()
            ->where("MONTH(deadline) = {$month}"),
            'pagination' => [
                'pageSize' => 12
            ],
        ]);

        //Настройки сортировки по умолчанию
        $dataProvider->sort->attributes['update_time'] = [
            'asc' => ['update_time' => SORT_ASC],
            'desc' => ['update_time' => SORT_DESC],
            //Переименовываем:
            'label' => 'By update date',
        ];
        //Сортировка по умолчанию:
        $dataProvider->sort->defaultOrder['update_time'] = SORT_ASC;

        //3. На главной странице кэшировать рузультат выполнения запроса тасков(по месяцам)
        \Yii::$app->db->cache(function() use ($dataProvider){
            return $dataProvider->prepare();
        });

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'months' => $months,
            'month' => $month,
        ]);
    }

    public function actionOne($id)
    {
        $model = Task::findOne($id);

        return $this->render('one', [
            'model' => $model,
            'usersList' => Users::getUsersList(),
            'statusesList' => TaskStatuses::getList()
        ]);
    }

    public function actionSave($id){
        if ($model = Task::findOne($id)) {
            $model->load(Yii::$app->request->post());
            $model->save();
            \Yii::$app->session->setFlash('success', "Изменения сохранены");
        } else {
            \Yii::$app->session->setFlash('error', "Не удалось сохранить изменения");
        }
        $this->redirect(\Yii::$app->request->referrer);
    }
}