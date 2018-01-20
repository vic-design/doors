<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Modification;
use yii\base\Model;
use yii\web\UploadedFile;

class ModificationForm extends Model
{
    public $id;
    public $name;
    public $additionalName;
    public $code;
    public $price;
    public $photo;

    public function __construct(Modification $modification = null, array $config = [])
    {
        if ($modification){
            $this->name = $modification->name;
            $this->additionalName = $modification->additional_name;
            $this->code = $modification->code;
            $this->price = $modification->price;
        }else{
            $this->id = Modification::find()->max('id') + 1;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'code', 'price'], 'required'],
            [['name', 'code', 'additionalName'], 'string', 'max' => 255],
            [['price', 'id'], 'integer'],
            ['photo', 'image'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'additionalName' => 'Доп. название',
            'additional_name' => 'Доп. название',
            'code' => 'Артикул',
            'price' => 'Цена',
            'photo' => 'Фото',
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }
}