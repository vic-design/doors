<?php

namespace app\widgets;


use app\fond\entities\manage\Article;
use yii\base\Widget;

class MapWidget extends Widget
{
    public function run() {
        $map = Article::findOne(3);

        return $this->render('map', [
            'map' => $map,
        ]);
    }
}