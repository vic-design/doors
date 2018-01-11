<?php
namespace app\bootstrap;

use yii\base\BootstrapInterface;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        $container->set(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions('elfinder'),
        ]);
    }
}