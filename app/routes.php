<?php

    //Main
    $router->add('homepage', '/', 'Main:index', 'GET|POST');
    $router->add('error404', '/404', 'Main:error404' , 'GET|POST');
    $router->add('staticPage', '/(slug:str).html', 'Main:staticPage' , 'GET|POST');

    //News
    $router->add('news', '/news', 'Main:news', 'GET|POST');
    $router->add('article', '/article/(slug:str)', 'Blog:article' , 'GET|POST');
    $router->add('edit_news', '/edit/(id:num)', 'Blog:edit' , 'GET|POST');

    // $router->add('about', '/about', 'AppController:aboutAction');
    // $router->add('contacts', '/contacts', 'AppController:contactsAction');
    // $router->add('user', '/user/(id:num)', 'AppController:userAction');
