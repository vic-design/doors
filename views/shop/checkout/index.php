<?php
/* @var $this \yii\web\View */
/* @var $cart \app\fond\cart\Cart */
/* @var $model \app\fond\forms\shop\OrderForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use yii\widgets\Breadcrumbs;

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Корзина', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="checkout-index">
    <div class="panel panel-default">
        <div class="panel-body">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th class="text-left">Название товара</th>
                        <th class="text-left">Модель</th>
                        <td class="text-left">Размер</td>
                        <th class="text-left">Количество</th>
                        <th class="text-right">Цена за единицу</th>
                        <th class="text-right">Общая стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart->getItems() as $item): ?>
                        <?php $product = $item->getProduct() ?>
                        <?php $modification = $item->getModification() ?>
                        <?php $url = Url::to(['/shop/catalog/product', 'slug' => $product->slug]) ?>
                        <tr>
                            <td class="text-left">
                                <?= Html::a(Html::encode($product->name), [$url]) ?>
                            </td>
                            <td class="text-left">
                                <?php if ($modification): ?>
                                    <?= Html::encode($modification->additional_name) ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-left">
                                <?php if ($item->getSize()): ?>
                                    <?= $item->getSize() ?> см
                                <?php endif; ?>
                            </td>
                            <td class="text-left">
                                <?= $item->getQuantity() ?>
                            </td>
                            <td class="text-right">
                                <?= $item->getPrice() ?> <i class="fa fa-rub" aria-hidden="true"></i>
                            </td>
                            <td class="text-right">
                                <?= $item->getCost() ?> <i class="fa fa-rub" aria-hidden="true"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5"><strong>ИТОГО</strong></td>
                        <td class="text-right"><strong><?= $cart->getCost()->getTotal() ?></strong> <i class="fa fa-rub"
                                                                                                       aria-hidden="true"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <?php $form = ActiveForm::begin() ?>
    <div class="panel panel-default">
        <div class="panel-heading">Покупатель</div>
        <div class="panel-body">
            <?= $form->field($model, 'customerName')->textInput(['maxlength' => true, 'placeholder' => 'ФИО']) ?>
            <?= $form->field($model, 'customerPhone')->widget(MaskedInput::className(), [
                'mask' => '+7 (999) 999- 99-99',
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => 'Контактный телефон',
                ],
            ]) ?>
            <?= $form->field($model, 'customerEmail')->textInput(['maxlength' => true, 'placeholder' => 'Электронная почта']) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 3, 'placeholder' => 'Ваши комментарии'])->hint('Сюда можно написать любые комментарии, которые помогут нам качественно выполнить Ваш заказ. Это могут быть дополнительные контактные телефоны, коды домофонов, ориентиры для доставки и пр. и пр.') ?>

            <div class="form-group">
                <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end() ?>

    <div class="panel panel-default">
        <div class="panel-body">
            После оформления заказа, с Вами свяжется менеджер. С ним Вы сможете решить все вопросы по оплате и доставке.
            <br>
            Сообщения о состоянии Вашего заказа будут приходить на электронную почту, указанную при оформлении.
        </div>
    </div>
</div>
