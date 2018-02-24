<?php
/* @var $this \yii\web\View */

$this->title = 'Главная';

?>

<div class="mainadmin-default-index">
    <h1>Здравствуйте <small><?= Yii::$app->user->identity['username'] ?></small> </h1>
    <p>
        Все готово!
    </p>
    <p>
        Желаю приятной работы!
    </p>
</div>
