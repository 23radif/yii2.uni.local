<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="task-edit">
    <div class="task-main">
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($model, 'name')->textInput(); ?>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'status_id')
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

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>