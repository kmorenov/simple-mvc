<?php

namespace Controller;

use Core\Controller;

class MainController extends Controller
{
    public function index()
    {       
        return $this->render('Main/index', ['name' => 1111], 'layout');
    }

    public function news()
    {
        $model = $this->get('Article');
        
        var_dump($model);
        var_dump($model->find(1));
   //     var_dump($model->findAll());
        return $this->render('Main/index', ['name' => 1111], 'layout');
    }

}
