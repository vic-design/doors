<?php

namespace app\fond\repositories;



use app\fond\entities\manage\Article;
use yii\web\NotFoundHttpException;

class ArticleRepository
{
    public function get($id): Article
    {
        if (!$article = Article::findOne($id)){
            throw new NotFoundHttpException('Страница не найдена.');
        }
        return $article;
    }

    public function save(Article $article)
    {
        if (!$article->save()){
            throw new \RuntimeException('Ошибка сохранения.');
        }
    }

    public function remove(Article $article)
    {
        if (!$article->delete()){
            throw new \RuntimeException('Ошибка удаления.');
        }
    }
}