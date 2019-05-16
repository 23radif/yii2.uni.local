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
        //$model = new Task();

        //В комментариях нерабочий вариант кэширования:
// //       $request = Yii::$app->request;
//  //      $get = $request->get('sort');

//        $cache = \Yii::$app->cache;
//        $key = 'dataProviderTask'; //. $get
//
//        if(!$dataProvider = $cache->get($key)){
////            $dependency = new DbDependency();
////            $dependency ->sql = "SELECT * FROM task ORDER BY DESC";
//           ....
//            $cache->set($key, $dataProvider, 200, //$dependency);
//        }


        $dataProvider = new ActiveDataProvider([
            'query' => Task::find(),
            'pagination' => [
                'pageSize' => 12
            ],
        ]);

        $dataProvider->sort->attributes['update_time'] = [
            'asc' => ['update_time' => SORT_ASC],
            'desc' => ['update_time' => SORT_DESC],
            'label' => 'By update date',
        ];
        $dataProvider->sort->defaultOrder['update_time'] = SORT_ASC;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOne($id)
    {
        $model = Task::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('one', [
            'model' => $model,
            'usersList' => Users::getUsersList(),
            'statusesList' => TaskStatuses::getList()
        ]);
    }
}