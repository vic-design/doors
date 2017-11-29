<?php


namespace app\widgets;


use app\fond\entities\manage\Stock;
use yii\base\Widget;

class StockWidget extends Widget
{
    public function run() {
        $stocks = Stock::find()->andWhere(['status' => 1])->orderBy(['created_at' => SORT_DESC])->limit(4)->all();

        return $this->render('stock', [
            'stocks' => $stocks,
        ]);
    }
}