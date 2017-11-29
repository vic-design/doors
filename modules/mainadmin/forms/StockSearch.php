<?php

namespace app\modules\mainadmin\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\fond\entities\manage\Stock;

/**
 * StockSearch represents the model behind the search form about `app\fond\entities\manage\Stock`.
 */
class StockSearch extends Model
{
    public $id;
    public $name;
    public $start_day;
    public $status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name'], 'safe'],
        ];
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
        $query = Stock::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'start_day', $this->start_day]);

        return $dataProvider;
    }
}
