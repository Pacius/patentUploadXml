<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BppValue */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bpp-value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_plan_params')->textInput() ?>

    <?= $form->field($model, 'id_business_plan')->textInput() ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
