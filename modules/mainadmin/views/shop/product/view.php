<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\fond\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $product app\fond\entities\manage\shop\Product */
/* @var $photosForm \app\fond\forms\manage\shop\PhotosForm */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <p>
        <?php if ($product->isDraft()): ?>
        <?= Html::a('Активировать товар', ['activate', 'id' => $product->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php else: ?>
        <?= Html::a('Отключить товар', ['draft', 'id' => $product->id], ['class' => 'btn btn-danger', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Редактировать', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box box-default">
        <div class="box-header with-border">Общее</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'main_photo_id',
                        'value' => $product->mainPhoto ? Html::img($product->mainPhoto->getThumbFileUrl('file', 'admin')) : null,
                        'format' => 'html',
                    ],
                    'name',
                    'code',
                    'body:html',
                    [
                        'attribute' => 'category_id',
                        'value' => ArrayHelper::getValue($product, 'category.name'),
                    ],
                    [
                        'label' => 'Дополнительные категории',
                        'value' => implode(', ', ArrayHelper::getValue($product->categories, 'name'))
                    ],
                    [
                        'label' => 'Цвета',
                        'value' => implode(', ', ArrayHelper::getValue($product->colors, 'name')),
                    ],
                    [
                        'label' => 'Материалы',
                        'value' => implode(', ', ArrayHelper::getValue($product->materials, 'name')),
                    ],
                    [
                        'label' => 'Размеры',
                        'value' => implode(', ', ArrayHelper::getValue($product->sizes, 'name')),
                    ],
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header with-border">Настройка цены</div>
        <div class="box-body">
            <?= Html::a('Изменить цену', ['price', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    [
                        'attribute' => 'door_old_price',
                        'value' => PriceHelper::format($product->door_old_price) . '<i class="fa fa-rub" aria-hidden="true"></i>',
                    ],
                    [
                        'attribute' => 'box_old_price',
                        'value' => PriceHelper::format($product->box_old_price) . '<i class="fa fa-rub" aria-hidden="true"></i>',
                    ],
                    [
                        'attribute' => 'box_price',
                        'value' => PriceHelper::format($product->box_price) . '<i class="fa fa-rub" aria-hidden="true"></i>',
                    ],
                    [
                        'attribute' => 'old_price',
                        'value' => PriceHelper::format($product->old_price) . '<i class="fa fa-rub" aria-hidden="true"></i>',
                    ],
                    [
                        'attribute' => 'price',
                        'value' => PriceHelper::format($product->price) . '<i class="fa fa-rub" aria-hidden="true"></i>',
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Настройка толщины</div>
        <div class="box-body">
            <?= Html::a('Редактировать толщину', ['thickness', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    'door_thickness',
                    'door_frame_thickness',
                    'door_steel_thickness',
                    'frame_steel_thickness',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Характеристики</div>
        <div class="box-body">
            <?= Html::a('Изменить характеристики', ['feature', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    'inner_facing',
                    'out_facing',
                    'glass',
                    'features:html',
                ],
            ]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $product,
                'attributes' => [
                    'title',
                    'description',
                    'keywords',
                ],
            ]) ?>
        </div>
    </div>

    <div id="photos" class="box box-default">
        <div class="box-header with-border">Фотографии</div>
        <div class="box-body">
            <div class="row">
                <?php foreach ($product->photos as $photo): ?>
                    <div class="col-sm-3" style="text-align: center">
                        <div class="btn-group">
                            <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-up', 'id' => $product->id, 'photoId' => $photo->id], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['remove-photo', 'id' => $product->id, 'photoId' => $photo->id], ['class' => 'btn btn-default', 'data-method' => 'post', 'data-confirm' => 'Вы точно хотите удалить изображение?']) ?>
                            <?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-down', 'id' => $product->id, 'photoId' => $photo->id], ['class' => 'btn btn-default', 'data-method' => 'post']) ?>
                        </div>
                        <div>
                            <?= Html::img($photo->getThumbFileUrl('file', 'admin')) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php $form = ActiveForm::begin([
                'options' => ['enctype'=>'multipart/form-data'],
            ]) ?>
            <?= $form->field($photosForm, 'files[]')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => true,
                ]
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>



</div>
