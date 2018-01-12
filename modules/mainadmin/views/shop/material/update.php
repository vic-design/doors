<?php

/* @var $this yii\web\View */
/* @var $material app\fond\entities\manage\shop\Material */
/* @var $model \app\fond\forms\manage\shop\MaterialForm */

$this->title = 'Редактирование материала: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $material->name, 'url' => ['view', 'id' => $material->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="material-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
