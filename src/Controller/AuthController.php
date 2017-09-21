<?php

namespace Controller;

use Core\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {       
        return $this->render('Auth/index', ['name' => 1111], 'layout');
    }

    public function loginCheck()
    {
        $model = $this->get('Article');
        
        $news = $model->findAll();
        
        return $this->render('Auth/news', compact('news'), 'layout');
    }

    public function registerForm()
    {       
        return $this->render('Auth/index', ['name' => 1111], 'layout');
    }
    
    public function register()
    {       
        return $this->render('Auth/index', ['name' => 1111], 'layout');
    }
    
    public function logout()
    {
        return $this->redirect('homepage');
    }
}
