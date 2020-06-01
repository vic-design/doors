<?php


/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\shop\SizeForm */

$this->title = 'Добавление размера';
$this->params['breadcrumbs'][] = ['label' => 'Размеры', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
