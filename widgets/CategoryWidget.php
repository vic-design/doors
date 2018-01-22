<?php

namespace app\widgets;


use app\fond\entities\manage\shop\Category;
use app\fond\readModels\CategoryReadRepository;
use yii\base\Widget;
use yii\helpers\Html;

class CategoryWidget extends Widget
{
    /** @var Category|null */
    public $active;

    private $categories;

    public function __construct(CategoryReadRepository $categories, array $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

    public function run()
    {
        $cats = $this->categories->getTreeSubsOf($this->active);
        $level = 1;
        foreach ($cats as $category){
            $active = $this->getActive($category);
            $suffix = $this->categories->getSuffix($category);
            if ($category->depth == $level){
                echo '</li>'. PHP_EOL;
            }elseif ($category->depth > $level){
                echo '<ul>' . PHP_EOL;
            }else{
                echo '</li>' . PHP_EOL;
                for ($i = $level - $category->depth; $i; $i--){
                    echo '</ul>' . PHP_EOL;
                    echo '</li>' . PHP_EOL;
                }
            }
            echo '<li>';
            echo Html::a(Html::encode($category->name).$suffix, ['/shop/catalog/category', 'id' => $category->id], ['class' => $active ? 'active' : null, 'title' => $category->name]);
            $level = $category->depth;
        }
        for ($i = $level; $i; $i--){
            echo '</li>' . PHP_EOL;
            echo '</ul>' . PHP_EOL;
        }
    }

    private function getActive(Category $category)
    {
        return $this->active && ($this->active->id == $category->id || $this->active->isChildOf($category));
    }
}