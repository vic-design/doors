<?php

namespace app\modules\mainadmin\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\fond\entities\manage\shop\Category;

/**
 * CategorySearch represents the model behind the search form about `app\fond\entities\manage\shop\Category`.
 */
class CategorySearch extends Model
{
    public $id;
    public $name;
    public $slug;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Category::find()->andWhere(['>', 'depth', 0]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['lft' => SORT_ASC]
            ],
            'pagination' => [
                'pageSize' => 200
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
