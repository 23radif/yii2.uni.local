<?php

use app\models\tables\Users;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\filters\TasksFilter */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            //'creator_id', ниже возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'creator_id (создатель)',
                'value' => function ($model) {
                    return $model->creator_id . ' (' .
                        $user = Users::find()
                                ->where(['id' => $model->creator_id])
                                ->one()
                                ->login . ')';
                },
                'attribute' => 'creator_id'
            ],
            //'responsible_id', ниже возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'responsible_id (ответственный)',
                'value' => function ($model) {
                    return $model->responsible_id . ' (' .
                        $user = Users::find()
                                ->where(['id' => $model->responsible_id])
                                ->one()
                                ->login . ')';
                },
                'attribute' => 'responsible_id'
            ],
            'deadline',
//            'status_id', ниже возвращается значение и в скобках отображается пользователь (Users) из БД с таким же id
            [
                'label' => 'status_id (статус)',
                'value' => function ($model) {
                    return $model->status_id . ' (' .
                        $user = Users::find()
                                ->where(['id' => $model->status_id])
                                ->one()
                                ->login . ')';
                },
                'attribute' => 'status_id'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);

//    echo ListView::widget([
//        'dataProvider' => $dataProvider,
//        'itemView' => 'view',
//        'viewParams' => [
//            'hide' => true, //убираем хлебные крошки и лишние кнопки, в случае использования данной метки
//        ],
//    ]);

    ?>


</div>
