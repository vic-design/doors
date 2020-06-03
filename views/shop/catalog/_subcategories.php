<?php
/* @var $category \app\fond\entities\manage\shop\Category */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if ($category->children): ?>
    <div class="panel panel-default subcategories">
        <div class="panel-body">
            <div class="row">
                <?php foreach ($category->children as $child): ?>
                    <div class="col-sm-3 text-center">
                        <div>
                            <a href="<?= Html::encode(Url::to(['/shop/catalog/category', 'slug' => $child->slug])) ?>">
                                <?= $child->name ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
