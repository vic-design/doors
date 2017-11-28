<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\fond\entities\manage\Message;
use app\fond\helpers\MessageHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\mainadmin\forms\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //echo Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    [
                        'attribute' => 'name',
                        'value' => function(Message $message)
                        {
                            return Html::a($message->name, ['view', 'id' => $message->id]);
                        },
                        'format' => 'html',
                    ],
                    'phone',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'filter' => MessageHelper::statusList(),
                        'value' => function(Message $message)
                        {
                            return MessageHelper::statusLabel($message->status);
                        },
                        'format' => 'html',
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>

</div>
