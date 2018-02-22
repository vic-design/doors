<?php

namespace app\fond\readModels;


use app\fond\entities\manage\shop\Category;
use yii\helpers\ArrayHelper;

class CategoryReadRepository
{
    public function getRoot():Category
    {
        return Category::find()->roots()->one();
    }

    public function getAll(): array
    {
        return Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft')->all();
    }

    public function get($id): ?Category
    {
        return Category::find()->andWhere(['>', 'depth', 0])->andWhere(['id' => $id])->one();
    }

    public function findById($id): Category
    {
        return Category::find()->andWhere(['id' => $id])->andWhere(['>', 'depth', 0])->one();
    }

    public function findBySlug($slug): ?Category
    {
        return Category::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }

    public function getTreeSubsOf(Category $category = null): array
    {
        $query = Category::find()->andWhere(['>', 'depth', 0])->orderBy('lft');
        if ($category){
            $criteria = ['or', ['depth' => 1]];
            foreach (ArrayHelper::merge([$category], $category->parents) as $item){
                $criteria[] = ['and', ['>', 'lft', $item->lft], ['<', 'rgt', $item->rgt], ['depth' => $item->depth + 1]];
            }
            $query->andWhere($criteria);
        }else{
            $query->andWhere(['depth' => 1]);
        }
        return $query->all();
    }

    public function getSuffix(Category $category): string
    {
        $descedants = $category->descendants;
        if ($descedants){
            $suffix = '<i class="fa fa-plus pull-right" aria-hidden="true"></i>';
        }else{
            $suffix = '';
        }
        return $suffix;
    }
}