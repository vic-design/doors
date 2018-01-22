<?php
/* @var $this \yii\web\View */
/* @var $product \app\fond\entities\manage\shop\Product */
/* @var $cartForm \app\fond\forms\shop\AddToCartForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\fond\entities\manage\shop\Color;
use app\fond\entities\manage\shop\Material;
use app\fond\entities\manage\shop\Size;

$this->title = $product->title ?: $product->name;
$this->registerMetaTag(['name' => 'description', 'content' => $product->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $product->keywords]);

foreach ($product->category->parents as $parent){
    if (!$parent->isRoot()){
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];
$this->params['breadcrumbs'][] = $product->name;

$this->params['active_category'] = $product->category;
?>

<div class="catalog-product">
    <h1><?= Html::encode($product->name) ?> <small><?= Html::encode($product->additional_name) ?></small> </h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <div class="product-reviews">
        <div class="row">
            <div class="col-sm-3">
                <a href="<?= $product->mainPhoto->getThumbFileUrl('file', 'full') ?>" class="fancybox" rel="gallery-<?= $product->id ?>">
                    <?= Html::img($product->mainPhoto->getThumbFileUrl('file', 'full'), ['alt' => $product->name, 'class' => 'img-responsive']) ?>
                </a>
            </div>
            <div class="col-sm-9">
                <div class="additional-images">
                    <div class="row">
                        <?php foreach ($product->photos as $i => $photo): ?>
                            <?php if ($i !== 0): ?>
                                <div class="col-sm-1">
                                    <div class="product-images">
                                        <a href="<?= $photo->getThumbFileUrl('file', 'full') ?>" class="fancybox" rel="gallery-<?= $product->id ?>">
                                            <?= Html::img($photo->getThumbFileUrl('file', 'full'), ['alt' => $product->name, 'class' => 'img-responsive']) ?>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php if ($product->modifications): ?>
                    <h3>Варианты товара</h3>
                <?php endif; ?>
                <div class="row">
                    <?php foreach ($product->modifications as $modification): ?>
                        <div class="col-sm-2">
                            <div class="mod-image">
                                <a href="<?= $modification->getThumbFileUrl('photo', 'full') ?>" class="fancybox">
                                    <?= Html::img($modification->getThumbFileUrl('photo', 'full'), ['alt' => $modification->name, 'class' => 'img-responsive']) ?>
                                </a>
                            </div>
                            <div class="product-mod-name text-center">
                                <h6><?= $modification->additional_name ?></h6>
                            </div>
                            <div class="product-mod-price text-center">
                                <?= $modification->price ?> <i class="fa fa-rub"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <h3><?= Html::encode($product->additional_name) ?></h3>
                <p>
                    Артикул: <?= $product->code ?>
                </p>

                <?php if (!empty($product->box_old_price)): ?>
                <p class="box-old-price">
                    <del><?= $product->box_old_price ?></del>
                </p>
                <?php endif; ?>
                <?php if (!empty($product->old_price)): ?>
                <p class="old-price">
                    <del><?= $product->old_price ?></del>
                </p>
                <?php endif; ?>
                <p class="price">
                    <?= $product->price ?> <i class="fa fa-rub"></i>
                </p>

                <?php $form = ActiveForm::begin([
                    'action' => ['/shop/cart/add', 'id' => $product->id]
                ]) ?>
                <?php if ($cartForm->modificationsList()): ?>
                    <?= $form->field($cartForm, 'modification')->dropDownList($cartForm->modificationsList(), ['prompt' => ' -- Выбрать --']) ?>
                <?php endif; ?>
                <?php if ($cartForm->sizeList()): ?>
                    <?= $form->field($cartForm, 'size')->dropDownList($cartForm->sizeList(), ['prompt' => ' -- Выбрать --']) ?>
                <?php endif; ?>
                <?= $form->field($cartForm, 'quantity')->textInput(['type' => 'number', 'min' => 1, 'step' => 1]) ?>
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-shopping-cart" aria-hidden="true"></i>  Добавить в корзину', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-8">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab-common" data-toggle="tab">
                            Описание
                        </a>
                    </li>
                    <li>
                        <a href="#tab-addition" data-toggle="tab">
                            Дополнительно
                        </a>
                    </li>
                    <li>
                        <a href="#tab-products" data-toggle="tab">
                            С этим товаром покупают
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-common">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <?php if ($product->body): ?>
                                        <td>
                                            <strong>Описание</strong>
                                        </td>
                                        <td>
                                            <?= $product->body ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->door_thickness): ?>
                                        <td>
                                            <strong>Толщина полотна(мм)</strong>
                                        </td>
                                        <td>
                                            <?= $product->door_thickness ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->door_frame_thickness): ?>
                                        <td>
                                            <strong>Толщина коробки(мм)</strong>
                                        </td>
                                        <td>
                                            <?= $product->door_frame_thickness ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->door_steel_thickness): ?>
                                        <td>
                                            <strong>Толщина стали полотна(мм)</strong>
                                        </td>
                                        <td>
                                            <?= $product->door_steel_thickness ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->frame_steel_thickness): ?>
                                        <td>
                                            <strong>Толщина стали коробки(мм)</strong>
                                        </td>
                                        <td>
                                            <?= $product->frame_steel_thickness ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->describe): ?>
                                        <td>
                                            <strong>Отделка</strong>
                                        </td>
                                        <td>
                                            <?= $product->describe ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->inner_facing): ?>
                                        <td>
                                            <strong>Внутренняя отделка</strong>
                                        </td>
                                        <td>
                                            <?= $product->inner_facing ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->out_facing): ?>
                                        <td>
                                            <strong>Внешняя отделка</strong>
                                        </td>
                                        <td>
                                            <?= $product->out_facing ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->reveal): ?>
                                        <td>
                                            <strong>Ширина наличника</strong>
                                        </td>
                                        <td>
                                            <?= $product->reveal ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->opening): ?>
                                        <td>
                                            <strong>Открывание</strong>
                                        </td>
                                        <td>
                                            <?= $product->opening ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->cam): ?>
                                        <td>
                                            <strong>Эксцентрик</strong>
                                        </td>
                                        <td>
                                            <?= $product->cam ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->packing): ?>
                                        <td>
                                            <strong>Уплотнение</strong>
                                        </td>
                                        <td>
                                            <?= $product->packing ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->door_insulation): ?>
                                        <td>
                                            <strong>Утепление двери</strong>
                                        </td>
                                        <td>
                                            <?= $product->door_insulation ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->box_insulation): ?>
                                        <td>
                                            <strong>Утепление коробки</strong>
                                        </td>
                                        <td>
                                            <?= $product->box_insulation ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->intensive): ?>
                                        <td>
                                            <strong>Усиление</strong>
                                        </td>
                                        <td>
                                            <?= $product->intensive ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->bracing): ?>
                                        <td>
                                            <strong>Крепление</strong>
                                        </td>
                                        <td>
                                            <?= $product->bracing ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->glass): ?>
                                        <td>
                                            <strong>Стекло</strong>
                                        </td>
                                        <td>
                                            <?= $product->glass ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->weight): ?>
                                        <td>
                                            <strong>Вес (кг)</strong>
                                        </td>
                                        <td>
                                            <?= $product->weight ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->colors): ?>
                                        <td>
                                            <strong>Доступные цвета</strong>
                                        </td>
                                        <td>
                                            <?= implode(' ', ArrayHelper::getColumn($product->colors, function (Color $color){
                                                return Html::img($color->getThumbFileUrl('image', 'admin'));
                                            })) ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->materials): ?>
                                        <td>
                                            <strong>Материал</strong>
                                        </td>
                                        <td>
                                            <?= implode(', ', ArrayHelper::getColumn($product->materials, function (Material $material){
                                                return $material->name;
                                            })) ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->sizes): ?>
                                        <td>
                                            <strong>Доступные размеры</strong>
                                        </td>
                                        <td>
                                            <?= implode(', ', ArrayHelper::getColumn($product->sizes, function (Size $size){
                                               return $size->name;
                                            })) ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-addition">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>
                                <tr>
                                    <?php if ($product->features): ?>
                                        <td>
                                            <strong>Особенности</strong>
                                        </td>
                                        <td>
                                            <?= $product->features ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <?php if ($product->complect): ?>
                                        <td>
                                            <strong>Комплектация</strong>
                                        </td>
                                        <td>
                                            <?= $product->complect ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($product->additions): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <?php foreach ($product->additions as $addition): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= Url::to(['/shop/catalog/product', 'slug' => $addition->slug]) ?>" target="_blank">
                                                    <?= $addition->name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <del><?= $addition->old_price ?></del>
                                            </td>
                                            <td>
                                                <?= $addition->price ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane" id="tab-products">
                        <?php if ($product->relates): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <?php foreach ($product->relates as $relate): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= Url::to(['/shop/catalog/product', 'slug' => $relate->slug]) ?>" target="_blank">
                                                    <?= $relate->name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <del><?= $relate->old_price ?></del>
                                            </td>
                                            <td>
                                                <?= $relate->price ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
