<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

<?= $form->field($model, 'xmlFile')->fileInput() ?>

    <button>Отправить файл на обработку</button>

<?php ActiveForm::end() ?>