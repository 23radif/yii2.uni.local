<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \app\models\tables\Users;

/* @var $this yii\web\View */
/* @var $model app\models\tables\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

<!--    Выпадающий список пользователей-->
    <?= $form->field($model, 'creator_id')->dropDownList(
        $usersList
    ); ?>

<!--    Выпадающий список пользователей-->
    <?= $form->field($model, 'responsible_id')->dropDownList(
        $usersList
    ); ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

<!--    В качестве статуса выставляются первые 3 пользователя-->
<!--    Не знаю как сделать лимит в выводе через $userList без условий и логики, пока оставил как было-->
    <?= $form->field($model, 'status_id')->dropDownList(
        ArrayHelper::map(Users::find()->limit(3)->all(), 'id', 'login')
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
