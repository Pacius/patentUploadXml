<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .form-horizontal {

    }
    .form-group, .form-horizontal {
        margin: 0px!important;
    }
</style>
<div class="site-login" style="width: 500px;margin: 0 auto;">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста для начала работы авторизируйтесь!</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"\">{input}</div>\n<div class=\"\">{error}</div>",
            'labelOptions' => ['class' => ''],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"\">{input} {label}</div>\n<div class=\"\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width:100%']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
