<?php

/* @var $this yii\web\View */
/* @var $color app\fond\entities\manage\shop\Color */
/* @var $model \app\fond\forms\manage\shop\ColorForm */

$this->title = 'Редактирование цвета: ' . $color->name;
$this->params['breadcrumbs'][] = ['label' => 'Цвета', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $color->name, 'url' => ['view', 'id' => $color->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="color-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
