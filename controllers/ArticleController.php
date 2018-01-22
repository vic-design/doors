<?php

namespace app\controllers;


use app\fond\entities\manage\Article;
use yii\web\Controller;

class ArticleController extends Controller
{
    public function actionNode($slug)
    {
        $this->layout = 'catalog';
        $article = Article::find()->andWhere(['slug' => $slug])->andWhere(['status' => 1])->one();

        return $this->render('node', [
            'article' => $article,
        ]);
    }
}