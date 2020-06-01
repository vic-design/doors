<?php


/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\shop\MaterialForm */

$this->title = 'Добавить материал';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
