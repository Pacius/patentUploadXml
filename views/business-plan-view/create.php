<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\Models\BusinessPlan */

$this->title = 'Добавить бизнес план';
$this->params['breadcrumbs'][] = ['label' => 'Бизнес планы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
