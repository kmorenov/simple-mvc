<?php

namespace Controller;

use Core\Controller;
use Core\Auth;

class ProfileController extends Controller
{
    public function __construct() {
        if (!Auth::user()) {
            $this->redirect('loginForm');
        }
    }

        public function index()
    {       
        return $this->render('Profile/index', ['name' => 1111], 'layout');
    }
}
