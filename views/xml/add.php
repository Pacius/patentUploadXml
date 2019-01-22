<?php

use yii\widgets\ActiveForm;

?>

<?php
?>

    <style>
        .alert {
            padding: 3px 10px;
            margin-bottom: 10px;
        }

    </style>


<?php
foreach ($logs['result'] as $log) {?>
    <div class="alert alert-success">
        <?=$log?>
    </div>
<?php } ?>

<?php
foreach ($logs['warnings'] as $log) {?>
    <div class="alert alert-warning">
        <?=$log?>
    </div>
<?php } ?>

<a href="<?=$link?>" class="btn-light" style="display: block;margin-bottom: 10px;text-align: center;">Перейти к просмотру организации</a>

