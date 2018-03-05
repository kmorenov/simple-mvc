<?php

    //Main
    $router->add('homepage', '/', 'Main:index');
    $router->add('error404', '/404', 'Main:error404' , 'GET|POST');
    $router->add('staticPage', '/(slug:str).html', 'Main:staticPage');

    //Auth
    $router->add('loginForm', '/login', 'Auth:loginForm');
    $router->add('loginCheck', '/login-check', 'Auth:loginCheck' , 'POST');
    $router->add('registerForm', '/register', 'Auth:registerForm');
    $router->add('register', '/register-process', 'Auth:register' , 'POST');
    $router->add('logout', '/logout', 'Auth:logout');
    $router->add('profile', '/profile', 'Profile:index');

    $router->add('editSave', '/edit-save', 'Profile:editSave', 'POST');
    $router->add('edit', '/edit', 'Profile:edit');


    $router->add('confirmEmail', '/confirmEmail', 'Auth:confirmEmail', 'GET|POST');
    $router->add('confirm', '/confirm/(token:any)', 'Auth:confirm', 'GET|POST');

    //News
    $router->add('news', '/news', 'Blog:news');
    $router->add('article', '/article/(slug:str)', 'Blog:article');
    $router->add('edit_news', '/edit/(id:num)', 'Blog:edit' , 'GET|POST');

    // $router->add('about', '/about', 'AppController:aboutAction');
    // $router->add('contacts', '/contacts', 'AppController:contactsAction');
    // $router->add('user', '/user/(id:num)', 'AppController:userAction');

