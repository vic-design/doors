<?php

/* @var $this yii\web\View */
/* @var $size app\fond\entities\manage\shop\Size */
/* @var $model \app\fond\forms\manage\shop\SizeForm */

$this->title = 'Редактирование размера: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Размеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $size->name, 'url' => ['view', 'id' => $size->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="size-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
