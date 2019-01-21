<?php
/* @var $this yii\web\View */

use app\assets\appConst;

?>
<h2 style="margin-top:0">Справочная информация</h2>

<style>
    td {
        width:100%;
    }
</style>
<div>
    <table class="table table-striped">
        <thead class="thead-dark">
            <td scope="col" style="width: 500px;font-weight: bold;">Название справочника</td>
            <td scope="col" style="font-weight: bold;">Файл</td>
        </thead>
        <tbody>
        <?php
        foreach (appConst::$referenceInformation as $staticInfo) { ?>
            <tr>
                <td><?= $staticInfo ?></td>
                <td style="text-align: center"><a href="" class="nav-link"><i class="glyphicon glyphicon-save"></i></a></td>
            </tr>
        <?php } ?>
        </tbody>


    </table>
</div>