<?php
use yii\widgets\ActiveForm;
?>

<div>
    <?php //echo var_dump($fileItems['name'])?>

    <?php
    if ($fileItems['name'][0] == "хлеб") {
        echo 'result ok';
    }
    ?>
</div>
<div>
    -----
</div>
<div>
    <pre><?=var_dump($fileItems);?></pre>
</div>

