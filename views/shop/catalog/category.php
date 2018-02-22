<?php
/* @var $this \yii\web\View */
/* @var $category \app\fond\entities\manage\shop\Category */
/* @var $dataProvider \yii\data\DataProviderInterface */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = $category->title ?: $category->name;
$this->registerMetaTag(['name' => 'description', 'content' => $category->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $category->keywords]);

foreach ($category->parents as $parent){
    if (!$parent->isRoot()){
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'slug' => $parent->slug]];
    }
}
$this->params['breadcrumbs'][] = $category->name;

$this->params['active_category'] = $category;
?>

<div class="catalog-category">
    <h1><?= Html::encode($category->name) ?></h1>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

    <?=
    $this->render('_subcategories', [
            'category' => $category,
    ])
    ?>

    <?= $this->render('_list', [
        'dataProvider' => $dataProvider
    ]) ?>

    <?= $category->body ?>
</div>
