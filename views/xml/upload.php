<?php
use yii\widgets\ActiveForm;
?>


<div class="row pux-center" style="height: 400px;">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'xmlFile')->fileInput() ?>

    <button class="btn-light">Отправить файл на обработку</button>

    <?php ActiveForm::end() ?>
</div>


<style>

</style>
