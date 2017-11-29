<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $message app\fond\entities\manage\Message */

$this->title = $message->name;
$this->params['breadcrumbs'][] = ['label' => 'Сообщения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <p>
        <?php if ($message->isDraft()): ?>
        <?= Html::a('Отметить как прочитанное', ['activate', 'id' => $message->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php else: ?>
        <?= Html::tag('button', 'Прочитано', ['class' => 'btn btn-default']) ?>
        <?php endif; ?>
        <?php //echo Html::a('Update', ['update', 'id' => $message->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $message->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $message,
                'attributes' => [
                    'id',
                    'name',
                    'phone',
                    'email:email',
                    'body:html',
                    'created_at:datetime',
                ],
            ]) ?>
        </div>
    </div>


</div>
