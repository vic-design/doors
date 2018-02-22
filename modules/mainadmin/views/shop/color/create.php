<?php


/* @var $this yii\web\View */
/* @var $model \app\fond\forms\manage\shop\ColorForm */

$this->title = 'Добавление цвета';
$this->params['breadcrumbs'][] = ['label' => 'Цвета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="color-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
