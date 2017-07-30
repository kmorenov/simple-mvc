<?php

namespace Controller;

use Core\Controller;

class MainController extends Controller
{
    public function index()
    {       
        return $this->render('Main/index', ['name' => 1111], 'layout');
    }

}
