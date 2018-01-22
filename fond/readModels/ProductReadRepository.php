<?php

namespace app\fond\readModels;


use app\fond\entities\manage\shop\Category;
use app\fond\entities\manage\shop\Product;
use yii\data\ActiveDataProvider;
use yii\data\DataProviderInterface;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class ProductReadRepository
{
    public function getAll(): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->orderBy('category_id')->with('mainPhoto');
        return $this->getProvider($query);
    }

    public function getAllByCategory(Category $category): DataProviderInterface
    {
        $query = Product::find()->alias('p')->active('p')->with(['mainPhoto', 'category']);
        $idx = ArrayHelper::merge([$category->id], $category->getDescendants()->select('id')->column());
        $query->joinWith(['categoryAssignments ca'], false);
        $query->andWhere(['or', ['p.category_id' => $idx], ['ca.category_id' => $idx]]);
        $query->groupBy('p.id');
        return $this->getProvider($query);
    }

    public function find($id): ?Product
    {
        return Product::find()->active()->andWhere(['id' => $id])->one();
    }

    public function findBySlug($slug): ?Product
    {
        return Product::find()->active()->andWhere(['slug' => $slug])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['p.name' => SORT_ASC],
                        'desc' => ['p.name' => SORT_DESC],
                    ],
                    'price' => [
                        'asc' => ['p.price' => SORT_ASC],
                        'desc' => ['p.price' => SORT_DESC],
                    ],
                ],
            ],
            'pagination' => [
                'pageSizeLimit' => [15, 100],
                'defaultPageSize' => 15,
            ],
        ]);
    }
}