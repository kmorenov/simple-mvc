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

    public function edit(){
        $user = Auth::user();

        return  $this->render('Profile/edit', compact('user'), 'layout');
    }

    public function editSave(){
        $user = Auth::user();

        $user['name'] = $this->post('name');
        $user['lastname'] = $this->post('lastname');
        $user['phone'] = $this->post('phone');

        $model = $model = $this->getModel('User');
        $model->update($user['id'], $user);

        $this->addFlash('editSuccess', 'Updated has been Success');
        return $this->redirect('edit');
    }
}
