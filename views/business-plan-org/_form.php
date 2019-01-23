<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessPlanOrg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-plan-org-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_business_plan')->textInput() ?>

    <?= $form->field($model, 'id_organization')->textInput() ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
