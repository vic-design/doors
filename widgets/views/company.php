<?php
/* @var $this \yii\web\View */
/* @var $company \app\fond\entities\manage\Article */

use yii\helpers\Url;
use yii\helpers\StringHelper;
?>

<div class="company">
    <h2>О компании</h2>
    
    <?= strip_tags(StringHelper::truncateWords($company->body, 30)) ?>
    
    <p><br><br>
        <a href="<?= Url::to(['/article/node', 'slug' => 'o-kompanii']) ?>">
            Читать полностью ...
        </a>
    </p>
    
</div>
