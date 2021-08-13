<?php


namespace App\Services\Articles;


use App\Repository\ArticlesRepository;
use App\Repository\SliderRepository;

class ArticlesRecents
{
protected  $articlesRepository ;
protected  $sliderRepository ;

    public function __construct(ArticlesRepository $articlesRepository, SliderRepository  $sliderRepository)
    {
        $this->articlesRepository = $articlesRepository;
        $this->sliderRepository = $sliderRepository;
    }

    public function getarticlesRecents()
    {
        return $this->articlesRepository->recentsarticles(5);
    }

    public function getSliders()
    {
        return $this->sliderRepository->findAll();
    }

}