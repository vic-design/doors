<?php

namespace app\fond\forms\manage\shop;


use app\fond\entities\manage\shop\Material;
use yii\base\Model;

class MaterialForm extends Model
{
    public $name;
    
    private $_material;
    
    public function __construct(Material $material = null, array $config = [])
    {
        if ($material){
            $this->name = $material->name;
            $this->_material = $material;
        }
        parent::__construct($config);
    }
    
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'max' => 255],
            ['name', 'unique', 'targetClass' => Material::class, 'filter' => $this->_material ? ['<>', 'id', $this->_material->id] : null], 
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
        ];
    }
}