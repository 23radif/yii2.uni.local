<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>

<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(['action' => Url::to(['task/save', 'id'])]) ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'status')
                    ->dropDownList($statusesList) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'responsible_id')
                    ->dropDownList($usersList) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'deadline')
                    ->textInput(['type' => 'date'])
                ?>
            </div>
        </div>
        <?= $form->field($model, 'description')->textInput(); ?>
    </div>
</div>