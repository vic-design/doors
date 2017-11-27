<?php

namespace app\fond\forms\manage;


use yii\base\Model;
use yii\web\UploadedFile;

class SlideForm extends Model
{
    public $files;

    public function rules() {
        return [
            ['files', 'each', 'rule' => ['image']]
        ];
    }

    public function attributeLabels() {
        return [
            'files' => 'Слайды',
        ];
    }

    public function beforeValidate() {
        if (parent::beforeValidate()){
            $this->files = UploadedFile::getInstances($this, 'files');
            return TRUE;
        }
        return FALSE;
    }
}