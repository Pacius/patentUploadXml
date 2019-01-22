<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BusinessPlanParams */

$this->title = 'Создать параметр для бизнес плана';
$this->params['breadcrumbs'][] = ['label' => 'Параметр для бизнес плана', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-plan-params-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
