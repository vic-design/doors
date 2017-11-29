<?php

namespace app\widgets;


use app\fond\entities\manage\Article;
use yii\base\Widget;

class CompanyWidget extends Widget
{
    public function run() {
        $company = Article::findOne(1);

        return $this->render('company', [
            'company' => $company,
        ]);
    }
}