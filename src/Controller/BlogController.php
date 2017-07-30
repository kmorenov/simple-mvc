<?php

namespace Controller;

use Core\Controller;

class BlogController extends Controller
{
    public function index()
    {       
        return $this->render('Main/index', ['name' => 1111], 'layout');
    }

    public function news()
    {
        $model = $this->get('Article');
        
        $news = $model->findAll();
        
        return $this->render('Blog/news', compact('news'), 'layout');
    }

    public function article($slug)
    {
        $model = $this->get('Article');
        
        $article = $model->findOneBy(['slug' => $slug ]);

        return $this->render('Blog/article', compact('article'), 'layout');
    }
}
