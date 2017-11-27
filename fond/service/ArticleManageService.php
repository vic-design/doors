<?php

namespace app\fond\service;



use app\fond\repositories\ArticleRepository;
use app\fond\entities\manage\Article;
use app\fond\forms\manage\ArticleForm;
use yii\helpers\Inflector;

class ArticleManageService
{
    private $articles;

    public function __construct(ArticleRepository $articles) {
        $this->articles = $articles;
    }

    public function create(ArticleForm $form): Article
    {
        $article = Article::create(
            $form->name,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->keywords
        );
        $this->articles->save($article);

        return $article;
    }

    public function edit($id, ArticleForm $form)
    {
        $article = $this->articles->get($id);
        $article->edit(
            $form->name,
            $form->body,
            $form->slug ? : Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->keywords
        );
        $this->articles->save($article);
    }

    public function draft($id)
    {
        $article = $this->articles->get($id);
        $article->draft();
        $this->articles->save($article);
    }

    public function activate($id)
    {
        $article = $this->articles->get($id);
        $article->activate();
        $this->articles->save($article);
    }

    public function remove($id)
    {
        $article = $this->articles->get($id);
        $this->articles->remove($article);
    }
}