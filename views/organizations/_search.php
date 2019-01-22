<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrganizationsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organizations-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'unn') ?>

    <?= $form->field($model, 'okno') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'form_realt') ?>

    <?php // echo $form->field($model, 'fio_director') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'index') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
