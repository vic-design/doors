<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Size;
use yii\base\Model;

class SizeForm extends Model
{
    public $name;

    private $_size;

    public function __construct(Size $size = null, array $config = [])
    {
        if ($size){
            $this->name = $size->name;
            $this->_size = $size;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            ['name', 'unique', 'targetClass' => Size::className(), 'filter' => $this->_size ? ['<>', 'id', $this->_size->id] : null],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Размер',
        ];
    }
}