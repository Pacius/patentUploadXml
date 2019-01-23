<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BppValue */

$this->title = 'Create Bpp Value';
$this->params['breadcrumbs'][] = ['label' => 'Bpp Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bpp-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
