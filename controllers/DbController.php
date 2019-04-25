<?php


namespace app\controllers;


use app\models\tables\Task;
use yii\web\Controller;

class DbController extends Controller
{
    public function actionIndex()
    {
       /* $result = \Yii::$app->db->createCommand("
            SELECT * FROM test WHERE id = :id
        ")
            ->bindValue(':id', 2)
            ->queryAll();
        var_dump($result);*/

       \Yii::$app->db->createCommand("
            DELETE FROM test WHERE id = :id
        ")->bindValue(':id', 2)
          ->execute();

        exit;
    }


    public function actionAr()
    {
  /*      $model = new Task();
        $model->name = "Изучение ORM";
        $model->description = "Изучение ORM";
        $model->creator_id = 1;
        $model->responsible_id = 2;
        $model->deadline = date('2019-04-18');
        $model->status_id = 1;

        $model->save();*/

        /*$model = Task::findOne(3);
        $model->name = "Постичь непостижимое";
        $model->save();*/

        /*$model = Task::findOne(['name' => 'Task 5']);*/
        /*$models = Task::findAll([1, 2, 3]);*/

       /* $models = Task::find()->all();*/
        //var_dump($models);

        /*$model = Task::findOne(4);
        $model->delete();

        Task::deleteAll();*/


       /* var_dump(Task::find()
            ->select("name, description")
            ->where("id > :id")
            ->params([":id" => 2])
            ->all()
        );  //SELECT * FROM task*/

       /** @var Task $model */
        $model = Task::findOne(1);
       var_dump($model->status);
        exit;
    }
}