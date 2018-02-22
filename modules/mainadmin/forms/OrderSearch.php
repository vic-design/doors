<?php

namespace app\modules\mainadmin\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\fond\order\Order;

/**
 * order represents the model behind the search form about `app\fond\order\Order`.
 */
class OrderSearch extends Model
{
    public $id;
    public $status;

    /**
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
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
        $query = Order::find();

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

        return $dataProvider;
    }
}
