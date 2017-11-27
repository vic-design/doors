<?php

namespace app\fond\service;


use app\fond\entities\manage\Slider;
use app\fond\forms\manage\SlideForm;
use app\fond\forms\manage\SliderCreateForm;
use app\fond\forms\manage\SliderEditForm;
use app\fond\repositories\SliderRepository;

class SlidersManageService
{
    private $sliders;

    public function __construct(SliderRepository $sliders) {
        $this->sliders = $sliders;
    }

    public function create(SliderCreateForm $form): Slider
    {
        $slider = Slider::create(
                $form->name
        );

        foreach ($form->slides->files as $file){
            $slider->addSlide($file);
        }

        $this->sliders->save($slider);
        return $slider;
    }

    public function edit($id, SliderEditForm $form)
    {
        $slider = $this->sliders->get($id);
        $slider->edit(
                $form->name
        );
        $this->sliders->save($slider);
    }

    public function remove($id)
    {
        $slider = $this->sliders->get($id);
        $this->sliders->remove($slider);
    }

    ###############

    public function addSlides($id, SlideForm $form)
    {
        $slider = $this->sliders->get($id);
        foreach ($form->files as $file) {
            $slider->addSlide($file);
        }
        $this->sliders->save($slider);
    }

    public function moveSlideUp($id, $slideId)
    {
        $slider = $this->sliders->get($id);
        $slider->moveSlideUp($slideId);
        $this->sliders->save($slider);
    }

    public function moveSlideDown($id, $slideId)
    {
        $slider = $this->sliders->get($id);
        $slider->moveSlideDown($slideId);
        $this->sliders->save($slider);
    }

    public function removeSlide($id, $slideId)
    {
        $slider = $this->sliders->get($id);
        $slider->removeSlide($slideId);
        $this->sliders->save($slider);
    }
}