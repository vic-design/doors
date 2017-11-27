<?php

namespace app\fond\entities\manage;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 * @property int $id [int(11)]
 * @property string $name [varchar(255)]
 * @property Slide[] $slides
 */
class Slider extends ActiveRecord
{
    public static function create($name): self
    {
        $slider = new static();
        $slider->name = $name;

        return $slider;
    }

    public function edit($name)
    {
        $this->name = $name;
    }

    public function attributeLabels() {
        return [
            'name' => 'Название слайдера',
        ];
    }

    public static function tableName() {
        return '{{%sliders}}';
    }

    ###############

    public function addSlide(UploadedFile $file)
    {
        $slides = $this->slides;
        $slides[] = Slide::create($file);
        $this->updateSlides($slides);
    }

    public function removeSlide($id)
    {
        $slides = $this->slides;
        foreach ($slides as $i => $slide){
            if ($slide->isEqualTo($id)){
                unset($slides[$i]);
                $this->updateSlides($slides);
                return;
            }
        }
        throw new \DomainException('Слайд не найден');
    }

    public function removeSlides()
    {
        $this->update([]);
    }

    public function moveSlideUp($id)
    {
        $slides = $this->slides;
        foreach ($slides as $i => $slide){
            if ($slide->isEqualTo($id)){
                if ($prev = $slides[$i - 1] ?? NULL){
                    $slides[$i - 1] = $slide;
                    $slides[$i] = $prev;
                    $this->updateSlides($slides);
                }
                return;
            }
        }
        throw new \DomainException('Слайд не найден');
    }

    public function moveSlideDown($id)
    {
        $slides = $this->slides;
        foreach ($slides as $i => $slide){
            if ($slide->isEqualTo($id)){
                if ($next = $slides[$i + 1] ?? NULL){
                    $slides[$i + 1] = $slide;
                    $slides[$i] = $next;
                    $this->updateSlides($slides);
                }
                return;
            }
        }
        throw new \DomainException('Слайд не найден');
    }

    private function updateSlides(array $slides)
    {
        foreach ($slides as $i => $slide){
            $slide->setSort($i);
        }
        $this->slides = $slides;
    }

    ###############

    public function getSlides()
    {
        return $this->hasMany(Slide::className(), ['slider_id' => 'id'])->orderBy('sort');
    }

    public function behaviors() {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [
                    'slides',
                ],
            ],
        ];
    }

    public function transactions() {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeDelete() {
        if (parent::beforeDelete()){
            foreach ($this->slides as $slide){
                $slide->delete();
            }
            return TRUE;
        }
        return FALSE;
    }
}